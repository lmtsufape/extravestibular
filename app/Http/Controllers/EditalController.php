<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Edital;
use App\Inscricao;
use App\Recurso;
use App\Isencao;
use App\Erratas;
use App\User;
use App\DadosUsuario;
use Lmts\src\controller\LmtsApi;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;
use Auth;
use Session;


class EditalController extends Controller{

      private $api;

      public function __construct()
      {
        $this->api = new LmtsApi();
      }

      public function novoEdital(){
        $this->authorize('gerenciarEdital', Edital::class);

        $cursos = $this->api->getCursos();
        if(!is_null($cursos)){
          return view('cadastrarEdital', ['cursos' => $cursos]);
        }
        else{
          return redirect()->route('home')->with('jsAlert', 'Serviço indisponivel no momento.');
        }
      }

      public function editarEdital(Request $request){
        $this->authorize('gerenciarEdital', Edital::class);

        $edital = Edital::find($request->editalId);


        $vagas = $edital->vagas;
        $vagas = explode('!', $vagas);
        $aux = [];
        foreach($vagas as $key){
          if($key != ''){
            array_push($aux, $key);
          }
        }
        $vagas = $aux;
        for($i = 0; $i < sizeof($vagas); $i++){
          $vagas[$i] = explode(':', $vagas[$i]);
        }
        $aux =[];
        for($i = 0; $i < sizeof($vagas); $i++){
          array_push($aux, ['id' => $vagas[$i][0], 'vagas' => $vagas[$i][1]]);
        }
        $vagas = $aux;
        for($i = 0; $i < sizeof($vagas); $i++){
          $vagas[$i]['vagas'] = explode('?', $vagas[$i]['vagas']);
        }

        $cursos = $this->api->getCursos();

        if(!is_null($cursos)){
          return view('editarEdital', ['edital' => $edital,
                                       'cursos' => $cursos,
                                       'vagasDisponiveis' => $vagas,
                                       'editalId' => $request->editalId,
                                      ]);
        }
        else{
          return redirect()->route('home')->with('jsAlert', 'Serviço indisponivel no momento.');
        }
      }

      public function cadastroEditarEdital(Request $request){
        $this->authorize('gerenciarEdital', Edital::class);
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
            $validatedData = $request->validate([
                                                  'pdfEdital'               => ['required', 'mimes:pdf', 'max:20000'],
                                                  'inicioIsencao'           => ['required', 'date'],
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
                                                  'descricao'               => ['required', 'string', 'min:5', 'max:600'],
                                                  'checkVagasExistentes'    => ['required', 'string'],
                                                ]);
        }
        //validate para data oks
        $validatedData = $request->validate([
                                                  'pdfEdital'               => ['required', 'mimes:pdf', 'max:20000'],
                                                  'inicioIsencao'           => ['required', 'date'],
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
                                                  'descricao'               => ['required', 'string', 'min:5', 'max:600'],
                                                  'checkVagasExistentes'    => ['required', 'string'],
                                            ]);

        $file = $request->pdfEdital;
        $edital = Edital::find($request->editalId);
        $path = 'editais/';
        Storage::putFileAs($path, $file, $edital->nome);
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



        $edital->vagas =                 $vagas;
        $edital->pdfEdital =             $path . $edital->nome;
        $edital->inicioInscricoes =      $request->inicioInscricoes;
        $edital->fimInscricoes =         $request->fimInscricoes;
        $edital->inicioRecurso =         $request->inicioRecurso;
        $edital->fimRecurso =            $request->fimRecurso;
        $edital->inicioIsencao =         $request->inicioIsencao;
        $edital->fimIsencao =            $request->fimIsencao;
        $edital->inicioRecursoIsencao =  $request->inicioRecursoIsencao;
        $edital->fimRecursoIsencao =     $request->fimRecursoIsencao;
        $edital->resultado =             $request->resultado;
        $edital->descricao =             $request->descricao;

        $edital->save();


        return redirect()->route('home')->with('jsAlert', 'Edital modificado com sucesso.');



      }

      public function cadastroEdital(Request $request){
        $this->authorize('gerenciarEdital', Edital::class);
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
                                                  'inicioIsencao'           => ['required', 'date'],
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
                                                  'descricao'               => ['required', 'string', 'min:5', 'max:600'],
                                                  'checkVagasExistentes'    => ['required', 'string'],
                                                ]);
        }
        //validate para data oks
        $validatedData = $request->validate([ 'nome'                    => ['required', 'string', 'max:255', 'unique:editals'],
                                              'pdfEdital'               => ['required', 'mimes:pdf', 'max:20000'],
                                              'inicioIsencao'           => ['required', 'date'],
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
                                              'descricao'               => ['required', 'string', 'min:5', 'max:600'],
                                              'checkVagasExistentes'    => ['required', 'string'],
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

       return redirect()->route('home')->with('jsAlert', 'Novo edital criado com sucesso!');


      }

      public function deleteEdital(Request $request){
        $this->authorize('gerenciarEdital', Edital::class);
        $edital = Edital::find($request->editalId);
        $edital->delete();
        return redirect()->route('home')->with('jsAlert', 'Edital excluído com sucesso!');
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

          $cursos = $this->api->getCursos();
          if(is_null($cursos)){
            return redirect()->route('home')->with('jsAlert', 'Serviço indisponível no momento.');
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
      					$cursosDisponiveis[$i][0] = $cursos[$j]['nome'] . ' / ' . $cursos[$j]['departamento'];
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
          $inscricoesHomologadas = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', '!=','nao')
                                              ->paginate(10);
          return view('listaInscricoes', ['inscricoes'  => $inscricoesDisponiveis,
                                          'homologadas' => $inscricoesHomologadas,
                                          'tipo'        => 'homologacao',
                                          'editalId'    => $request->editalId,
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
                                                ->where('curso', session('cursoId'))
                                                ->where('homologado', 'aprovado')
                                                ->where('homologadoDrca', 'aprovado')
                                                ->where('situacao', '!=', 'processando')
                                                ->orderBy('classificacao', 'asc')
                                                ->paginate(20);
          $inscricoesDisponiveis = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
                                              ->where('homologadoDrca', 'aprovado')
                                              ->where('situacao', 'processando')
                                              ->where('curso', session('cursoId'))
                                              ->paginate(20);
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
        $this->authorize('gerenciarEdital', Edital::class);
        $inscricoes = Inscricao::where('editalId', $request->editalId)
                                 ->orderBy('curso', 'desc')
                                 ->orderBy('situacao', 'asc')
                                 ->orderBy('nota', 'desc')
                                 ->get();
        $edital = Edital::find($request->editalId);

        $cursos = $this->api->getCursos();
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $data = [
                 'inscricoes' => $inscricoes,
                 'edital'     => $edital,
                 'cursos'     => $cursos,
                 'mytime'     => $mytime,
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
                                                ->where('homologado', 'aprovado')
                                                ->where('homologadoDrca', 'aprovado')
                                                ->where('situacao', '!=', 'processando')
                                                ->get();
          $inscricoesNaoClassificadas = Inscricao::where('editalId', $request->editalId)
                                                   ->where('homologado', 'aprovado')
                                                   ->where('homologadoDrca', 'aprovado')
                                                   ->where('situacao', 'processando')
                                                   ->get();
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
                                              ->where('tipo', 'taxa')
                                              ->where('homologado', 'aprovado')
                                              ->orWhere('homologado', 'rejeitado')
                                              ->get();
          $recursosTaxaNaoHomologados = Recurso::where('editalId', $request->editalId)
                                                 ->where('tipo', 'taxa')
                                                 ->where('homologado', 'nao')
                                                 ->get();
          $recursosClassificacaoHomologados = Recurso::where('editalId', $request->editalId)
                                              ->where('tipo', 'classificacao')
                                              ->where('homologado', 'aprovado')
                                              ->orWhere('homologado', 'rejeitado')
                                              ->get();
          $recursosClassificacaoNaoHomologados = Recurso::where('editalId', $request->editalId)
                                                 ->where('tipo', 'classificacao')
                                                 ->where('homologado', 'nao')
                                                 ->get();
          $recursosResultadoHomologados = Recurso::where('editalId', $request->editalId)
                                              ->where('tipo', 'resultado')
                                             ->where('homologado', 'aprovado')
                                             ->orWhere('homologado', 'rejeitado')
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
          $erratas = $edital->errata;

          return view('detalhesEditalPREG', ['editalId'                             => $request->editalId,
                                             'inscricao'                            => null,
                                             'isencao'                              => null,
                                             'recursoIsencao'                       => null,
                                             'recursoInscricao'                     => null,
                                             'inscricoesHomologadas'                => $inscricoesHomologadas->count(),
                                             'inscricoesNaoHomologadas'             => $inscricoesNaoHomologadas->count(),
                                             'isencoesHomologadas'                  => $isencoesHomologadas->count(),
                                             'isencoesNaoHomologadas'               => $isencoesNaoHomologadas->count(),
                                             'recursosTaxaHomologados'              => $recursosTaxaHomologados->count(),
                                             'recursosTaxaNaoHomologados'           => $recursosTaxaNaoHomologados->count(),
                                             'recursosClassificacaoHomologados'     => $recursosClassificacaoHomologados->count(),
                                             'recursosClassificacaoNaoHomologados'  => $recursosClassificacaoNaoHomologados->count(),
                                             'recursosResultadoHomologados'         => $recursosResultadoHomologados->count(),
                                             'recursosResultadoNaoHomologados'      => $recursosResultadoNaoHomologados->count(),
                                             'inscricoesClassificadas'              => $inscricoesClassificadas->count(),
                                             'inscricoesNaoClassificadas'           => $inscricoesNaoClassificadas->count(),
                                             'edital'                               => $edital,
                                             'mytime'                               => $mytime,
                                             'erratas'                              => $erratas,
                                             //'vagasInscricoesPorCurso'              => $vagasInscricoesPorCurso,
                                            ]);

        }
        if(session('tipo') == 'DRCA'){
          $inscricoesHomologadas = Inscricao::where('editalId', $request->editalId)
                                              ->where('homologado', 'aprovado')
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
                                                ->where('curso', session('cursoId'))
                                                ->where('homologado', 'aprovado')
                                                ->where('homologadoDrca', 'aprovado')
                                                ->where('situacao', '!=', 'processando')
                                                ->get();
          $inscricoesNaoClassificadas = Inscricao::where('editalId', $request->editalId)
                                                   ->where('curso', session('cursoId'))
                                                   ->where('homologado', 'aprovado')
                                                   ->where('homologadoDrca', 'aprovado')
                                                   ->where('situacao', 'processando')
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
        $this->authorize('gerenciarEdital', Edital::class);
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

        $cursos = $this->api->getCursos();
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
        $this->authorize('gerenciarEdital', Edital::class);
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $edital = Edital::find($request->editalId);
        $edital->publicado = 'sim';
        $edital->dataPublicacao = $mytime;
        $edital->save();
        return redirect()->route('home')->with('jsAlert', 'Edital publicado com sucesso!');
      }

}
