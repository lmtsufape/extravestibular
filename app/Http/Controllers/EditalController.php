<?php

namespace extravestibular\Http\Controllers;

use Illuminate\Http\Request;
use extravestibular\Edital;
use extravestibular\Inscricao;
use extravestibular\Recurso;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class EditalController extends Controller
{
      public function novoEdital(){
        $client = new Client(); //GuzzleHttp\Client
        /*$result = $client->post('your-request-uri', [
          'form_params' => [
            'sample-form-data' => 'value'
          ]
        ]);*/

          // Send an asynchronous request.
          // $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
          // $promise = $client->sendAsync($request)->then(function ($response) {
          //     echo 'I completed! ' . $response->getBody();
          // });
          // $promise->wait();
        $cursos = $client->get('lmts.api/api/curso/');
        if($cursos->getStatusCode() == 201){
          $cursos = json_decode($cursos->getBody(), true);
          return view('novoEdital', ['cursos' => $cursos]);
        }
      }

      public function cadastroEdital(Request $request){
        $file = $request->pdfEdital;
        $path = 'editais/';
        Storage::putFileAs($path, $file, $_FILES['pdfEdital']['name']);
        $vagas = "";
        for($i = 0; $i < $request->nCursos; $i++){
          $aux = "cursoId" . $i;
          $vagas = $vagas . $request->$aux . ":";
          $vagas = $vagas . $request->$i . "!";
        }

        Edital::create([
          'vagas'             => $vagas,
          'pdfEdital'         => $path . $_FILES['pdfEdital']['name'],
          'inicioInscricoes'  => $request->inicioInscricoes,
          'fimInscricoes'     => $request->fimInscricoes,
          'nome'              => $_FILES['pdfEdital']['name'],
          'inicioRecurso'     => $request->inicioRecurso,
          'fimRecurso'        => $request->fimRecurso,

        ]);

        return view('home');


      }

      public function listaEditais(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        if($request->tipo == '4' || $request->tipo == '5'){
          $editais = Edital::where('inicioRecurso', '<=', $mytime)
                             ->where('fimRecurso', '>=', $mytime)
                             ->get();
          return view('listaEditais', ['editais' => $editais,
                                       'tipo' => $request->tipo,
                                      ]);

        }
        else{
          $editais = Edital::where('inicioInscricoes', '<=', $mytime)
                             ->where('fimInscricoes', '>=', $mytime)
                             ->get();
          return view('listaEditais', ['editais' => $editais,
                                       'tipo' => $request->tipo,
                                      ]);
        }
    	}

    	public function editalEscolhido(Request $request){
    		$edital = Edital::find($request->editalId);
        if($request->tipo == '0'){
      		$client = new Client();
      		$cursos = $client->get('lmts.api/api/curso/');
      		$cursos = json_decode($cursos->getBody(), true);
      		$cursosDisponiveis = $edital->vagas;
      		$cursosDisponiveis = explode("!", $cursosDisponiveis);
      		for($i = 0; $i < sizeof($cursosDisponiveis); $i++){
      			$cursosDisponiveis[$i] = explode(":",$cursosDisponiveis[$i]);
      		}
      		for($i = 0; $i < (sizeof($cursosDisponiveis)-1); $i++){
      			if($cursosDisponiveis[$i][1] == '#'){
      				$cursosDisponiveis[$i][0] = '#';
      				continue;
      			}
      			$idCurso = $cursosDisponiveis[$i][0];
      			for($j = 0; $j < sizeof($cursos); $j++){
      				if($idCurso == $cursos[$j]['id']){
      					$cursosDisponiveis[$i][2] = $idCurso;
      					$cursosDisponiveis[$i][0] = $cursos[$j]['nome'] . '/' . $cursos[$j]['unidade'];
       				}
      			}
      		}
      		return view('inscricao', ['cursosDisponiveis' => $cursosDisponiveis, 'editalId' => $request->editalId]);
        }
        if($request->tipo == '1'){
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)->where('homologado', 'nao')->get();
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'homologacao',
                                         ]);
        }
        if($request->tipo == '2'){
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'reintegracao')->where('homologadoDrca', 'nao')->get();
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'drca',
                                         ]);
        }
        if($request->tipo == '3'){
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'reintegracao')->where('homologadoDrca', 'aprovado')->where('coeficienteDeRendimento', 'nao')->get();
          $aux = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'transferenciaExterna')->where('coeficienteDeRendimento', 'nao')->get();
          $aux1 = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'transferenciaInterna')->where('coeficienteDeRendimento', 'nao')->get();
          $aux2 = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'portadorDeDiploma')->where('coeficienteDeRendimento', 'nao')->get();
          $inscricoesDisponiveis = $inscricoesDisponiveis->merge($aux);
          $inscricoesDisponiveis = $inscricoesDisponiveis->merge($aux1);
          $inscricoesDisponiveis = $inscricoesDisponiveis->merge($aux2);
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'classificacao',
                                         ]);
        }
        if($request->tipo == '4'){
          return view('cadastrarRecurso', ['editalId' => $request->editalId]);
        }
        if($request->tipo == '5'){
          $recursosDisponiveis = Recurso::where('editalId', $request->editalId)->where('homologado', 'nao')->get();
          return view('listaRecursos', ['recursos' => $recursosDisponiveis]);
        }
      }


}
