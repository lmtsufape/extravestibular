<?php

namespace App\Http\Controllers;

use App\Errata;
use Illuminate\Http\Request;
use App\Edital;
use Illuminate\Support\Facades\Storage;
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
      $this->authorize('gerenciarEdital', Edital::class);

      $validatedData = $request->validate([ 'nome'    => ['required', 'string', 'max:255'],
                                            'arquivo' => ['required', 'mimes:pdf', 'max:20000'],
                                          ]);
      $file = $request->arquivo;
      $path = 'erratas/' . $request->editalId . '/';
      $edital = Edital::find($request->editalId);
      $erratas = $edital->errata;
      $numErratas = count($erratas);
      $numErratas++;
      $nomeErrata = 'errata' . $numErratas . '.pdf';
      Storage::putFileAs($path, $file, $nomeErrata);

      Errata::create([
        'nome'       => $request->nome,
        'arquivo'    => $path . $nomeErrata,
        'editalId'   => $request->editalId,
      ]);

      if($request->editarEdital == 'sim'){
        return redirect()->route('editarEdital')->with('editalId', $request->editalId);
      }
      else{
        return redirect()->route('home')->with('jsAlert', 'Errata criada com sucesso!');
      }
    }

    public function modificarErrata(Request $request){
      $this->authorize('gerenciarEdital', Edital::class);

      $validatedData = $request->validate([
                                            'arquivo1' => ['required', 'mimes:pdf', 'max:20000'],
                                          ]);
      $errata = Errata::find($request->errataId);
      $file = $request->arquivo1;
      $path = 'erratas/' . $request->editalId . '/';
      $nomeErrata = $errata->nome . '.pdf';

      Storage::putFileAs($path, $file, $nomeErrata);
      $errata->arquivo = $path . $nomeErrata;
      $errata->save();

      return redirect()->route('home')->with('jsAlert', 'Arquivo da Errata modificado com sucesso!');
    }

    public function deleteErrata(Request $request){
      $this->authorize('gerenciarEdital', Edital::class);
      
      $errata = Errata::find($request->errataId);
      $errata->delete();
      return redirect()->route('home')->with('jsAlert', 'Errata excluida com suceso.');
    }
}
