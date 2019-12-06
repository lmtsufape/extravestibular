<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Edital;
use App\User;
use Carbon\Carbon;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Lmts\src\controller\LmtsApi;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth')->except(['loginApi', 'homeApi', 'index']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(session()->all());
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $editais = Edital::where('publicado', 'sim')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        $editaisNaoPublicados = 'nao';
        if(Auth::check()){
          if(!(Auth::user()->tipo != 'candidato')){
            if(is_null(Auth::user()->dados)){
              return view('cadastrarDadosUsuario');
            }
          }
          return view('home', ['editais'              => $editais,
                               'mytime'               => $mytime,
                               'editaisNaoPublicados' => $editaisNaoPublicados,
                              ]);
        }
        else{
          if(session('tipo') == 'PREG'){
            $editaisNaoPublicados = Edital::whereNull('publicado')
                                            ->orderBy('dataPublicacao', 'desc')
                                            ->paginate(10);
            return view('home', ['editais'              => $editais,
                                 'mytime'               => $mytime,
                                 'editaisNaoPublicados' => $editaisNaoPublicados,
                                ]);
          }
          elseif(session('tipo') == 'DRCA'){
            return view('home', ['editais'              => $editais,
                                 'mytime'               => $mytime,
                                 'editaisNaoPublicados' => $editaisNaoPublicados,
                                ]);
          }
          elseif(session('tipo') == 'coordenador'){
            return view('home', ['editais'              => $editais,
                                 'mytime'               => $mytime,
                                 'editaisNaoPublicados' => $editaisNaoPublicados,
                                ]);
          }
        }
        return redirect()->route('login');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homeApi(){

      if(is_null(session('tipo'))){
        return redirect()->route('login');
      }
      $mytime = Carbon::now('America/Recife');
      $mytime = $mytime->toDateString();

      $editais = Edital::where('publicado', 'sim')
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
      $editaisNaoPublicados = Edital::whereNull('publicado')
                                      ->orderBy('created_at', 'desc')
                                      ->paginate(10);
      return view('home', ['editais'              => $editais,
                           'mytime'               => $mytime,
                           'editaisNaoPublicados' => $editaisNaoPublicados,
                          ]);
    }

    public function loginApi(Request $request){
      $api = new LmtsApi();
      Auth::attempt(['email' => $request->email, 'password' => $request->password]);
      if(Auth::check()){
        $acl = $api->getAcl('4');
        $stringAcl = '';
        foreach($acl as $key){
          $stringAcl = $stringAcl . $key . ';';
        }
        session(['acl' => $stringAcl]);

        return redirect()->route('home');

      }
      else{
        $logado = $api->login($request->email, $request->password);
        $cursoId = session('unidadeOrgId');
        $tipo = session('tipoNome');
        session(['cursoId' => $cursoId, 'tipo' => $tipo]);

        if($logado){
          return redirect()->route('home');
        }
        else{
          return redirect()->route('login')->withInput(['email' => $request->email])
                                           ->withErrors(['email' => 'E-mail ou Senha incorreta.']);
        }
      }
    }



}
