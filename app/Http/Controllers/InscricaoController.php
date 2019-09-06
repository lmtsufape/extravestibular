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


						$dados = DadosUsuario::find(Auth::user()->dados);

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
							'cpfCandidato'					 => $dados->cpf,
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

						$dados = DadosUsuario::find(Auth::user()->dados);

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
							'cpfCandidato'					 => $dados->cpf,
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

						$dados = DadosUsuario::find(Auth::user()->dados);
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
							'cpfCandidato'						 => $dados->cpf,
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
						$dados = DadosUsuario::find(Auth::user()->dados);

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
							'cpfCandidato'						 => $dados->cpf,
							'comprovante'						 => $comprovante,
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return redirect()->route('home')->with('jsAlert', 'Inscrição criada com sucesso.');
	    	  }
		}

	public function inscricaoEscolhida(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);
		$client = new Client();
		$cursos = $client->get('http://app.uag.ufrpe.br/api/api/curso/');
		$cursos = json_decode($cursos->getBody(), true);
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
		return redirect()->route('home')->with('jsAlert', 'Inscrição classificada com sucesso.');
	}

}
