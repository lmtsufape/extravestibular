<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Recurso;
use extravestibular\DadosUsuario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class RecursoController extends Controller
{
    public function cadastroRecurso(Request $request){
      $dados = DadosUsuario::find(Auth::user()->dados);
      $mytime = Carbon::now('America/Recife');
      $mytime = $mytime->toDateString();
      Recurso::create([
        'usuarioId'       => Auth::user()->id,
        'editalId'        => $request->editalId,
        'nome'            => $dados->nome,
        'cpf'             => $dados->cpf,
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
