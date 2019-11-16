<?php

namespace extravestibular\Http\Controllers;

use Illuminate\Http\Request;
use extravestibular\Edital;
use extravestibular\Inscricao;
use extravestibular\Recurso;
use extravestibular\Isencao;
use extravestibular\Erratas;
use extravestibular\User;
use extravestibular\DadosUsuario;
use extravestibular\ApiLmts;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;
use Auth;
use Session;


class EditalController extends Controller{

      public function novoEdital(){
        $api = new ApiLmts();
        $cursos = $api->getCursos();
        if(!is_null($cursos)){
          return view('cadastrarEdital', ['cursos' => $cursos]);
        }
        else{
          return redirect()->route('home')->with('jsAlert', 'Serviço indisponivel no momento.');
        }
      }

      public function editarEdital(Request $request){
        $edital = [];
        if(is_null($request->editalId)){
          $edital = Edital::find(Session::get('editalId'));
        }
        else{
          $edital = Edital::find($request->editalId);
        }
        $api = new ApiLmts();
        $cursos = $api->getCursos();
        if(!is_null($cursos)){
          return view('editarEdital', ['edital' => $edital, 'cursos' => $cursos]);
        }
        else{
          return redirect()->route('home')->with('jsAlert', 'Serviço indisponivel no momento.');
        }
      }

      public function cadastroEditarEdital(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $validatedData = $request->validate([ 'nome'                    => ['required', 'string', 'max:255'],
                                              'pdfEdital'               => ['required', 'mimes:pdf','max:20000'],
                                              'inicioIsencao'           => ['required', 'date', 'after:'.$mytime],
                                              'fimIsencao'              => ['required', 'date', 'after:'.$request->inicioIsencao, 'before:'.$request->inicioRecursoIsencao],
                                              'inicioRecursoIsencao'    => ['required', 'date', 'after:'.$request->fimIsencao, 'before:'.$request->fimRecursoIsencao],
                                              'fimRecursoIsencao'       => ['required', 'date', 'after:'.$request->inicioRecursoIsencao, 'before:'.$request->inicioInscricoes],
                                              'inicioInscricoes'        => ['required', 'date', 'after:'.$request->fimRecursoIsencao, 'before:'.$request->fimInscricoes],
                                              'fimInscricoes'           => ['required', 'date', 'after:'.$request->inicioInscricoes, 'before:'.$request->inicioRecurso],
                                              'inicioRecurso'           => ['required', 'date', 'after:'.$request->fimInscricoes, 'before:'.$request->fimRecurso],
                                              'fimRecurso'              => ['required', 'date', 'after:'.$request->inicioRecurso, 'before:'.$request->resultado],
                                              'resultado'               => ['required', 'date', 'after:'.$request->fimRecurso, 'before:'.$request->inicioRecursoResultado],
                                              'inicioRecursoResultado'  => ['required', 'date', 'after:'.$request->resultado, 'before:'.$request->fimRecursoResultado],
                                              'fimRecursoResultado'     => ['required', 'date', 'after:'.$request->inicioRecursoResultado, 'before:'.$request->resultadoFinal],
                                              'resultadoFinal'          => ['required', 'date', 'after:'.$request->fimRecursoResultado],
                                              'descricao'               => ['required', 'string', 'min:5'],

                                            ]);






        $dataPublicacao = null;
        $file = $request->pdfEdital;
        $path = 'editais/';
        $nome = $request->nome . ".pdf";
        Storage::putFileAs($path, $file, $nome);
        $vagas = "";
        for($i = 1; $i < $request->nCursos; $i++){
          $aux = "checkbox" . $i;
          if($request->$aux != null){

            $manha = 'manha' . $i;
            $tarde = 'tarde' . $i;
            $noite = 'noite' . $i;
            $integral = 'integral' . $i;
            $vagas = $vagas . $request->$aux . ":";
            $vagas = $vagas . $request->$manha . "?";
            $vagas = $vagas . $request->$tarde . "?";
            $vagas = $vagas . $request->$noite . "?";
            $vagas = $vagas . $request->$integral . "?";
            $vagas = $vagas . $request->especial . "!";
          }
        }
        if($request->publicado == 'sim'){
          $dataPublicacao = $mytime;
        }

        $edital = Edital::find($request->editalId);

        $edital->vagas =                 $vagas;
        $edital->pdfEdital =             $path . $nome;
        $edital->inicioInscricoes =      $request->inicioInscricoes;
        $edital->fimInscricoes =         $request->fimInscricoes;
        $edital->nome =                  $nome;
        $edital->inicioRecurso =         $request->inicioRecurso;
        $edital->fimRecurso =            $request->fimRecurso;
        $edital->inicioIsencao =         $request->inicioIsencao;
        $edital->fimIsencao =            $request->fimIsencao;
        $edital->inicioRecursoIsencao =  $request->inicioRecursoIsencao;
        $edital->fimRecursoIsencao =     $request->fimRecursoIsencao;
        $edital->publicado =             $request->publicado;
        $edital->dataPublicacao =        $dataPublicacao;
        $edital->resultado =             $request->resultado;
        $edital->descricao =             $request->descricao;

        $edital->save();

        return redirect()->route('home')->with('jsAlert', 'Novo edital criado com sucesso.');


      }

      public function cadastroEdital(Request $request){

        $mytime = Carbon::now('America/Recife');
        $yesterday = Carbon::yesterday('America/Recife');
        $yesterday = $yesterday->toDateString();
        $mytime = $mytime->toDateString();
        // validate para datas nulas
        if(
           $request->inicioIsencao == null ||
           $request->fimIsencao == null ||
           $request->inicioRecursoIsencao == null ||
           $request->fimRecursoIsencao == null ||
           $request->inicioInscricoes == null ||
           $request->fimInscricoes == null ||
           $request->inicioRecurso == null ||
           $request->fimRecurso == null ||
           $request->inicioRecursoResultado == null ||
           $request->fimRecursoResultado == null ||
           $request->resultadoFinal == null
          ){
            $validatedData = $request->validate([ 'nome'                    => ['required', 'string', 'max:255', 'unique:editals'],
                                                  'pdfEdital'               => ['required', 'mimes:pdf', 'max:20000'],
                                                  'inicioIsencao'           => ['required', 'date', 'after:'.$yesterday],
                                                  'fimIsencao'              => ['required', 'date'],
                                                  'inicioRecursoIsencao'    => ['required', 'date'],
                                                  'fimRecursoIsencao'       => ['required', 'date'],
                                                  'inicioInscricoes'        => ['required', 'date'],
                                                  'fimInscricoes'           => ['required', 'date'],
                                                  'inicioRecurso'           => ['required', 'date'],
                                                  'fimRecurso'              => ['required', 'date'],
                                                  'resultado'               => ['required', 'date'],
                                                  'inicioRecursoResultado'  => ['required', 'date'],
                                                  'fimRecursoResultado'     => ['required', 'date'],
                                                  'resultadoFinal'          => ['required', 'date'],
                                                  'descricao'               => ['required', 'string', 'min:5'],
                                                ]);
        }
        //validate para data oks
        $validatedData = $request->validate([ 'nome'                    => ['required', 'string', 'max:255', 'unique:editals'],
                                              'pdfEdital'               => ['required', 'mimes:pdf', 'max:20000'],
                                              'inicioIsencao'           => ['required', 'date', 'after:'.$yesterday],
                                              'fimIsencao'              => ['required', 'date', 'after:'.$request->inicioIsencao, 'before:'.$request->inicioRecursoIsencao],
                                              'inicioRecursoIsencao'    => ['required', 'date', 'after:'.$request->fimIsencao, 'before:'.$request->fimRecursoIsencao],
                                              'fimRecursoIsencao'       => ['required', 'date', 'after:'.$request->inicioRecursoIsencao, 'before:'.$request->inicioInscricoes],
                                              'inicioInscricoes'        => ['required', 'date', 'after:'.$request->fimRecursoIsencao, 'before:'.$request->fimInscricoes],
                                              'fimInscricoes'           => ['required', 'date', 'after:'.$request->inicioInscricoes, 'before:'.$request->inicioRecurso],
                                              'inicioRecurso'           => ['required', 'date', 'after:'.$request->fimInscricoes, 'before:'.$request->fimRecurso],
                                              'fimRecurso'              => ['required', 'date', 'after:'.$request->inicioRecurso, 'before:'.$request->resultado],
                                              'resultado'               => ['required', 'date', 'after:'.$request->fimRecurso, 'before:'.$request->inicioRecursoResultado],
                                              'inicioRecursoResultado'  => ['required', 'date', 'after:'.$request->resultado, 'before:'.$request->fimRecursoResultado],
                                              'fimRecursoResultado'     => ['required', 'date', 'after:'.$request->inicioRecursoResultado, 'before:'.$request->resultadoFinal],
                                              'resultadoFinal'          => ['required', 'date', 'after:'.$request->fimRecursoResultado],
                                              'descricao'               => ['required', 'string', 'min:5'],
                                            ]);

        $dataPublicacao = null;
        $file = $request->pdfEdital;
        $path = 'editais/';
        $nome = $request->nome . ".pdf";
        Storage::putFileAs($path, $file, $nome);
        $vagas = "";
        for($i = 1; $i < $request->nCursos; $i++){
          $aux = "checkbox" . $i;
          if($request->$aux != null){

            $manha = 'manha' . $i;
            $tarde = 'tarde' . $i;
            $noite = 'noite' . $i;
            $integral = 'integral' . $i;
            $especial = 'especial' . $i;
            $vagas = $vagas . $request->$aux . ":";
            $validatedData = $request->validate([$manha => ['nullable', 'integer']]);
            $vagas = $vagas . $request->$manha . "?";
            $validatedData = $request->validate([$tarde => ['nullable', 'integer']]);
            $vagas = $vagas . $request->$tarde . "?";
            $validatedData = $request->validate([$noite => ['nullable', 'integer']]);
            $vagas = $vagas . $request->$noite . "?";
            $validatedData = $request->validate([$integral => ['nullable', 'integer']]);
            $vagas = $vagas . $request->$integral . "?";
            $validatedData = $request->validate([$especial => ['nullable', 'integer']]);
            $vagas = $vagas . $request->$especial . "!";
          }

        }
        if($request->publicado == 'sim'){
          $dataPublicacao = $mytime;
        }


        Edital::create([
          'vagas'                  => $vagas,
          'pdfEdital'              => $path . $nome,
          'inicioInscricoes'       => $request->inicioInscricoes,
          'fimInscricoes'          => $request->fimInscricoes,
          'nome'                   => $nome,
          'inicioRecurso'          => $request->inicioRecurso,
          'fimRecurso'             => $request->fimRecurso,
          'inicioIsencao'          => $request->inicioIsencao,
          'fimIsencao'             => $request->fimIsencao,
          'inicioRecursoIsencao'   => $request->inicioRecursoIsencao,
          'fimRecursoIsencao'      => $request->fimRecursoIsencao,
          'inicioRecursoResultado' => $request->inicioRecursoResultado,
          'fimRecursoResultado'    => $request->fimRecursoResultado,
          'resultadoFinal'         => $request->resultadoFinal,
          'publicado'              => $request->publicado,
          'dataPublicacao'         => $dataPublicacao,
          'resultado'              => $request->resultado,
          'descricao'              => $request->descricao,


        ]);

       return redirect()->route('home')->with('jsAlert', 'Novo edital criado com sucesso.');


      }

      public function deleteEdital(Request $request){
        $edital = Edital::find($request->editalId);
        $edital->delete();
        return redirect()->route('home')->with('jsAlert', 'Edital excluído com sucesso.');
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
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        if($request->tipo == 'fazerInscricao'){
          $edital = Edital::find($request->editalId);
          $api = new ApiLmts();
          $cursos = $api->getCursos();
          if(is_null($cursos)){
            return redirect()->route('home')->with('jsAlert', 'Serviço indisponivel no momento.');
          }
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
      					$cursosDisponiveis[$i][0] = $cursos[$j]['nome'] . '/' . $cursos[$j]['departamento'];
       				}
      			}
      		}
          // dd($cursosDisponiveis);
          $comprovante = Isencao::where('editalId', $request->editalId)
                                  ->where('usuarioId', Auth::user()->id)
                                  ->where('parecer', 'deferida')
                                  ->first();
          if(is_null($comprovante)){
            return view('cadastrarInscricao', ['cursosDisponiveis' => $cursosDisponiveis,
                                      'editalId'          => $request->editalId,
                                      'comprovante'       => 'indeferida',
                                      'mytime'            => $mytime,
                                    ]);
          }
      		return view('cadastrarInscricao', ['cursosDisponiveis' => $cursosDisponiveis,
                                    'editalId'          => $request->editalId,
                                    'comprovante'       => $comprovante->parecer,
                                    'mytime'            => $mytime,
                                  ]);
        }
        if($request->tipo == 'homologarInscricoes'){
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'nao')
                                              ->paginate(10);
          return view('listaInscricoes', ['inscricoes' => $inscricoesDisponiveis,
                                          'tipo'       => 'homologacao',
                                          'editalId'   => $request->editalId,
                                          'mytime'            => $mytime,
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
                                          'editalId'   => $request->editalId,
                                          'mytime'            => $mytime,
                                         ]);
        }
        if($request->tipo == 'classificarInscricoes'){
          $inscricoesClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->where('homologado', 'aprovado')
                                                ->where('homologadoDrca', 'aprovado')
                                                ->whereNotNull('nota')
                                                ->orderBy('id')
                                                ->where('curso', session('cursoId'))
                                                ->paginate(10);
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->where('homologadoDrca', 'aprovado')
                                              ->where('coeficienteDeRendimento', 'nao')
                                              ->where('curso', session('cursoId'))
                                              ->paginate(10);
          return view('listaInscricoes', [
                                          'inscricoes'              => $inscricoesDisponiveis,
                                          'inscricoesClassificadas' => $inscricoesClassificadas,
                                          'tipo'                    => 'classificacao',
                                          'editalId'                => $request->editalId,
                                          'mytime'                  => $mytime,
                                         ]);
        }
        if($request->tipo == 'requerimentoDeRecurso'){
          $dados = DadosUsuario::find(Auth::user()->dados);
          return view('cadastrarRecurso', ['editalId'    => $request->editalId,
                                           'tipoRecurso' => $request->tipoRecurso,
                                           'dados'       => $dados,
                                           'mytime'      => $mytime,
                                          ]);
        }
        if($request->tipo == 'homologarRecursos'){
          $recursosDisponiveis = Recurso::where('editalId', $request->editalId)
                                          ->where('homologado', 'nao')
                                          ->paginate(10);
          return view('listaRecursos', ['recursos' => $recursosDisponiveis,
                                        'mytime'            => $mytime,
                                        'editalId'   => $request->editalId]);
        }
        if($request->tipo == 'requerimentoDeIsencao'){
          return view('cadastrarIsencao', ['editalId' => $request->editalId,
                                            'mytime'            => $mytime,]);
        }
        if($request->tipo == 'homologarIsencao'){
          $isencoesDisponiveis = Isencao::where('editalId', $request->editalId)
                                          ->where('parecer', 'nao')
                                          ->paginate(10);
          return view('listaIsencoes', ['isencoes' => $isencoesDisponiveis,
                                        'mytime'            => $mytime,
                                        'editalId'   => $request->editalId]);
        }
      }

      public function gerarClassificacao(Request $request){
        $inscricoes = Inscricao::where('editalId', $request->editalId)
                                 ->orderBy('curso', 'desc')
                                 ->orderBy('nota', 'desc')
                                 ->get();
        $edital = Edital::find($request->editalId);
        $api = new ApiLmts();
        $cursos = $api->getCursos();
        $data = [
                 'inscricoes' => $inscricoes,
                 'edital'     => $edital,
                 'cursos'     => $cursos,
                ];
        $pdf = PDF::loadView('classificacao', $data);
        return $pdf->download('classificacao.pdf');
      }

      public function detalhesEdital(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        if(Auth::check()){
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
          $recursoResultado = Recurso::where('usuarioId', Auth::user()->id)
                                      ->where('editalId', $request->editalId)
                                      ->where('tipo', 'resultado')
                                      ->first();
          $inscricoesClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->where('nota', '!=', null)
                                                ->get();
          $inscricoesNaoClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->whereNull('nota')
                                                ->get();
          $inscricoesClassificadas = json_decode($inscricoesClassificadas);
          $inscricoesNaoClassificadas = json_decode($inscricoesNaoClassificadas);
          $edital = Edital::find($request->editalId);
        }
        else{
          $inscricao = Inscricao::where('usuarioId', session('id'))
                                  ->where('editalId', $request->editalId)
                                  ->first();
          $isencao = Isencao::where('usuarioId', session('id'))
                              ->where('editalId', $request->editalId)
                              ->first();
          $recursoIsencao = Recurso::where('usuarioId', session('id'))
                                     ->where('editalId', $request->editalId)
                                     ->where('tipo', 'taxa')
                                     ->first();
          $recursoInscricao = Recurso::where('usuarioId', session('id'))
                                       ->where('editalId', $request->editalId)
                                       ->where('tipo', 'classificacao')
                                       ->first();
          $recursoResultado = Recurso::where('usuarioId', session('id'))
                                      ->where('editalId', $request->editalId)
                                      ->where('tipo', 'resultado')
                                      ->first();
          $inscricoesClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->where('nota', '!=', null)
                                                ->get();
          $inscricoesNaoClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->whereNull('nota')
                                                ->get();
          $inscricoesClassificadas = json_decode($inscricoesClassificadas);
          $inscricoesNaoClassificadas = json_decode($inscricoesNaoClassificadas);
          $edital = Edital::find($request->editalId);
        }
        if(Auth::check()){
          if(Auth::user()->tipo == 'candidato'){
            if(($edital->fimIsencao > $mytime) && (!is_null($isencao))){
              $isencao = 'processando';
            }
            if(($edital->fimRecursoIsencao > $mytime) && (!is_null($recursoIsencao))){
              $recursoIsencao = 'processando';
            }
            if(($edital->fimInscricoes > $mytime) &&  (!is_null($inscricao))){
              $inscricao = 'processando';
            }
            if(($edital->fimRecurso > $mytime) && (!is_null($recursoInscricao))){
              $recursoInscricao = 'processando';
            }
            if(($edital->fimRecursoResultado > $mytime) && (!is_null($recursoResultado))){
              $recursoResultado = 'processando';
            }
            $erratas = $edital->errata;
            return view('detalhesEditalCandidato', ['editalId'          => $request->editalId,
                                                    'inscricao'         => $inscricao,
                                                    'isencao'           => $isencao,
                                                    'recursoIsencao'    => $recursoIsencao,
                                                    'recursoInscricao'  => $recursoInscricao,
                                                    'recursoResultado'  => $recursoResultado,
                                                    'edital'            => $edital,
                                                    'mytime'            => $mytime,
                                                    'erratas'           => $erratas,
                                                  ]);

          }
        }
        if(session('tipo') == 'PREG'){

          //

          $inscricoesHomologadas = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->orWhere('homologado', 'rejeitado')
                                              ->where('homologadoDrca', 'aprovado')
                                              ->orWhere('homologadoDrca', 'rejeitado')
                                              ->get();
          $inscricoesNaoHomologadas = Inscricao::where('editalId', $request->editalId)
                                                 ->where('homologado', 'nao')
                                                 ->where('homologadoDrca', 'nao')
                                                 ->get();
          $recursosTaxaHomologados = Recurso::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->orWhere('homologado', 'rejeitado')
                                              ->where('tipo', 'taxa')
                                              ->get();
          $recursosTaxaNaoHomologados = Recurso::where('editalId', $request->editalId)
                                                 ->where('tipo', 'taxa')
                                                 ->where('homologado', 'nao')
                                                 ->get();
          $recursosClassificacaoHomologados = Recurso::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->orWhere('homologado', 'rejeitado')
                                              ->where('tipo', 'classificacao')
                                              ->get();
          $recursosClassificacaoNaoHomologados = Recurso::where('editalId', $request->editalId)
                                                 ->where('tipo', 'classificacao')
                                                 ->where('homologado', 'nao')
                                                 ->get();
          $recursosResultadoHomologados = Recurso::where('editalId', $request->editalId)
                                             ->where('homologado', 'aprovado')
                                             ->orWhere('homologado', 'rejeitado')
                                             ->where('tipo', 'resultado')
                                             ->get();
          $recursosResultadoNaoHomologados = Recurso::where('editalId', $request->editalId)
                                                ->where('tipo', 'resultado')
                                                ->where('homologado', 'nao')
                                                ->get();
          $isencoesHomologadas = Isencao::where('editalId', $request->editalId)
                                          ->where('parecer', 'deferida')
                                          ->orWhere('parecer', 'indeferida')
                                          ->get();
          $isencoesNaoHomologadas = Isencao::where('editalId', $request->editalId)
                                             ->where('parecer', 'nao')
                                             ->get();
          $inscricoesHomologadas = json_decode($inscricoesHomologadas);
          $inscricoesNaoHomologadas = json_decode($inscricoesNaoHomologadas);
          $isencoesHomologadas = json_decode($isencoesHomologadas);
          $isencoesNaoHomologadas = json_decode($isencoesNaoHomologadas);
          $recursosTaxaHomologados = json_decode($recursosTaxaHomologados);
          $recursosTaxaNaoHomologados = json_decode($recursosTaxaNaoHomologados);
          $recursosClassificacaoHomologados = json_decode($recursosClassificacaoHomologados);
          $recursosClassificacaoNaoHomologados = json_decode($recursosClassificacaoNaoHomologados);
          $recursosResultadoHomologados = json_decode($recursosResultadoHomologados);
          $recursosResultadoNaoHomologados = json_decode($recursosResultadoNaoHomologados);
          $erratas = $edital->errata;

          return view('detalhesEditalPREG', ['editalId'                             => $request->editalId,
                                             'inscricao'                            => null,
                                             'isencao'                              => null,
                                             'recursoIsencao'                       => null,
                                             'recursoInscricao'                     => null,
                                             'inscricoesHomologadas'                => sizeof($inscricoesHomologadas),
                                             'inscricoesNaoHomologadas'             => sizeof($inscricoesNaoHomologadas),
                                             'isencoesHomologadas'                  => sizeof($isencoesHomologadas),
                                             'isencoesNaoHomologadas'               => sizeof($isencoesNaoHomologadas),
                                             'recursosTaxaHomologados'              => sizeof($recursosTaxaHomologados),
                                             'recursosTaxaNaoHomologados'           => sizeof($recursosTaxaNaoHomologados),
                                             'recursosClassificacaoHomologados'     => sizeof($recursosClassificacaoHomologados),
                                             'recursosClassificacaoNaoHomologados'  => sizeof($recursosClassificacaoNaoHomologados),
                                             'recursosResultadoHomologados'         => sizeof($recursosResultadoHomologados),
                                             'recursosResultadoNaoHomologados'      => sizeof($recursosResultadoNaoHomologados),
                                             'inscricoesClassificadas'              => sizeof($inscricoesClassificadas),
                                             'inscricoesNaoClassificadas'           => sizeof($inscricoesNaoClassificadas),
                                             'edital'                               => $edital,
                                             'mytime'                               => $mytime,
                                             'erratas'                              => $erratas,
                                             //'vagasInscricoesPorCurso'              => $vagasInscricoesPorCurso,
                                            ]);

        }
        if(session('tipo') == 'DRCA'){
          $inscricoesHomologadas = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->orWhere('homologado', 'rejeitado')
                                              ->where('homologadoDrca', 'aprovado')
                                              ->orWhere('homologadoDrca', 'rejeitado')
                                              ->get();
          $inscricoesNaoHomologadas = Inscricao::where('editalId', $request->editalId)
                                                 ->where('homologado', 'aprovado')
                                                 ->where('homologadoDrca', 'nao')
                                                 ->get();
          $erratas = $edital->errata;
          return view('detalhesEditalDRCA', [ 'editalId'          => $request->editalId,
                                              'inscricao'         => $inscricao,
                                              'isencao'           => $isencao,
                                              'recursoIsencao'    => $recursoIsencao,
                                              'recursoInscricao'  => $recursoInscricao,
                                              'edital'            => $edital,
                                              'mytime'            => $mytime,
                                              'inscricoesHomologadas'                => sizeof($inscricoesHomologadas),
                                              'inscricoesNaoHomologadas'             => sizeof($inscricoesNaoHomologadas),
                                              'erratas'            => $erratas,
                                            ]);

        }
        if(session('tipo') == 'coordenador'){
          $inscricoesClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->where('nota', '!=', null)
                                                ->where('curso', session('cursoId'))
                                                ->get();
          $inscricoesNaoClassificadas = Inscricao::where('editalId', $request->editalId)
                                                ->where('curso', session('cursoId'))
                                                ->whereNull('nota')
                                                ->get();
          $erratas = $edital->errata;

          return view('detalhesEditalCoordenador', ['editalId'                             => $request->editalId,
                                                    'inscricao'                            => $inscricao,
                                                    'isencao'                              => $isencao,
                                                    'recursoIsencao'                       => $recursoIsencao,
                                                    'recursoInscricao'                     => $recursoInscricao,
                                                    'inscricoesClassificadas'              => sizeof($inscricoesClassificadas),
                                                    'inscricoesNaoClassificadas'           => sizeof($inscricoesNaoClassificadas),
                                                    'edital'                               => $edital,
                                                    'mytime'                               => $mytime,
                                                    'erratas'                               => $erratas
                                                ]);

        }


      }

      public function detalhesPorcentagem(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $inscricoesClassificadasPorCurso = DB::table('inscricaos')
               ->where('editalId' , $request->editalId)
               ->whereNotNull('nota')
               ->groupBy('curso')
               ->select('curso', DB::raw('count(*) as total'))
               ->get();
        $inscricoesNaoClassificadasPorCurso = DB::table('inscricaos')
                ->where('editalId' , $request->editalId)
                ->whereNull('nota')
                ->groupBy('curso')
                ->select('curso', DB::raw('count(*) as total'))
                ->get();
        $cursosDasInscricoes = Inscricao::where('editalId', $request->editalId)->select('curso')->get();
        $cursosDasInscricoes = $cursosDasInscricoes->unique('curso');
        $cursosDasInscricoes = $cursosDasInscricoes->toArray();
        $api = new ApiLmts();
        $cursos = $api->getCursos();
        $vagasInscricoesPorCurso = [];
        foreach ($cursosDasInscricoes as $key) {
          for($j = 0; $j < sizeof($cursos); $j++){
            if($cursos[$j]['id'] == $key['curso']){
              array_push($vagasInscricoesPorCurso, [
                      'id'   => $cursos[$j]['id'],
                      'curso' => $cursos[$j]['nome'],
                      'departamento' => $cursos[$j]['departamento'],
                      'classificadas' => 0,
                      'naoClassificadas' => 0,
                    ]);
            }
          }
        }
        for($i = 0; $i < sizeof($inscricoesClassificadasPorCurso); $i++){
          for($j = 0; $j < sizeof($vagasInscricoesPorCurso); $j++){
              if($inscricoesClassificadasPorCurso[$i]->curso == $vagasInscricoesPorCurso[$j]['id']){
                $vagasInscricoesPorCurso[$j]['classificadas'] = $inscricoesClassificadasPorCurso[$i]->total;
              }
          }
        }
        for($i = 0; $i < sizeof($inscricoesNaoClassificadasPorCurso); $i++){
          for($j = 0; $j < sizeof($vagasInscricoesPorCurso); $j++){
              if($inscricoesNaoClassificadasPorCurso[$i]->curso == $vagasInscricoesPorCurso[$j]['id']){
                $vagasInscricoesPorCurso[$j]['naoClassificadas'] = $inscricoesNaoClassificadasPorCurso[$i]->total;
              }
          }
        }
        return view('detalhesPorcentagem', ['vagasInscricoesPorCurso' => $vagasInscricoesPorCurso, 'editalId' => $request->editalId, 'mytime' =>$mytime]);
      }

      public function iframeEditais(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $editais = Edital::where('publicado', 'sim')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        return view('iframeEditais', ['editais' => $editais,
                                      'mytime'  => $mytime,
                                      ]);
      }

      public function publicarEdital(Request $request){
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $edital = Edital::find($request->editalId);
        $edital->publicado = 'sim';
        $edital->dataPublicacao = $mytime;
        $edital->save();
        return redirect()->route('home')->with('jsAlert', 'Edital publicado com sucesso.');
      }

}
