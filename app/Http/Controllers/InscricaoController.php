<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Http\Controllers\Controller;
use extravestibular\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use extravestibular\Edital;
use extravestibular\DadosUsuario;
use extravestibular\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use extravestibular\Mail\NovaInscricao;
use Carbon\Carbon;



class InscricaoController extends Controller
{

	public function cadastroInscricao(Request $request)
	  	 {

					 $validatedData = $request->validate([ 'declaracaoDeVinculo' 		=> ['nullable', 'mimes:pdf','max:20000'],
																								 'historicoEscolar' 			=> ['required', 'mimes:pdf','max:20000'],
																						     'programaDasDisciplinas' => ['nullable', 'mimes:pdf','max:20000'],
																						     'curriculo' 				 			=> ['nullable', 'mimes:pdf','max:20000'],
																						     'enem' 						 			=> ['nullable', 'mimes:pdf','max:20000'],
																								 'endereco'          			=> ['required', 'string', 'max:255'],
																								 'num'               			=> ['required'],
																								 'bairro'            			=> ['required', 'max:255'],
																								 'cidade'            			=> ['required', 'max:255'],
																								 'uf'                			=> ['required', 'size:2'],
																								 'polo'									  => ['nullable', 'string', 'max:255'],
																	 					  	 'turno'								  => ['required', 'string', 'max:255'],
																	 					   	 'cursoDeOrigem'					=> ['required', 'string', 'max:255'],
																	 					   	 'instituicaoDeOrigem'    => ['required', 'string', 'max:255'],
																	 					   	 'naturezaDaIes'					=> ['required', 'string', 'max:255'],

																							 ]);

					$mytime = Carbon::now('America/Recife');
 	        $mytime = $mytime->toDateString();
			 		$edital = Edital::find($request->editalId);
					$existeInscricao = Inscricao::where('editalId', $request->editalId)
																				->where('usuarioId', Auth::user()->id)
																				->first();
					if(!is_null($existeInscricao)){
						return redirect()->route('home')->with('jsAlert', 'Você já possui uma inscrição cadastrada no edital.');
					}
					if(!(($edital->inicioInscricoes <= $mytime) && ($edital->fimInscricoes >= $mytime))){
						return redirect()->route('home')->with('jsAlert', 'Este edital não está no periodo correto.');
					}


	  	 	  if(!strcmp($request->tipo, 'reintegracao')){

		  	    $file = $request->historicoEscolar;
		  	    $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
						$comprovante = '';
						if($request->comprovante == 'isento'){
							$comprovante = 'isento';
						}
						else{
							$file = $request->comprovante;
							$path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
							Storage::putFileAs($path, $file, 'comprovante.pdf');
							$comprovante = $path . '/comprovante.pdf';
						}																																									//criar inscricao no banco



					  Inscricao::create([
					  	'usuarioId'              => Auth::user()->id,
					  	'tipo'					  			 => $request->tipo,
					  	'editalId'               => $request->editalId,
					  	'historicoEscolar'       => $path . '/historicoEscolar.pdf',
					  	'curso'								 	 => $request->curso,
					  	'polo'									 => $request->polo,
					  	'turno'								   => $request->turno,
					  	'cursoDeOrigem'					 => $request->cursoDeOrigem,
					  	'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
					  	'naturezaDaIes'					 => $request->naturezaDaIes,
							'endereco'							 => $request->endereco,
							'num'									   => $request->num,
							'bairro'								 => $request->bairro,
							'cidade'								 => $request->cidade,
							'uf'								  	 => $request->uf,
							'homologado'						 => 'nao',
							'homologadoDrca'			 	 => 'nao',
							'coeficienteDeRendimento'=> 'nao',
							'comprovante'						 => $comprovante,
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
			      return redirect()->route('home')->with('jsAlert', 'Inscrição criada com sucesso.');
	    	  }
	    	  if(!strcmp($request->tipo, 'transferenciaInterna')) {

					  $file = $request->historicoEscolar;
			  	  $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  $file = $request->declaracaoDeVinculo;
			  	  $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');
						$comprovante = '';
						if($request->comprovante == 'isento'){
							$comprovante = 'isento';
						}
						else{
							$file = $request->comprovante;
							$path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
							Storage::putFileAs($path, $file, 'comprovante.pdf');
							$comprovante = $path . '/comprovante.pdf';
						}


					  Inscricao::create([
					  	'usuarioId'              => Auth::user()->id,
					  	'tipo'					   			 => $request->tipo,
					  	'editalId'               => $request->editalId,
					  	'historicoEscolar'       => $path . '/historicoEscolar.pdf',
					  	'declaracaoDeVinculo'    => $path . '/declaracaoDeVinculo.pdf',
							'curso'									 => $request->curso,
							'polo'									 => $request->polo,
							'turno'									 => $request->turno,
							'cursoDeOrigem'					 => $request->cursoDeOrigem,
							'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
							'naturezaDaIes'					 => $request->naturezaDaIes,
							'endereco'							 => $request->endereco,
							'num'									   => $request->num,
							'bairro'								 => $request->bairro,
							'cidade'								 => $request->cidade,
							'uf'								  	 => $request->uf,
							'homologado'						 => 'nao',
							'homologadoDrca'			 	 => 'nao',
							'coeficienteDeRendimento'=> 'nao',
							'comprovante'						 => $comprovante,
						]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return redirect()->route('home')->with('jsAlert', 'Inscrição criada com sucesso.');
	    	  }
	    	  if(!strcmp($request->tipo, 'transferenciaExterna')) {

					  $file = $request->historicoEscolar;
			  	  $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  $file = $request->declaracaoDeVinculo;
			  	  $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');
					  $file = $request->programaDasDisciplinas;
			  	  $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');
					  $file = $request->curriculo;
			  	  $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'curriculo.pdf');
						$comprovante = '';
						if($request->comprovante == 'isento'){
							$comprovante = 'isento';
						}
						else{
							$file = $request->comprovante;
							$path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
							Storage::putFileAs($path, $file, 'comprovante.pdf');
							$comprovante = $path . '/comprovante.pdf';
						}

					  Inscricao::create([
					  	'usuarioId'              => Auth::user()->id,
					  	'tipo'         			 		 => $request->tipo,
					  	'editalId'               => $request->editalId,
					  	'historicoEscolar'       => $path . '/historicoEscolar.pdf',
					  	'declaracaoDeVinculo'    => $path . '/declaracaoDeVinculo.pdf',
					  	'programaDasDisciplinas' => $path . '/programaDasDisciplinas.pdf',
					  	'curriculo'              => $path . '/curriculo.pdf',
							'curso'									 => $request->curso,
							'polo'									 => $request->polo,
							'turno'									 => $request->turno,
							'cursoDeOrigem'					 => $request->cursoDeOrigem,
							'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
							'naturezaDaIes'					 => $request->naturezaDaIes,
							'endereco'							 => $request->endereco,
							'num'									   => $request->num,
							'bairro'								 => $request->bairro,
							'cidade'								 => $request->cidade,
							'uf'								  	 => $request->uf,
							'homologado'						 => 'nao',
							'homologadoDrca'			 	 => 'nao',
							'coeficienteDeRendimento'=> 'nao',
							'comprovante'						 => $comprovante,
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return redirect()->route('home')->with('jsAlert', 'Inscrição criada com sucesso.');
	    	  }
	    	  if(!strcmp($request->tipo, 'portadorDeDiploma')) {
    	  	  $file = $request->historicoEscolar;
		  	    $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  $file = $request->declaracaoDeVinculo;
		  	    $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');
					  $file = $request->programaDasDisciplinas;
		  	    $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');
					  $file = $request->enem;
		  	    $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'enem.pdf');
						$comprovante = '';
						if($request->comprovante == 'isento'){
							$comprovante = 'isento';
						}
						else{
							$file = $request->comprovante;
							$path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
							Storage::putFileAs($path, $file, 'comprovante.pdf');
							$comprovante = $path . '/comprovante.pdf';
						}

					  Inscricao::create([
					  	'usuarioId'              => Auth::user()->id,
					  	'tipo'					    		 => $request->tipo,
					  	'editalId'               => $request->editalId,
					  	'historicoEscolar'       => $path . '/historicoEscolar.pdf',
					  	'declaracaoDeVinculo'    => $path . '/declaracaoDeVinculo.pdf',
					  	'programaDasDisciplinas' => $path . '/programaDasDisciplinas.pdf',
					  	'enem'                   => $path . '/enem.pdf',
							'curso'									 => $request->curso,
							'polo'									 => $request->polo,
							'turno'									 => $request->turno,
							'cursoDeOrigem'					 => $request->cursoDeOrigem,
							'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
							'naturezaDaIes'					 => $request->naturezaDaIes,
							'endereco'							 => $request->endereco,
							'num'									   => $request->num,
							'bairro'								 => $request->bairro,
							'cidade'								 => $request->cidade,
							'uf'								  	 => $request->uf,
							'homologado'						 => 'nao',
							'homologadoDrca'			 	 => 'nao',
							'coeficienteDeRendimento'=> 'nao',
							'comprovante'						 => $comprovante,
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return redirect()->route('home')->with('jsAlert', 'Inscrição criada com sucesso.');
	    	  }
		}

	public function cadastroDesempate(Request $request){
		$inscricaoAprovada = Inscricao::find($request->inscricaoAprovada);
		$inscricaoClassificavel = Inscricao::find($request->inscricaoClassificavel);
		$inscricaoAprovada->situacao = 'Aprovado';
		$inscricaoClassificavel->situacao = 'Classificável';
		$inscricaoAprovada->save();
		$inscricaoClassificavel->save();
		return redirect()->route('home')->with('jsAlert', 'Desempate realizado com sucesso.');
	}

	public function inscricaoEscolhida(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);
		$api = new ApiLmts();
		$cursos = $api->getCursos();
		$curso = $inscricao->curso;
		for($j = 0; $j < sizeof($cursos); $j++){
			if($curso == $cursos[$j]['id']){
				$curso = $cursos[$j]['nome'] . '/' . $cursos[$j]['unidade'];
			}
		}
		$usuario = User::find($inscricao->usuarioId);
		$dados = DadosUsuario::find($usuario->dados);

		if(!strcmp($request->tipo, 'homologacao')){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'tipo'										 => 'homologacao',
																				 'curso'									 => $curso,
																				 'dados'									 => $dados,
																			  ]);

		}
		if(!strcmp($request->tipo, 'drca')){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'tipo'										 => 'drca',
																				 'curso'									 => $curso,
																				 'dados'									 => $dados,
																			  ]);
		}

		if(!strcmp($request->tipo, 'classificacao')){
			return view('cadastrarClassificacao', ['inscricao'  						 => $inscricao,
																				 	   'tipo'										 => 'classificacao',
																					   'curso'									 => $curso,
																						 'dados'									 => $dados,
																			     	]);
		}

	}

	public function homologarInscricao(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);

		if(!strcmp($request->tipo, 'homologacao')){
			if(!strcmp($request->homologado, 'rejeitado')){
				$inscricao->homologado = 'rejeitado';
				$inscricao->motivoRejeicao = $request->motivoRejeicao;
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso.');
			}
			else{
				$inscricao->homologado = 'aprovado';
				if($inscricao->tipo != 'reintegracao'){
					$inscricao->homologadoDrca = 'aprovado';
				}
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso.');
			}
		}
		if(!strcmp($request->tipo, 'drca')){
			if(!strcmp($request->homologado, 'rejeitado')){
				$inscricao->homologadoDrca = 'rejeitado';
				$inscricao->motivoRejeicao = $request->motivoRejeicao;
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso.');
			}
			else{
				$inscricao->homologadoDrca = 'aprovado';
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso.');
			}
		}
	}

	public function downloadArquivo(Request $request){
    return response()->download(storage_path('app/public/'.$request->file));
	}

	private function aprovarInscricoes($editalId, $curso){
		$edital = Edital::find($editalId);
		$vagas = explode('!',$edital->vagas);
		for($i = 0; $i < sizeof($vagas); $i++){
			$vagas[$i] = explode(":",$vagas[$i]);
		}
		for($i = 0; $i < sizeof($vagas); $i++){
			if($vagas[$i][0] == $curso){
				$vagas = $vagas[$i][1];
				break;
			}
		}

		$inscricoesOrderByDesc = Inscricao::where('editalId', $editalId)
																				->where('homologado' , 'aprovado')
																				->where('homologadoDrca', 'aprovado')
																				->whereNotNull('nota')
																				->where('curso', $curso)
																				->orderBy('nota', 'desc')
																				->get();
		$aux = 1;
		$ultimaNota = 0;
		$ultimoId = 0;
		$idEmpate1 = 0;
		$idEmpate2 = 0;
		$flagEmpate = false;
		foreach ($inscricoesOrderByDesc as $inscricao) {
			if($aux <= $vagas){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
			}
			else{
				$aux = $ultimaNota . "!";
				$aux1 = $inscricao->nota . "!";
				if($aux = $aux1){
					$idEmpate1 = $ultimoId;
					$idEmpate2 = $inscricao->id;
					$flagEmpate = true;

				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
			}
			$aux++;
		}

		if ($flagEmpate) {
			return $ids = [$idEmpate1, $idEmpate2];
		}
	}

	public function cadastroClassificacao(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);
		$validatedData = $request->validate([ 'coeficienteDeRendimento' 		=> ['required', 'numeric'],
																					'completadas' 								=> ['required', 'numeric'],
																					'materias' 										=> ['required', 'numeric'],
																				]);



		$coeficienteDeRendimento = str_replace(",",".",$request->coeficienteDeRendimento);
		$inscricao->coeficienteDeRendimento = $coeficienteDeRendimento;
		$completadas = floatval($request->completadas);
		$materias = floatval($request->materias);
		$completadas = $completadas * 100;
		$conclusaoDoCurso = $completadas/$materias;
		$conclusaoDoCurso = $conclusaoDoCurso/10;
		$conclusaoDoCurso = number_format((float)$conclusaoDoCurso, 1, '.', '');
		$inscricao->conclusaoDoCurso = (String) $conclusaoDoCurso;
		$nota =  ($conclusaoDoCurso + $coeficienteDeRendimento) / 2;
		$nota = number_format((float)$nota, 1, '.', '');
		$inscricao->nota = $nota;
		$inscricao->save();
		$inscricoesQueFaltamClassificar = Inscricao::where('editalId' , $inscricao->editalId)
																								 ->where('homologado' , 'aprovado')
																								 ->where('homologadoDrca', 'aprovado')
																								 ->whereNull('nota')
																								 ->first();


		if(is_null($inscricoesQueFaltamClassificar)){
			$ids = $this->aprovarInscricoes($inscricao->editalId, $inscricao->curso);
			$empate1 = Inscricao::find($ids[0]);
			$empate2 = Inscricao::find($ids[1]);
			return view('desempate', [
																'inscricao1' => $empate1,
																'inscricao2' => $empate2,
															 ]);
		}
		else{
			return redirect()->route('home')->with('jsAlert', 'Inscrição classificada com sucesso.');
		}
	}

}
