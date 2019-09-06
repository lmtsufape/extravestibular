<?php

namespace extravestibular\Http\Controllers;

use Illuminate\Http\Request;
use extravestibular\Edital;
use extravestibular\User;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
          if(!(Auth::user()->tipo != 'candidato')){
            if(is_null(Auth::user()->dados)){
              return view('cadastrarDadosUsuario');
            }
          }

          $mytime = Carbon::now('America/Recife');
          $mytime = $mytime->toDateString();
          $editais = Edital::orderBy('created_at', 'desc')->paginate(4);
          return view('home', ['editais' => $editais,
                               'mytime'  => $mytime,
                             ]);
          
          // if(Auth::user()->tipo == 'candidato'){
          //   return view('homeCandidato', ['editais' => $editais,
          //                        'mytime'  => $mytime,
          //                       ]);
          // }
          // if(Auth::user()->tipo == 'PREG'){
          //   return view('homePREG', ['editais' => $editais,
          //                        'mytime'  => $mytime,
          //                       ]);
          // }
          // if(Auth::user()->tipo == 'coordenador'){
          //   return view('homeCoordenador', ['editais' => $editais,
          //                        'mytime'  => $mytime,
          //                       ]);
          // }
          // if(Auth::user()->tipo == 'DRCA'){
          //   return view('homeDRCA', ['editais' => $editais,
          //                        'mytime'  => $mytime,
          //                       ]);
          // }
        }

    }


}
