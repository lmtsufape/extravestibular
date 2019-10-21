<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Errata;
use Illuminate\Http\Request;
use extravestibular\Edital;
use Carbon\Carbon;

class ErrataController extends Controller
{
    public function novaErrata(Request $request){
      $edital = Edital::find($request->editalId);
      $mytime = Carbon::now('America/Recife');
      $mytime = $mytime->toDateString();
      return view('cadastrarErrata', ['editalId' => $edital->id, 'mytime' => $mytime]);
    }

    public function cadastroErrata(Request $request){
      Errata::create([
        'nome'       => $request->nome,
        'descricao'        => $request->descricao,
        'editalId'   => $request->editalId,
      ]);
      if($request->editarEdital == 'sim'){
        return redirect()->route('editarEdital')->with('editalId', $request->editalId);
      }
      else{
        return redirect()->route('home')->with('jsAlert', 'Errata criada com sucesso.');
      }
    }

    public function deleteErrata(Request $request){
      $errata = Errata::find($request->errataId);
      $errata->delete();
      return redirect()->route('home')->with('jsAlert', 'Errata excluida com suceso.');
    }
}
