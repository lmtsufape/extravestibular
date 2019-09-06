<?php

namespace extravestibular\Http\Controllers;

use Illuminate\Http\Request;
use extravestibular\Edital;
use extravestibular\Inscricao;
use extravestibular\Recurso;
use extravestibular\Isencao;
use extravestibular\User;
use extravestibular\DadosUsuario;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;
use Auth;


class EditalController extends Controller
{
      public function novoEdital(){
        $client = new Client(); //GuzzleHttp\Client
        /*$result = $client->post('your-request-uri', [
          'form_params' => [
            'sample-form-data' => 'value'
          ]
        ]);

          // Send an asynchronous request.
          // $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
          // $promise = $client->sendAsync($request)->then(function ($response) {
          //     echo 'I completed! ' . $response->getBody();
          // });
          // $promise->wait();*/
        $cursos = $client->get('http://app.uag.ufrpe.br/api/api/curso/');
        if($cursos->getStatusCode() == 201){
          $cursos = json_decode($cursos->getBody(), true);
          return view('cadastrarEdital', ['cursos' => $cursos]);
        }
      }

      public function cadastroEdital(Request $request){
        $validatedData = $request->validate(['nome'                  => ['required', 'string', 'max:255'],
                                              'inicioInscricoes'     => ['required', 'date'],
                                              'fimInscricoes'        => ['required', 'date'],
                                              'pdfEdital'            => ['required', 'file'],
                                              'inicioRecurso'        => ['required', 'date'],
                                              'fimRecurso'           => ['required', 'date'],
                                              'inicioIsencao'        => ['required', 'date'],
                                              'fimIsencao'           => ['required', 'date'],
                                              'inicioRecursoIsencao' => ['required', 'date'],
                                              'fimRecursoIsencao'    => ['required', 'date'],
                                              'inicioIsencao'        => ['required', 'date'],
                                            ]);







        $file = $request->pdfEdital;
        $path = 'editais/';
        $nome = $request->nome . ".pdf";
        Storage::putFileAs($path, $file, $nome);
        $vagas = "";
        for($i = 0; $i < $request->nCursos; $i++){
          $aux = "cursoId" . $i;
          $vagas = $vagas . $request->$aux . ":";
          $vagas = $vagas . $request->$i . "!";
        }

        Edital::create([
          'vagas'                => $vagas,
          'pdfEdital'            => $path . $nome,
          'inicioInscricoes'     => $request->inicioInscricoes,
          'fimInscricoes'        => $request->fimInscricoes,
          'nome'                 => $nome,
          'inicioRecurso'        => $request->inicioRecurso,
          'fimRecurso'           => $request->fimRecurso,
          'inicioIsencao'        => $request->inicioIsencao,
          'fimIsencao'           => $request->fimIsencao,
          'inicioRecursoIsencao' => $request->inicioRecursoIsencao,
          'fimRecursoIsencao'    => $request->fimRecursoIsencao,

        ]);

       return redirect()->route('home')->with('jsAlert', 'Novo edital criado com sucesso.');


      }

      public function listaEditais(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        if($request->tipo == 'requerimentoDeRecurso' || $request->tipo == 'homologarRecursos'){
          $editais = Edital::where('inicioRecurso', '<=', $mytime)
                             ->where('fimRecurso' , '>=', $mytime)
                             ->get();
          $isencao = Edital::where('inicioRecursoIsencao', '<=', $mytime)
                             ->get();
          $editais = $editais->merge($isencao);
          return view('listaEditais', ['editais' => $editais,
                                       'tipo'    => $request->tipo,
                                      ]);

        }
        if($request->tipo == 'gerarClassificacao'){
          $editais = Edital::where('fimInscricoes' , '<=', $mytime)
                             ->paginate(10);
          return view('listaEditais', ['editais' => $editais,
                                       'tipo'    => $request->tipo,
                                       'mytime'  => $mytime,
                                      ]);
        }
        if($request->tipo == 'requerimentoDeIsencao'){
          $editais = Edital::where('inicioIsencao', '<=', $mytime)
                             ->where('fimIsencao' , '>=', $mytime)
                             ->get();
          return view('listaEditais',['editais' => $editais,
                                      'tipo'    => $request->tipo,
                                    ]);
        }
        if($request->tipo == 'homologarIsencao'){
          $editais = Edital::where('inicioIsencao', '<=', $mytime)
                             ->where('inicioInscricoes' , '>=', $mytime)
                             ->get();
          return view('listaEditais',['editais' => $editais,
                                      'tipo'    => $request->tipo,
                                    ]);
        }
        else{
          $editais = Edital::where('inicioInscricoes', '<=', $mytime)
                             ->where('fimInscricoes' , '>=', $mytime)
                             ->get();
          return view('listaEditais', ['editais' => $editais,
                                       'tipo'    => $request->tipo,
                                      ]);
        }
    	}

    	public function editalEscolhido(Request $request){
    		$edital = Edital::find($request->editalId);
        if($request->tipo == 'fazerInscricao'){
      		$client = new Client();
      		$cursos = $client->get('http://app.uag.ufrpe.br/api/api/curso/');
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
          $comprovante = Isencao::where('editalId', $request->editalId)
                                  ->where('usuarioId', Auth::user()->id)
                                  ->where('parecer', 'deferida')
                                  ->first();
          if(is_null($comprovante)){
            return view('cadastrarInscricao', ['cursosDisponiveis' => $cursosDisponiveis,
                                      'editalId'          => $request->editalId,
                                      'comprovante'       => 'indeferida',
                                    ]);
          }
      		return view('cadastrarInscricao', ['cursosDisponiveis' => $cursosDisponiveis,
                                    'editalId'          => $request->editalId,
                                    'comprovante'       => $comprovante->parecer,
                                  ]);
        }
        if($request->tipo == 'homologarInscricoes'){          
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'nao')
                                              ->paginate(10);
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'homologacao',
                                         ]);
        }
        if($request->tipo == 'homologarInscricoesReintegracao'){
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->where('tipo', 'reintegracao')
                                              ->where('homologadoDrca', 'nao')
                                              ->paginate(10);
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'drca',
                                         ]);
        }
        if($request->tipo == 'classificarInscricoes'){
          // $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'reintegracao')->where('homologadoDrca', 'aprovado')->where('coeficienteDeRendimento', 'nao')->get();
          // $aux = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'transferenciaExterna')->where('coeficienteDeRendimento', 'nao')->get();
          // $aux1 = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'transferenciaInterna')->where('coeficienteDeRendimento', 'nao')->get();
          // $aux2 = Inscricao::where('editalId', $request->editalId)->where('homologado', 'aprovado')->where('tipo', 'portadorDeDiploma')->where('coeficienteDeRendimento', 'nao')->get();
          // $inscricoesDisponiveis = $inscricoesDisponiveis->merge($aux);
          // $inscricoesDisponiveis = $inscricoesDisponiveis->merge($aux1);
          // $inscricoesDisponiveis = $inscricoesDisponiveis->merge($aux2);

          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->where('homologadoDrca', 'aprovado')
                                              ->where('coeficienteDeRendimento', 'nao')
                                              ->paginate(10);
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'classificacao',
                                         ]);
        }
        if($request->tipo == 'requerimentoDeRecurso'){
          return view('cadastrarRecurso', ['editalId'    => $request->editalId,
                                           'tipoRecurso' => $request->tipoRecurso,
                                          ]);
        }
        if($request->tipo == 'homologarRecursos'){
          $recursosDisponiveis = Recurso::where('editalId', $request->editalId)
                                          ->where('homologado', 'nao')
                                          ->paginate(10);
          return view('listaRecursos', ['recursos' => $recursosDisponiveis]);
        }
        if($request->tipo == 'requerimentoDeIsencao'){
          return view('cadastrarIsencao', ['editalId' => $request->editalId]);
        }
        if($request->tipo == 'homologarIsencao'){
          $isencoesDisponiveis = Isencao::where('editalId', $request->editalId)
                                          ->where('parecer', 'nao')
                                          ->paginate(10);
          return view('listaIsencoes', ['isencoes' => $isencoesDisponiveis]);
        }
      }

      public function gerarClassificacao(Request $request){
        $lista = Inscricao::where('editalId', $request->editalId)->orderBy('nota', 'desc')->get();
        $data = ['lista' => $lista];
        $pdf = PDF::loadView('classificacao', $data);
        return $pdf->download('classificacao.pdf');
      }

      public function detalhesEdital(Request $request){
        $inscricao = Inscricao::where('usuarioId', Auth::user()->id)
        ->where('editalId', $request->editalId)
        ->first();
        $isencao = Isencao::where('usuarioId', Auth::user()->id)
        ->where('editalId', $request->editalId)
        ->first();
        $recursoIsencao = Recurso::where('usuarioId', Auth::user()->id)
        ->where('editalId', $request->editalId)
        ->where('tipo', 'taxa')
        ->first();
        $recursoInscricao = Recurso::where('usuarioId', Auth::user()->id)
        ->where('editalId', $request->editalId)
        ->where('tipo', 'classificacao')
        ->first();
        $edital = Edital::find($request->editalId);
        if(Auth::user()->tipo == 'candidato'){
          return view('detalhesEditalCandidato', ['editalId'          => $request->editalId,
                                                  'inscricao'         => $inscricao,
                                                  'isencao'           => $isencao,
                                                  'recursoIsencao'    => $recursoIsencao,
                                                  'recursoInscricao'  => $recursoInscricao,
                                                  'edital'            => $edital,
                                                  'mytime'            => $request->mytime,
                                                ]);

        }
        if(Auth::user()->tipo == 'PREG'){
          return view('detalhesEditalPREG', ['editalId'          => $request->editalId,
                                                  'inscricao'         => $inscricao,
                                                  'isencao'           => $isencao,
                                                  'recursoIsencao'    => $recursoIsencao,
                                                  'recursoInscricao'  => $recursoInscricao,
                                                  'edital'            => $edital,
                                                  'mytime'            => $request->mytime,
                                                ]);

        }
        if(Auth::user()->tipo == 'DRCA'){
          return view('detalhesEditalDRCA', ['editalId'          => $request->editalId,
                                                  'inscricao'         => $inscricao,
                                                  'isencao'           => $isencao,
                                                  'recursoIsencao'    => $recursoIsencao,
                                                  'recursoInscricao'  => $recursoInscricao,
                                                  'edital'            => $edital,
                                                  'mytime'            => $request->mytime,
                                                ]);

        }
        if(Auth::user()->tipo == 'coordenador'){
          return view('detalhesEditalCoordenador', ['editalId'          => $request->editalId,
                                                  'inscricao'         => $inscricao,
                                                  'isencao'           => $isencao,
                                                  'recursoIsencao'    => $recursoIsencao,
                                                  'recursoInscricao'  => $recursoInscricao,
                                                  'edital'            => $edital,
                                                  'mytime'            => $request->mytime,
                                                ]);

        }


      }
}
