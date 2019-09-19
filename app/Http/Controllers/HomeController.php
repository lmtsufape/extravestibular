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
          $editais = Edital::orderBy('created_at', 'desc')->paginate(10);
          return view('home', ['editais' => $editais,
                               'mytime'  => $mytime,
                             ]);


        }

    }

    public function loginComEditais(){
      $editais = Edital::orderBy('created_at', 'desc')->paginate(10);
      return view('auth.login', ['editais' => $editais,                        
                         ]);
    }


}
