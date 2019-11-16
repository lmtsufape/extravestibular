<?php

namespace extravestibular\Http\Controllers;

use Illuminate\Http\Request;
use extravestibular\Edital;
use extravestibular\User;
use Carbon\Carbon;
use extravestibular\ApiLmts;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

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
      $api = new ApiLmts();
      $user = $api->loginApi($request->email, $request->password);
      if(is_null($user)){
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if(Auth::check()){
          return redirect()->route('home');
        }
        else{
          return redirect()->route('home');
        }
      }
      else{
        $request->session()->put('id', $user['id']);
        $request->session()->put('email', $user['email']);
        $request->session()->put('cursoId', $user['cursoId']);
        $request->session()->put('tipo', $user['tipo']);
        // dd(session()->all());
        // dd(session()->all());
        // $acl = $api->getAcl($user['tipoUsuario']);
        // $stringAcl = '';
        // foreach($acl as $key){
        //   $stringAcl = $stringAcl . $key . ';';
        // }
        // $request->session()->put('acl', $stringAcl);
        return redirect()->route('homeApi');
      }

    }



}
