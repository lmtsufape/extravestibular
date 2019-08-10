<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Http\Controllers\Controller;
use extravestibular\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use extravestibular\Edital;
use Auth;
use Illuminate\Support\Facades\Mail;
use extravestibular\Mail\NovaInscricao;

class InscricaoController extends Controller
{

	public function cadastroInscricao(Request $request)
	  	 {
	  	 	  if(!strcmp($request->tipo, 'reintegracao')){

		  	    $file = $request->historicoEscolar;
		  	    $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  																				//criar inscricao no banco

					  Inscricao::create([
					  	'usuarioId'             => Auth::user()->id,
					  	'tipo'					  			=> $request->tipo,
					  	'editalId'              => $request->editalId,
					  	'historicoEscolar'      => $path . '/historicoEscolar.pdf',
					  	'curso'									=> $request->curso,
					  	'polo'									=> $request->polo,
					  	'turno'									=> $request->turno,
					  	'cursoDeOrigem'					=> $request->cursoDeOrigem,
					  	'instituicaoDeOrigem'   => $request->instituicaoDeOrigem,
					  	'naturezaDaIes'					=> $request->naturezaDaIes,
					  	'enderecoIes'						=> $request->enderecoIes,
							'homologado'						=> 'nao',
							'homologadoDrca'			 	=> 'nao',
							'coeficienteDeRendimento'=> 'nao',
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
			      return view('home');
	    	  }
	    	  if(!strcmp($request->tipo, 'transferenciaInterna')) {

					  $file = $request->historicoEscolar;
			  	  $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  $file = $request->declaracaoDeVinculo;
			  	  $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');

					  Inscricao::create([
					  	'usuarioId'             => Auth::user()->id,
					  	'tipo'					   			=> $request->tipo,
					  	'editalId'              => $request->editalId,
					  	'historicoEscolar'      => $path . '/historicoEscolar.pdf',
					  	'declaracaoDeVinculo'   => $path . '/declaracaoDeVinculo.pdf',
							'curso'									=> $request->curso,
							'polo'									=> $request->polo,
							'turno'									=> $request->turno,
							'cursoDeOrigem'					=> $request->cursoDeOrigem,
							'instituicaoDeOrigem'   => $request->instituicaoDeOrigem,
							'naturezaDaIes'					=> $request->naturezaDaIes,
							'enderecoIes'						=> $request->enderecoIes,
							'homologado'						=> 'nao',
							'homologadoDrca'			 	=> 'nao',
							'coeficienteDeRendimento'=> 'nao',
						]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return view('home');
	    	  }
	    	  if(!strcmp($request->tipo, 'transferenciaExterna')) {

					  $file = $request->historicoEscolar;
			  	  $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  $file = $request->declaracaoDeVinculo;
			  	  $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');
					  $file = $request->programaDasDisciplinas;
			  	  $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');
					  $file = $request->curriculo;
			  	  $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'curriculo.pdf');

					  Inscricao::create([
					  	'usuarioId'              => Auth::user()->id,
					  	'tipo'         			 		 => $request->tipo,
					  	'editalId'               => $request->editalId,
					  	'historicoEscolar'       => $path . '/historicoEscolar.pdf',
					  	'declaracaoDeVinculo'    => $path . '/declaracaoDeVinculo.pdf',
					  	'programaDasDisciplinas' => $path . '/programaDasDisciplinas.pdf',
					  	'curriculo'              => $path . '/curriculo.pdf',
							'curso'									=> $request->curso,
							'polo'									=> $request->polo,
							'turno'									=> $request->turno,
							'cursoDeOrigem'					=> $request->cursoDeOrigem,
							'instituicaoDeOrigem'   => $request->instituicaoDeOrigem,
							'naturezaDaIes'					=> $request->naturezaDaIes,
							'enderecoIes'						=> $request->enderecoIes,
							'homologado'						=> 'nao',
							'homologadoDrca'			 	=> 'nao',
							'coeficienteDeRendimento'=> 'nao',
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return view('home');
	    	  }
	    	  if(!strcmp($request->tipo, 'portadorDeDiploma')) {
    	  	  $file = $request->historicoEscolar;
		  	    $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
					  $file = $request->declaracaoDeVinculo;
		  	    $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');
					  $file = $request->programaDasDisciplinas;
		  	    $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');
					  $file = $request->enem;
		  	    $path = 'inscricao/' . Auth::user()->id . '/' . $request->editalId;
					  Storage::putFileAs($path, $file, 'enem.pdf');

					  Inscricao::create([
					  	'usuarioId'              => Auth::user()->id,
					  	'tipo'					    		 => $request->tipo,
					  	'editalId'               => $request->editalId,
					  	'historicoEscolar'       => $path . '/historicoEscolar.pdf',
					  	'declaracaoDeVinculo'    => $path . '/declaracaoDeVinculo.pdf',
					  	'programaDasDisciplinas' => $path . '/programaDasDisciplinas.pdf',
					  	'enem'                   => $path . '/enem.pdf',
							'curso'									=> $request->curso,
							'polo'									=> $request->polo,
							'turno'									=> $request->turno,
							'cursoDeOrigem'					=> $request->cursoDeOrigem,
							'instituicaoDeOrigem'   => $request->instituicaoDeOrigem,
							'naturezaDaIes'					=> $request->naturezaDaIes,
							'enderecoIes'						=> $request->enderecoIes,
							'homologado'						=> 'nao',
							'homologadoDrca'			 	=> 'nao',
							'coeficienteDeRendimento'=> 'nao',
					  ]);
						$nomeEdital = Edital::find($request->editalId)->get('nome');
						Mail::to('lucas.siqueira.araujo@gmail.com')->send(new NovaInscricao($nomeEdital));
					  return view('home');
	    	  }
		}

	public function inscricaoEscolhida(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);

	  if(!strcmp($inscricao->tipo, 'reintegracao')){
			$historicoEscolar = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId .  '/historicoEscolar.pdf';
			$declaracaoDeVinculo= '';
			$programaDasDisciplinas = '';
			$enem = '';
			$curriculo = '';
		}
		if(!strcmp($inscricao->tipo, 'transferenciaInterna')){
			$historicoEscolar = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/historicoEscolar.pdf';
			$declaracaoDeVinculo = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/declaracaoDeVinculo.pdf';
			$programaDasDisciplinas = '';
			$enem = '';
			$curriculo = '';
		}
		if(!strcmp($inscricao->tipo, 'transferenciaExterna')){
			$historicoEscolar = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/historicoEscolar.pdf';
			$declaracaoDeVinculo = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/declaracaoDeVinculo.pdf';
			$programaDasDisciplinas = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/programaDasDisciplinas.pdf';
			$curriculo = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/curriculo.pdf';
			$enem = '';
		}
		if(!strcmp($inscricao->tipo, 'portadorDeDiploma')){
			$historicoEscolar = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/historicoEscolar.pdf';
			$declaracaoDeVinculo = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/declaracaoDeVinculo.pdf';
			$programaDasDisciplinas = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/programaDasDisciplinas.pdf';
			$enem = 'inscricao/' . Auth::user()->id . '/' . $inscricao->editalId . '/enem.pdf';
			$curriculo = '';
		}
		if(!strcmp($request->tipo, 'homologacao')){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'historicoEscolar'			   => $historicoEscolar,
																				 'declaracaoDeVinculo'		 => $declaracaoDeVinculo,
																				 'programaDasDisciplinas'	 => $programaDasDisciplinas,
																				 'enem' 									 => $enem,
																				 'curriculo' 							 => $curriculo,
																				 'tipo'										 => 'homologacao',
																			  ]);

		}
		if(!strcmp($request->tipo, 'drca')){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'historicoEscolar'			   => $historicoEscolar,
																				 'declaracaoDeVinculo'		 => $declaracaoDeVinculo,
																				 'programaDasDisciplinas'	 => $programaDasDisciplinas,
																				 'enem' 									 => $enem,
																				 'curriculo' 							 => $curriculo,
																				 'tipo'										 => 'drca',
																			  ]);
		}

		if(!strcmp($request->tipo, 'classificacao')){
			return view('classificarInscricao', ['inscricao'  						 => $inscricao,
																				 'historicoEscolar'			   => $historicoEscolar,
																				 'declaracaoDeVinculo'		 => $declaracaoDeVinculo,
																				 'programaDasDisciplinas'	 => $programaDasDisciplinas,
																				 'enem' 									 => $enem,
																				 'curriculo' 							 => $curriculo,
																				 'tipo'										 => 'classificacao',
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
				return view('home');
			}
			else{
				$inscricao->homologado = 'aprovado';
				$inscricao->save();
				return view('home');
			}
		}
		if(!strcmp($request->tipo, 'drca')){
			if(!strcmp($request->homologado, 'rejeitado')){
				$inscricao->homologadoDrca = 'rejeitado';
				$inscricao->motivoRejeicao = $request->motivoRejeicao;
				$inscricao->save();
				return view('home');
			}
			else{
				$inscricao->homologadoDrca = 'aprovado';
				$inscricao->save();
				return view('home');
			}
		}
	}

	public function downloadArquivo(Request $request){
    return response()->download(storage_path('app/public/'.$request->file));
	}

	public function cadastroClassificacao(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);
		$coeficienteDeRendimento = str_replace(",",".",$request->coeficienteDeRendimento);
		$inscricao->coeficienteDeRendimento = $coeficienteDeRendimento;
		$completadas = floatval($request->completadas);
		$materias = floatval($request->materias);
		$completadas = $completadas * 100;
		$conclusaoDoCurso = $completadas/$materias;
		$conclusaoDoCurso = $conclusaoDoCurso/10;
		$conclusaoDoCurso = number_format((float)$conclusaoDoCurso, 1, '.', '');
		$inscricao->conclusaoDoCurso = (String) $conclusaoDoCurso;
		$inscricao->save();
		return view('home');
	}

}
