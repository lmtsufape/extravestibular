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
use extravestibular\ApiLmts;
use Auth;
use Illuminate\Support\Facades\Mail;
use extravestibular\Mail\NovaInscricao;
use extravestibular\Mail\ClassificacaoCompleta;
use extravestibular\Mail\LembreteCoordenador;


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
	    	  }

	    	  elseif(!strcmp($request->tipo, 'transferenciaInterna')) {
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

	    	  }

	    	  elseif(!strcmp($request->tipo, 'transferenciaExterna')) {
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

	    	  }

	    	  elseif(!strcmp($request->tipo, 'portadorDeDiploma')) {
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

	    	  }

					$edital = Edital::find($request->editalId);
					$nomeEdital = explode(".pdf", $edital->nome);
					$api = new ApiLmts();
					$emails = $api->getEmailsPreg();
					foreach ($emails as $key) {
						Mail::to($key['email'])->send(new NovaInscricao($nomeEdital[0]));
					}
					return redirect()->route('home')->with('jsAlert', 'Inscrição criada com sucesso.');
		}

	public function cadastroDesempate(Request $request){
		$idsEmpatados = explode(',',$request->idsEmpatados);
		foreach ($idsEmpatados as $key) {
			if($key == ''){
				continue;
			}
			$inscricaoEmpatada = Inscricao::find($key);
			$inscricaoEmpatada->situacao = 'Classificável';
			$inscricaoEmpatada->save();
		}
		$inscricaoAprovadaManha 	 = Inscricao::find($request->aprovadoManha);
		$inscricaoAprovadaTarde 	 = Inscricao::find($request->aprovadoTarde);
		$inscricaoAprovadaNoite 	 = Inscricao::find($request->aprovadoNoite);
		$inscricaoAprovadaIntegral = Inscricao::find($request->aprovadoIntegrao);
		$inscricaoAprovadaEspecial = Inscricao::find($request->aprovadoEspecial);
		if(!empty($inscricaoAprovadaManha)){
			$inscricaoAprovadaManha->situacao = 'Aprovado';
			$inscricaoAprovadaManha->save();
		}
		if(!empty($inscricaoAprovadaTarde)){
			$inscricaoAprovadaTarde->situacao = 'Aprovado';
			$inscricaoAprovadaTarde->save();
		}
		if(!empty($inscricaoAprovadaNoite)){
			$inscricaoAprovadaNoite->situacao = 'Aprovado';
			$inscricaoAprovadaNoite->save();
		}
		if(!empty($inscricaoAprovadaIntegral)){
			$inscricaoAprovadaIntegral->situacao = 'Aprovado';
			$inscricaoAprovadaIntegral->save();
		}
		if(!empty($inscricaoAprovadaEspecial)){
			$inscricaoAprovadaEspecial->situacao = 'Aprovado';
			$inscricaoAprovadaEspecial->save();
		}

		return redirect()->route('home')->with('jsAlert', 'Desempate realizado com sucesso.');
	}

	public function inscricaoEscolhida(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);
		$api = new ApiLmts();
		$cursos = $api->getCursos();
		$curso = $inscricao->curso;
		for($j = 0; $j < sizeof($cursos); $j++){
			if($curso == $cursos[$j]['id']){
				$curso = $cursos[$j]['nome'] . '/' . $cursos[$j]['departamento'];
			}
		}
		$usuario = User::find($inscricao->usuarioId);
		$dados = DadosUsuario::find($usuario->dados);
		$mytime = Carbon::now('America/Recife');
		$mytime = $mytime->toDateString();
		if(!strcmp($request->tipo, 'homologacao')){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'tipo'										 => 'homologacao',
																				 'curso'									 => $curso,
																				 'dados'									 => $dados,
																				 'editalId'								 => $inscricao->editalId,
																				 'mytime'									 => $mytime,
																			  ]);

		}
		if(!strcmp($request->tipo, 'drca')){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'tipo'										 => 'drca',
																				 'curso'									 => $curso,
																				 'dados'									 => $dados,
																				 'editalId'								 => $inscricao->editalId,
																				 'mytime'									 => $mytime,
																			  ]);
		}

		if(!strcmp($request->tipo, 'classificacao')){
			return view('cadastrarClassificacao', ['inscricao'  						 => $inscricao,
																				 	   'tipo'										 => 'classificacao',
																					   'curso'									 => $curso,
																						 'dados'									 => $dados,
																						 'editalId'								 => $inscricao->editalId,
																						 'mytime'									 => $mytime,
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
		$vagas = explode('?', $vagas);
		$ids = [];
	  //prioridade 0 = reintegracao

		$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'manhã')
																						 ->where('tipo', 'reintegracao')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'tarde')
																						 ->where('tipo', 'reintegracao')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'noite')
																						 ->where('tipo', 'reintegracao')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																							  ->where('homologado' , 'aprovado')
																							  ->where('homologadoDrca', 'aprovado')
																							  ->whereNotNull('nota')
																							  ->where('curso', $curso)
																							  ->where('turno', 'integral')
																							  ->where('tipo', 'reintegracao')
																							  ->orderBy('nota', 'desc')
																							  ->get();
		$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																							  ->where('homologado' , 'aprovado')
																							  ->where('homologadoDrca', 'aprovado')
																							  ->whereNotNull('nota')
																							  ->where('curso', $curso)
																							  ->where('turno', 'especial')
																							  ->where('tipo', 'reintegracao')
																							  ->orderBy('nota', 'desc')
																							  ->get();

		$aux = 1;
		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesManhaOrderByDesc as $inscricao) { //manha
			if($aux <= $vagas[0]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
		}

		$aux1 = 1;
		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesTardeOrderByDesc as $inscricao) { //tarde
			if($aux1 <= $vagas[1]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			$aux1++;
		}

		$aux2 = 1;
		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesNoiteOrderByDesc as $inscricao) { //noite
			if($aux2 <= $vagas[2]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			$aux2++;
		}

		$aux3 = 1;
		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //integral
			if($aux3 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			$aux3++;
		}

		$aux4 = 1;
		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //especial
			if($aux4 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			$aux4++;
		}


	  //prioridade 1 = transferenciaInterna

		$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'manhã')
																						 ->where('tipo', 'transferenciaInterna')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'tarde')
																						 ->where('tipo', 'transferenciaInterna')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'noite')
																						 ->where('tipo', 'transferenciaInterna')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'integral')
																								->where('tipo', 'transferenciaInterna')
																								->orderBy('nota', 'desc')
																								->get();
		$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'especial')
																								->where('tipo', 'transferenciaInterna')
																								->orderBy('nota', 'desc')
																								->get();

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesManhaOrderByDesc as $inscricao) { //manha
			if($aux <= $vagas[0]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesTardeOrderByDesc as $inscricao) { //tarde
			if($aux1 <= $vagas[1]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			$aux1++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesNoiteOrderByDesc as $inscricao) { //noite
			if($aux2 <= $vagas[2]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			$aux2++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //integral
			if($aux3 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			$aux3++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //especial
			if($aux4 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			$aux4++;
		}

	 // prioridade 2 = transferenciaExterna, mesmo curso

		$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'manhã')
																						 ->where('tipo', 'transferenciaExterna')
																						 ->where('cursoDeOrigem', $curso)
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'tarde')
																						 ->where('tipo', 'transferenciaExterna')
																						 ->where('cursoDeOrigem', $curso)
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'noite')
																						 ->where('tipo', 'transferenciaExterna')
																						 ->where('cursoDeOrigem', $curso)
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'integral')
																								->where('tipo', 'transferenciaExterna')
	 																						 	->where('cursoDeOrigem', $curso)
																								->orderBy('nota', 'desc')
																								->get();
		$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'especial')
																								->where('tipo', 'transferenciaExterna')
	 																						 	->where('cursoDeOrigem', $curso)
																								->orderBy('nota', 'desc')
																								->get();

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesManhaOrderByDesc as $inscricao) { //manha
			if($aux <= $vagas[0]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesTardeOrderByDesc as $inscricao) { //tarde
			if($aux1 <= $vagas[1]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			$aux1++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesNoiteOrderByDesc as $inscricao) { //noite
			if($aux2 <= $vagas[2]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			$aux2++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //integral
			if($aux3 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			$aux3++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //especial
			if($aux4 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			$aux4++;
		}

	 // prioridade 3 = transferenciaExterna, curso afim

		$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'manhã')
																						 ->where('tipo', 'transferenciaExterna')
																						 ->where('cursoDeOrigem', '!=',$curso)
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'tarde')
																						 ->where('tipo', 'transferenciaExterna')
																						 ->where('cursoDeOrigem', '!=',$curso)
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'noite')
																						 ->where('tipo', 'transferenciaExterna')
																						 ->where('cursoDeOrigem', '!=',$curso)
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'integral')
																								->where('tipo', 'transferenciaExterna')
	 																						 	->where('cursoDeOrigem', '!=',$curso)
																								->orderBy('nota', 'desc')
																								->get();
		$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'especial')
																								->where('tipo', 'transferenciaExterna')
	 																						 	->where('cursoDeOrigem', '!=',$curso)
																								->orderBy('nota', 'desc')
																								->get();

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesManhaOrderByDesc as $inscricao) { //manha
			if($aux <= $vagas[0]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesTardeOrderByDesc as $inscricao) { //tarde
			if($aux1 <= $vagas[1]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			$aux1++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesNoiteOrderByDesc as $inscricao) { //noite
			if($aux2 <= $vagas[2]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			$aux2++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //integral
			if($aux3 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			$aux3++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //especial
			if($aux4 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			$aux4++;
		}

	 // prioridade 4 = portadorDeDiploma

		$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'manhã')
																						 ->where('tipo', 'portadorDeDiploma')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'tarde')
																						 ->where('tipo', 'portadorDeDiploma')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																						 ->where('homologado' , 'aprovado')
																						 ->where('homologadoDrca', 'aprovado')
																						 ->whereNotNull('nota')
																						 ->where('curso', $curso)
																						 ->where('turno', 'noite')
																						 ->where('tipo', 'portadorDeDiploma')
																						 ->orderBy('nota', 'desc')
																						 ->get();
		$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'integral')
																								->where('tipo', 'portadorDeDiploma')
																								->orderBy('nota', 'desc')
																								->get();
		$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->whereNotNull('nota')
																								->where('curso', $curso)
																								->where('turno', 'especial')
																								->where('tipo', 'portadorDeDiploma')
																								->orderBy('nota', 'desc')
																								->get();

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesManhaOrderByDesc as $inscricao) { //manha
			if($aux <= $vagas[0]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[0] = $vagas[0] - 1;
			}
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesTardeOrderByDesc as $inscricao) { //tarde
			if($aux1 <= $vagas[1]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[1] = $vagas[1] - 1;
			}
			$aux1++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesNoiteOrderByDesc as $inscricao) { //noite
			if($aux2 <= $vagas[2]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[2] = $vagas[2] - 1;
			}
			$aux2++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //integral
			if($aux3 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[3] = $vagas[3] - 1;
			}
			$aux3++;
		}

		$ultimaNota = 0;
		$ultimoId = 0;
		$flagEmpate = false;

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //especial
			if($aux4 <= $vagas[3]){
				$inscricao->situacao = 'Aprovado';
				$ultimaNota = $inscricao->nota;
				$ultimoId = $inscricao->id;
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			else{
				if($ultimaNota == $inscricao->nota){
					if($flagEmpate == false){
						array_push($ids, $ultimoId);
						array_push($ids, $inscricao->id);
						$flagEmpate = true;
					}
					else{
						array_push($ids, $inscricao->id);
					}
				}
				$inscricao->situacao = 'Classificável';
				$inscricao->save();
				$vagas[4] = $vagas[4] - 1;
			}
			$aux4++;
		}


		if(!empty($ids)) {
			return $ids;
		}
		else{
			return null;
		}
	}

	private function verificarCompletudeClassificacoes($editalId){
		$naoClassificadas = Inscricao::where('editalId', $editalId)
																		->whereNull('nota')
																		->first();

		if(is_null($naoClassificadas)){
			$edital = Edital::find($editalId);
			$nomeEdital = explode(".pdf", $edital->nome);
			$api = new ApiLmts();
			$emails = $api->getEmailsPreg();
			foreach ($emails as $key) {
				Mail::to($key['email'])->send(new ClassificacaoCompleta($nomeEdital[0]));
			}

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
																								 ->where('curso', $inscricao->curso)
																								 ->whereNull('nota')
																								 ->first();
		if(is_null($inscricoesQueFaltamClassificar)){
			$ids = $this->aprovarInscricoes($inscricao->editalId, $inscricao->curso);
			if(!is_null($ids)){
				$inscricoesManha 	  = Inscricao::where('turno', 'manhã')->whereIn('id',$ids)->get();
				$inscricoesTarde 	  = Inscricao::where('turno', 'tarde')->whereIn('id',$ids)->get();
				$inscricoesNoite 	  = Inscricao::where('turno', 'noite')->whereIn('id',$ids)->get();
				$inscricoesIntegral = Inscricao::where('turno', 'integral')->whereIn('id',$ids)->get();
				$inscricoesEspecial = Inscricao::where('turno', 'especial')->whereIn('id',$ids)->get();
				$mytime = Carbon::now('America/Recife');
				$mytime = $mytime->toDateString();

				return view('cadastrarDesempate', [
					'inscricoesManha' => $inscricoesManha,
					'inscricoesTarde' => $inscricoesTarde,
					'inscricoesNoite' => $inscricoesNoite,
					'inscricoesIntegral' => $inscricoesIntegral,
					'inscricoesEspecial' => $inscricoesEspecial,
					'idsEmpatados' => $ids,
					'editalId' => $inscricao->editalId,
					'mytime' => $mytime,
				]);
			}

			$this->verificarCompletudeClassificacoes($inscricao->editalId);
			return redirect()->route('home')->with('jsAlert', 'Inscrição classificada com sucesso.');
		}
		else{
			return redirect()->route('home')->with('jsAlert', 'Inscrição classificada com sucesso.');
		}
	}

	public function notificarCoordenador(Request $request){
		$edital = Edital::find($request->editalId);
		$nomeEdital = explode(".pdf", $edital->nome);
		$api = new ApiLmts();
		$emails = $api->getEmailsCoordenadorPorCurso($request->cursoId);
		foreach ($emails as $key) {
			Mail::to($key['email'])->send(new LembreteCoordenador($nomeEdital[0]));
		}
		return null;
	}

}
