<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Recurso;
use extravestibular\DadosUsuario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use extravestibular\Edital;
use Auth;

class RecursoController extends Controller
{
    public function cadastroRecurso(Request $request){



      $mytime = Carbon::now('America/Recife');
      $mytime = $mytime->toDateString();
      $edital = Edital::find($request->editalId);

      if($request->tipoRecurso == 'taxa'){
        $existeRecursoTipoTaxa = Recurso::where('editalId', $request->editalId)
                                          ->where('usuarioId', Auth::user()->id)
                                          ->where('tipo', 'taxa')
                                          ->first();
        if(!is_null($existeRecursoTipoTaxa)){
          return redirect()->route('home')->with('jsAlert', 'Você já possui um recurso cadastrada no edital.');
        }
        if(!(($edital->inicioRecursoIsencao <= $mytime) && ($edital->fimRecursoIsencao >= $mytime))){
          return redirect()->route('home')->with('jsAlert', 'Este edital não está no periodo correto.');
        }
      }
      else{
        $existeRecursoTipoClassificacao = Recurso::where('editalId', $request->editalId)
                                                   ->where('usuarioId', Auth::user()->id)
                                                   ->where('tipo', 'classificacao')
                                                   ->first();                                                   
        if(!is_null($existeRecursoTipoClassificacao)){
          return redirect()->route('home')->with('jsAlert', 'Você já possui um recurso cadastrada no edital.');
        }
        if(!(($edital->inicioRecurso <= $mytime) && ($edital->fimRecurso >= $mytime))){
          return redirect()->route('home')->with('jsAlert', 'Este edital não está no periodo correto.');
        }
      }






      $mytime = Carbon::now('America/Recife');
      $mytime = $mytime->toDateString();
      Recurso::create([
        'usuarioId'       => Auth::user()->id,
        'editalId'        => $request->editalId,
        'tipo'            => $request->tipoRecurso,
        'motivo'          => $request->motivo,
        'data'            => $mytime,
        'homologado'      => 'nao',

      ]);
      return redirect()->route('home')->with('jsAlert', 'Recurso enviado com sucesso.');
    }

    public function recursoEscolhido(Request $request){
      $recurso = Recurso::find($request->recursoId);
      return view('homologarRecurso', ['recurso' => $recurso]);
    }

    public function homologarRecurso(Request $request){
      $recurso = Recurso::find($request->recursoId);
      $recurso->homologado = $request->radioRecurso;
      $recurso->motivoRejeicao = $request->motivoRejeicao;
      $recurso->save();
      return redirect()->route('home')->with('jsAlert', 'Recurso homologada com sucesso.');

    }

}
