<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Recurso;
use Illuminate\Http\Request;
use Auth;

class RecursoController extends Controller
{
    public function cadastroRecurso(Request $request){
      Recurso::create([
        'usuarioId'       => Auth::user()->id,
        'editalId'        => $request->editalId,
        'nome'            => $request->nome,
        'cpf'             => $request->cpf,
        'tipo'            => $request->tipo,
        'motivo'          => $request->motivo,
        'nProcesso'       => $request->nProcesso,
        'data'            => $request->data,
        'homologado'      => 'nao',

      ]);
      return view('home');
    }

    public function recursoEscolhido(Request $request){
      $recurso = Recurso::find($request->recursoId);
      return view('homologarRecurso', ['recurso' => $recurso]);
    }

    public function homologarRecurso(Request $request){
      $recurso = Recurso::find($request->recursoId);
      if(!strcmp($request->radioRecurso, 'rejeitado')){
        $recurso->homologado = 'rejeitado';
        $recurso->save();
        return view('home');
      }
      else{
        $recurso->homologado = 'aprovado';
        $recurso->save();
        return view('home');
      }
    }

}
