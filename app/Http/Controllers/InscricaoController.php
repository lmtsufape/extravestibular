<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Inscricao;
use App\Isencao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Edital;
use App\DadosUsuario;
use App\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NovaInscricao;
use App\Mail\ClassificacaoCompleta;
use App\Mail\LembreteCoordenador;
use Carbon\Carbon;
use Lmts\src\controller\LmtsApi;


class InscricaoController extends Controller
{

	private $api;

	public function __construct()
	{
		$this->api = new LmtsApi();
	}

	public function cadastroInscricao(Request $request){
        $this->authorize('cadastrarInscricao', Inscricao::class);

        $isencao = Isencao::where('editalId', $request->editalId)->where('usuarioId', Auth::user()->id)->where('parecer', 'deferida')->first();

        if(empty($isencao)){
            $validatedData = $request->validate([
                'comprovante' => ['required', 'mimes:pdf','max:65536']
            ]);
        }
        // campos comuns a todos
        $request->validate([
            'declaracaoDeVeracidade' => ['required'],
            'rg'                     => ['required', 'mimes:pdf','max:65536'],
            'cpf'                    => ['nullable', 'mimes:pdf','max:65536'],
            'quitacaoEleitoral'      => ['required', 'mimes:pdf','max:65536'],
            'reservista'             => ['nullable', 'mimes:pdf','max:65536'],
            'certidaoNascimento'     => ['required', 'mimes:pdf','max:65536'],
        ]);

        if($request->tipo == 'reintegracao'){
            $validatedData = $request->validate([
                'declaracaoDeVinculo'    => ['nullable', 'mimes:pdf','max:65536'],
                'historicoEscolar'       => ['required', 'mimes:pdf','max:65536'],
                'programaDasDisciplinas' => ['nullable', 'mimes:pdf','max:65536'],
                'curriculo'              => ['nullable', 'mimes:pdf','max:65536'],
                'enem'                   => ['nullable', 'mimes:pdf','max:65536'],
                'diploma'                => ['nullable', 'mimes:pdf','max:65536'],
                'endereco'               => ['required', 'string', 'max:255'],
                'num'                    => ['required', 'integer'],
                'bairro'                 => ['required', 'max:255'],
                'cidade'                 => ['required', 'max:255'],
                'uf'                     => ['required', 'size:2'],
                'polo'                   => ['nullable', 'string', 'max:255'],
                'turno'                  => ['required', 'string', 'max:255'],
                'cursoDeOrigem'          => ['required', 'string', 'max:255'],
                'instituicaoDeOrigem'    => ['required', 'string', 'max:255'],
                'naturezaDaIes'          => ['required', 'string', 'max:255'],
            ]);
        }
        elseif ($request->tipo == 'transferenciaInterna') {
            $validatedData = $request->validate([
                'declaracaoDeVinculo'    => ['required', 'mimes:pdf','max:65536'],
                'historicoEscolar'       => ['required', 'mimes:pdf','max:65536'],
                'programaDasDisciplinas' => ['nullable', 'mimes:pdf','max:65536'],
                'curriculo'              => ['nullable', 'mimes:pdf','max:65536'],
                'enem'                   => ['nullable', 'mimes:pdf','max:65536'],
                'diploma'                => ['nullable', 'mimes:pdf','max:65536'],
                'endereco'               => ['required', 'string', 'max:255'],
                'num'                    => ['required', 'integer'],
                'bairro'                 => ['required', 'max:255'],
                'cidade'                 => ['required', 'max:255'],
                'uf'                     => ['required', 'size:2'],
                'polo'                   => ['nullable', 'string', 'max:255'],
                'turno'                  => ['required', 'string', 'max:255'],
                'cursoDeOrigem'          => ['required', 'string', 'max:255'],
                'instituicaoDeOrigem'    => ['required', 'string', 'max:255'],
                'naturezaDaIes'          => ['required', 'string', 'max:255'],
            ]);
        }
        elseif ($request->tipo == 'transferenciaExterna') {
            // enade historicoGraduacao curriculo vinculo programa historioMedio
            $validatedData = $request->validate([
                'declaracaoDeVinculo'    => ['required', 'mimes:pdf','max:65536'],
                'declaracaoENADE'        => ['required', 'mimes:pdf','max:65536'],
                'historicoEscolar'       => ['required', 'mimes:pdf','max:65536'],
                'historicoEnsinoMedio'   => ['required', 'mimes:pdf','max:65536'],
                'programaDasDisciplinas' => ['nullable', 'mimes:pdf','max:65536'],
                'curriculo'              => ['required', 'mimes:pdf','max:65536'],
                'enem'                   => ['nullable', 'mimes:pdf','max:65536'],
                'diploma'                => ['nullable', 'mimes:pdf','max:65536'],
                'endereco'               => ['required', 'string', 'max:255'],
                'num'                    => ['required', 'integer'],
                'bairro'                 => ['required', 'max:255'],
                'cidade'                 => ['required', 'max:255'],
                'uf'                     => ['required', 'size:2'],
                'polo'                   => ['nullable', 'string', 'max:255'],
                'turno'                  => ['required', 'string', 'max:255'],
                'cursoDeOrigem'          => ['required', 'string', 'max:255'],
                'instituicaoDeOrigem'    => ['required', 'string', 'max:255'],
                'naturezaDaIes'          => ['required', 'string', 'max:255'],
            ]);
        }
        elseif ($request->tipo == 'portadorDeDiploma') {
            $validatedData = $request->validate([
                'historicoEscolar' 		 => ['required', 'mimes:pdf','max:65536'],
                'programaDasDisciplinas' => ['nullable', 'mimes:pdf','max:65536'],
                'diploma' 				 => ['required', 'mimes:pdf','max:65536'],
                'endereco'          	 => ['required', 'string', 'max:255'],
                'num'               	 => ['required', 'integer'],
                'bairro'            	 => ['required', 'max:255'],
                'cidade'            	 => ['required', 'max:255'],
                'uf'                	 => ['required', 'size:2'],
                'polo'					 => ['nullable', 'string', 'max:255'],
                'turno'					 => ['required', 'string', 'max:255'],
                'cursoDeOrigem'		     => ['required', 'string', 'max:255'],
                'instituicaoDeOrigem'    => ['required', 'string', 'max:255'],
                'naturezaDaIes'			 => ['required', 'string', 'max:255'],
            ]);
        }

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


        $inscricao = '';

        $path = 'inscricoes/' . Auth::user()->id . '/' . $request->editalId;
        $cpf = null;
        $reservista = null;
        if ($request->hasFile('cpf')) {
            Storage::putFileAs($path, $request->cpf, 'cpf.pdf');
            $cpf = $path . '/cpf.pdf';
        }
        if ($request->hasFile('reservista')) {
            Storage::putFileAs($path, $request->reservista, 'reservista.pdf');
            $reservista = $path . '/reservista.pdf';
        }
        Storage::putFileAs($path, $request->rg, 'rg.pdf');
        // Storage::putFileAs($path, $request->declaracaoDeVeracidade, 'declaracaoDeVeracidade.pdf');
        Storage::putFileAs($path, $request->quitacaoEleitoral, 'quitacaoEleitoral.pdf');
        Storage::putFileAs($path, $request->certidaoNascimento, 'certidaoNascimento.pdf');

        if(!strcmp($request->tipo, 'reintegracao')){
            $file = $request->historicoEscolar;

            Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
            $comprovante = '';
            if($request->comprovante == 'isento'){
                $comprovante = 'isento';
            }
            else{
                $file = $request->comprovante;
                Storage::putFileAs($path, $file, 'comprovante.pdf');
                $comprovante = $path . '/comprovante.pdf';
            }																																									//criar inscricao no banco

            $inscricao = Inscricao::create([
                'usuarioId'              => Auth::user()->id,
                'tipo'					 => $request->tipo,
                'editalId'               => $request->editalId,
                'historicoEscolar'       => $path . '/historicoEscolar.pdf',
                'curso'					 => $request->curso,
                'polo'					 => $request->polo,
                'turno'					 => $request->turno,
                'cursoDeOrigem'			 => $request->cursoDeOrigem,
                'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
                'naturezaDaIes'			 => $request->naturezaDaIes,
                'endereco'				 => $request->endereco,
                'num'					 => $request->num,
                'bairro'				 => $request->bairro,
                'cidade'				 => $request->cidade,
                'uf'					 => $request->uf,
                'homologado'			 => 'nao',
                'homologadoDrca'		 => 'nao',
                'comprovante'			 => $comprovante,
                'rg'                     => $path . '/rg.pdf',
                'declaracaoDeVeracidade' => true,
                'quitacaoEleitoral'      => $path . '/quitacaoEleitoral.pdf',
                'certidaoNascimento'     => $path . '/certidaoNascimento.pdf',
                'cpf'                    => $cpf,
                'reservista'             => $reservista,
            ]);
        }
        elseif(!strcmp($request->tipo, 'transferenciaInterna')) {
            $file = $request->historicoEscolar;
            Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
            $file = $request->declaracaoDeVinculo;
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
            $inscricao = Inscricao::create([
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
                'comprovante'						 => $comprovante,
                'rg'                     => $path . '/rg.pdf',
                'declaracaoDeVeracidade' => true,
                'quitacaoEleitoral'      => $path . '/quitacaoEleitoral.pdf',
                'certidaoNascimento'     => $path . '/certidaoNascimento.pdf',
                'cpf'                    => $cpf,
                'reservista'             => $reservista,
            ]);
        }
        elseif(!strcmp($request->tipo, 'transferenciaExterna')) {
            $file = $request->historicoEscolar;
            Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
            $file = $request->declaracaoDeVinculo;
            Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');
            Storage::putFileAs($path, $request->declaracaoENADE, 'declaracaoENADE.pdf');
            Storage::putFileAs($path, $request->historicoEnsinoMedio, 'historicoEnsinoMedio.pdf');
            $programaDasDisciplinas = null;
            if ($request->hasFile('programaDasDisciplinas')) {
                Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');
                $programaDasDisciplinas = $path . '/programaDasDisciplinas.pdf';
            }
            $declaracaoENADE = null;
            if ($request->hasFile('declaracaoENADE')) {
                Storage::putFileAs($path, $file, 'declaracaoENADE.pdf');
                $declaracaoENADE = $path . '/declaracaoENADE.pdf';
            }
            $file = $request->curriculo;
            Storage::putFileAs($path, $file, 'curriculo.pdf');
            $comprovante = '';
            if($request->comprovante == 'isento'){
                $comprovante = 'isento';
            } else {
                $file = $request->comprovante;
                Storage::putFileAs($path, $file, 'comprovante.pdf');
                $comprovante = $path . '/comprovante.pdf';
            }
            $inscricao = Inscricao::create([
                'usuarioId'              => Auth::user()->id,
                'tipo'         			 => $request->tipo,
                'editalId'               => $request->editalId,
                'historicoEscolar'       => $path . '/historicoEscolar.pdf',
                'declaracaoDeVinculo'    => $path . '/declaracaoDeVinculo.pdf',
                'programaDasDisciplinas' => $programaDasDisciplinas,
                'curriculo'              => $path . '/curriculo.pdf',
                'curso'					 => $request->curso,
                'polo'					 => $request->polo,
                'turno'					 => $request->turno,
                'cursoDeOrigem'			 => $request->cursoDeOrigem,
                'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
                'naturezaDaIes'			 => $request->naturezaDaIes,
                'endereco'				 => $request->endereco,
                'num'					 => $request->num,
                'bairro'				 => $request->bairro,
                'cidade'				 => $request->cidade,
                'uf'					 => $request->uf,
                'homologado'			 => 'nao',
                'homologadoDrca'		 => 'nao',
                'comprovante'			 => $comprovante,
                'declaracaoENADE'        => $declaracaoENADE,
                'historicoEnsinoMedio'   => $path . '/historicoEnsinoMedio.pdf',
                'rg'                     => $path . '/rg.pdf',
                'declaracaoDeVeracidade' => true,
                'quitacaoEleitoral'      => $path . '/quitacaoEleitoral.pdf',
                'certidaoNascimento'     => $path . '/certidaoNascimento.pdf',
                'cpf'                    => $cpf,
                'reservista'             => $reservista,
        ]);

        } elseif(!strcmp($request->tipo, 'portadorDeDiploma')) {
            $file = $request->historicoEscolar;
            Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
            $programaDasDisciplinas = null;
            if ($request->hasFile('programaDasDisciplinas')) {
                Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');
                $programaDasDisciplinas = $path . '/programaDasDisciplinas.pdf';
            }
            $file = $request->diploma;
            Storage::putFileAs($path, $file, 'diploma.pdf');
            $comprovante = '';
            if($request->comprovante == 'isento'){
                $comprovante = 'isento';
            }
            else{
                $file = $request->comprovante;
                Storage::putFileAs($path, $file, 'comprovante.pdf');
                $comprovante = $path . '/comprovante.pdf';
            }

            $inscricao = Inscricao::create([
                'usuarioId'              => Auth::user()->id,
                'tipo'					 => $request->tipo,
                'editalId'               => $request->editalId,
                'historicoEscolar'       => $path . '/historicoEscolar.pdf',
                'programaDasDisciplinas' => $programaDasDisciplinas,
                'diploma'                => $path . '/diploma.pdf',
                'curso'					 => $request->curso,
                'polo'					 => $request->polo,
                'turno'					 => $request->turno,
                'cursoDeOrigem'			 => $request->cursoDeOrigem,
                'instituicaoDeOrigem'    => $request->instituicaoDeOrigem,
                'naturezaDaIes'			 => $request->naturezaDaIes,
                'endereco'				 => $request->endereco,
                'num'					 => $request->num,
                'bairro'				 => $request->bairro,
                'cidade'				 => $request->cidade,
                'uf'					 => $request->uf,
                'homologado'			 => 'nao',
                'homologadoDrca'		 => 'nao',
                'comprovante'			 => $comprovante,
                'rg'                     => $path . '/rg.pdf',
                'declaracaoDeVeracidade' => true,
                'quitacaoEleitoral'      => $path . '/quitacaoEleitoral.pdf',
                'certidaoNascimento'     => $path . '/certidaoNascimento.pdf',
                'cpf'                    => $cpf,
                'reservista'             => $reservista,
            ]);
        }


        $edital = Edital::find($request->editalId);
        $nomeEdital = explode(".pdf", $edital->nome);
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $emails = $this->api->getEmailsPreg();
        // foreach ($emails as $key) {
        // 	Mail::to($key)->send(new NovaInscricao($nomeEdital[0]));
        // }
        $dados = DadosUsuario::find(Auth::user()->dados);
        $cursos = $this->api->getCursos();
        $curso = $inscricao->curso;
        $inscricao->situacao = 'processando';
        $inscricao->save();
        for($j = 0; $j < sizeof($cursos); $j++){
            if($curso == $cursos[$j]['id']){
                $curso = $cursos[$j]['nome'];
            }
        }
        return view('confirmacaoInscricao', [
            'editalId' => $request->editalId,
            'mytime'	 => $mytime,
            'inscricao'=> $inscricao,
            'dados'		 => $dados,
            'curso'	   => $curso,
        ]);
		
        return redirect()->route('home')->with('jsAlert', 'Inscrição realizada com sucesso!');
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

		return redirect()->route('home')->with('jsAlert', 'Desempate realizado com sucesso!');
	}

	public function inscricaoEscolhida(Request $request){
		$inscricao = Inscricao::find($request->inscricaoId);

		$cursos = $this->api->getCursos();
		$curso = $inscricao->curso;
		for($j = 0; $j < sizeof($cursos); $j++){
			if($curso == $cursos[$j]['id']){
				$curso = $cursos[$j]['nome'];
			}
		}

		$usuario = User::find($inscricao->usuarioId);
		$dados = DadosUsuario::find($usuario->dados);
		$mytime = Carbon::now('America/Recife');
		$mytime = $mytime->toDateString();
		// dd($request);
		if($request->tipo == 'homologacao'){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'tipo'										 => 'homologacao',
																				 'curso'									 => $curso,
																				 'dados'									 => $dados,
																				 'editalId'								 => $inscricao->editalId,
																				 'mytime'									 => $mytime,
																			  ]);

		}
		if($request->tipo == 'drca'){
			return view('homologarInscricao', ['inscricao'  						 => $inscricao,
																				 'tipo'										 => 'drca',
																				 'curso'									 => $curso,
																				 'dados'									 => $dados,
																				 'editalId'								 => $inscricao->editalId,
																				 'mytime'									 => $mytime,
																			  ]);
		}
		if($request->tipo == 'classificacao'){
			if($inscricao->tipo == 'reintegracao'){
				return view('homologarInscricaoReintegracao', [
																											 'inscricao'  						 => $inscricao,
																									 	   'tipo'										 => 'classificacao',
																										   'curso'									 => $curso,
																											 'dados'									 => $dados,
																											 'editalId'								 => $inscricao->editalId,
																											 'mytime'									 => $mytime,
																								     ]);
			}
			elseif ($inscricao->tipo == 'transferenciaInterna') {
				return view('homologarInscricaoReopcao', [
																											 'inscricao'  						 => $inscricao,
																											 'tipo'										 => 'classificacao',
																											 'curso'									 => $curso,
																											 'dados'									 => $dados,
																											 'editalId'								 => $inscricao->editalId,
																											 'mytime'									 => $mytime,
																										 ]);
			}
			elseif ($inscricao->tipo == 'transferenciaExterna') {
				return view('homologarInscricaoTransferenciaExterna', [
																											 'inscricao'  						 => $inscricao,
																											 'tipo'										 => 'classificacao',
																											 'curso'									 => $curso,
																											 'dados'									 => $dados,
																											 'editalId'								 => $inscricao->editalId,
																											 'mytime'									 => $mytime,
																										 ]);
			}
			elseif ($inscricao->tipo == 'portadorDeDiploma') {
				return view('homologarInscricaoPortadorDeDiploma', [
																											 'inscricao'  						 => $inscricao,
																											 'tipo'										 => 'classificacao',
																											 'curso'									 => $curso,
																											 'dados'									 => $dados,
																											 'editalId'								 => $inscricao->editalId,
																											 'mytime'									 => $mytime,
																										 ]);
			}
		}
		if($request->tipo == 'editarClassificacao'){
			return view('editarClassificacao', 			 		[
																										 'inscricao'  						 => $inscricao,
																										 'tipo'										 => 'classificacao',
																										 'curso'									 => $curso,
																										 'dados'									 => $dados,
																										 'editalId'								 => $inscricao->editalId,
																										 'mytime'									 => $mytime,
																									]);
		}
		if($request->tipo == 'seguirParaClassificacao'){
			// dd($request);
			if($request->homologado == 'rejeitado'){
				$validatedData = $request->validate([ 'motivoRejeicao' => ['required', 'string']]);
				$inscricao = Inscricao::find($request->inscricaoId);
				$inscricao->homologado = 'rejeitado';
				$inscricao->motivoRejeicao = $request->motivoRejeicao;
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição indeferida com sucesso!');
			}
			return view('cadastrarClassificacao', [
																										 'inscricao'  						 => $inscricao,
																								 	   'tipo'										 => 'classificacao',
																									   'curso'									 => $curso,
																										 'dados'									 => $dados,
																										 'editalId'								 => $inscricao->editalId,
																										 'mytime'									 => $mytime,
																							     ]);
		}

	}

	public function homologarInscricao(Request $request){
		$this->authorize('homologarInscricao', Inscricao::class);
		$inscricao = Inscricao::find($request->inscricaoId);
		if($request->homologado == 'rejeitado'){
        $validatedData = $request->validate([ 'motivoRejeicao' => ['required', 'string']]);
    }

		if(!strcmp($request->tipo, 'homologacao')){
			if(!strcmp($request->homologado, 'rejeitado')){
				$validatedData = $request->validate([ 'motivoRejeicao' => ['required', 'string']]);
				$inscricao->homologado = 'rejeitado';
				//$inscricao->classificacao = 'rejeitado';
				$inscricao->motivoRejeicao = $request->motivoRejeicao;
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso!');
			}
			else{
				$inscricao->homologado = 'aprovado';
				if($inscricao->tipo != 'reintegracao'){
					$inscricao->homologadoDrca = 'aprovado';
					//$inscricao->classificacao = 'processando';
				}
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso!');
			}
		}
		if(!strcmp($request->tipo, 'drca')){
			if(!strcmp($request->homologado, 'rejeitado')){
				//$inscricao->classificacao = 'rejeitado';
				$inscricao->homologadoDrca = 'rejeitado';
				$inscricao->motivoRejeicao = $request->motivoRejeicao;
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso!');
			}
			else{
				$inscricao->homologadoDrca = 'aprovado';
				//$inscricao->classificacao = 'processando';
				$inscricao->save();
				return redirect()->route('home')->with('jsAlert', 'Inscrição homologada com sucesso!');
			}
		}
	}

	public function downloadArquivo(Request $request){
    return response()->download(storage_path('app/public/'.$request->file));
	}

    public function downloadEdital(Request $request)
    {
        return response()->download(storage_path('app/public/'.$request->file));
    }

	private function aprovarPorPrioridade($aux, $curso, $tipo, $editalId, $transferenciaExternaDeMesmoCurso){
		if($transferenciaExternaDeMesmoCurso == 'sim'){
			$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('cursoDeOrigem', $curso)
																							->where('turno', 'manhã')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('cursoDeOrigem', $curso)
																							->where('turno', 'tarde')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('cursoDeOrigem', $curso)
																							->where('turno', 'noite')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																									->where('homologado' , 'aprovado')
																									->where('homologadoDrca', 'aprovado')
																									->where('situacao', '!=', 'processando')
																									->where('situacao', '!=', 'rejeitado')
																									->where('curso', $curso)
																									->where('cursoDeOrigem', $curso)
																									->where('turno', 'integral')
																									->where('tipo', $tipo)
																									->orderBy('nota', 'desc')
																									->get();
			$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->where('situacao', '!=', 'processando')
																								->where('situacao', '!=', 'rejeitado')
																								->where('curso', $curso)
																								->where('cursoDeOrigem', $curso)
																								->where('turno', 'especial')
																								->where('tipo', $tipo)
																								->orderBy('nota', 'desc')
																								->get();
		}
		elseif ($transferenciaExternaDeMesmoCurso == 'nao') {
			$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('cursoDeOrigem', '!=', $curso)
																							->where('turno', 'manhã')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('cursoDeOrigem', '!=', $curso)
																							->where('turno', 'tarde')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('cursoDeOrigem', '!=', $curso)
																							->where('turno', 'noite')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																									->where('homologado' , 'aprovado')
																									->where('homologadoDrca', 'aprovado')
																									->where('situacao', '!=', 'processando')
																									->where('situacao', '!=', 'rejeitado')
																									->where('curso', $curso)
																									->where('cursoDeOrigem', '!=', $curso)
																									->where('turno', 'integral')
																									->where('tipo', $tipo)
																									->orderBy('nota', 'desc')
																									->get();
			$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->where('situacao', '!=', 'processando')
																								->where('situacao', '!=', 'rejeitado')
																								->where('curso', $curso)
																								->where('cursoDeOrigem', '!=', $curso)
																								->where('turno', 'especial')
																								->where('tipo', $tipo)
																								->orderBy('nota', 'desc')
																								->get();
		}
		else{
			$inscricoesManhaOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('turno', 'manhã')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesTardeOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('turno', 'tarde')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesNoiteOrderByDesc = Inscricao::where('editalId', $editalId)
																							->where('homologado' , 'aprovado')
																							->where('homologadoDrca', 'aprovado')
																							->where('situacao', '!=', 'processando')
																							->where('situacao', '!=', 'rejeitado')
																							->where('curso', $curso)
																							->where('turno', 'noite')
																							->where('tipo', $tipo)
																							->orderBy('nota', 'desc')
																							->get();
			$inscricoesIntegralOrderByDesc = Inscricao::where('editalId', $editalId)
																									->where('homologado' , 'aprovado')
																									->where('homologadoDrca', 'aprovado')
																									->where('situacao', '!=', 'processando')
																									->where('situacao', '!=', 'rejeitado')
																									->where('curso', $curso)
																									->where('turno', 'integral')
																									->where('tipo', $tipo)
																									->orderBy('nota', 'desc')
																									->get();
			$inscricoesEspecialOrderByDesc = Inscricao::where('editalId', $editalId)
																								->where('homologado' , 'aprovado')
																								->where('homologadoDrca', 'aprovado')
																								->where('situacao', '!=', 'processando')
																								->where('situacao', '!=', 'rejeitado')
																								->where('curso', $curso)
																								->where('turno', 'especial')
																								->where('tipo', $tipo)
																								->orderBy('nota', 'desc')
																								->get();
		}
		foreach ($inscricoesManhaOrderByDesc as $inscricao) { //manha
			if($aux[0][0] > 0){
				$inscricao->situacao = 'Aprovado';
				$inscricao->classificacao = $aux[1][0];
				$inscricao->save();
				$aux[0][0] = $aux[0][0] - 1;
				$aux[1][0] = $aux[1][0] + 1;

			}
			else{
				$inscricao->situacao = 'Classificável';
				$inscricao->classificacao = $aux[1][0];
				$inscricao->save();
				$aux[0][0] = $aux[0][0] - 1;
				$aux[1][0] = $aux[1][0] + 1;
			}
		}

		foreach ($inscricoesTardeOrderByDesc as $inscricao) { //tarde
			if($aux[0][1] > 0){
				$inscricao->situacao = 'Aprovado';
				$inscricao->classificacao = $aux[1][1];
				$inscricao->save();
				$aux[0][1] = $aux[0][1] - 1;
				$aux[1][1] = $aux[1][1] + 1;
			}
			else{
				$inscricao->situacao = 'Classificável';
				$inscricao->classificacao = $aux[1][0];
				$inscricao->save();
				$aux[0][1] = $aux[0][1] - 1;
				$aux[1][1] = $aux[1][1] + 1;
			}
		}

		foreach ($inscricoesNoiteOrderByDesc as $inscricao) { //noite
			if($aux[0][2] > 0){
				$inscricao->situacao = 'Aprovado';
				$inscricao->classificacao = $aux[1][0];
				$inscricao->save();
				$aux[0][2] = $aux[0][2] - 1;
				$aux[1][2] = $aux[1][2] + 1;
			}
			else{
				$inscricao->situacao = 'Classificável';
				$inscricao->classificacao = $aux[1][0];
				$inscricao->save();
				$aux[0][2] = $aux[0][2] - 1;
				$aux[1][2] = $aux[1][2] + 1;
			}
		}

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //integral
			if($aux[0][3] > 0){
				$inscricao->situacao = 'Aprovado';
				$inscricao->classificacao = $aux[1][3];
				$inscricao->save();
				$aux[0][3] = $aux[0][3] - 1;
				$aux[1][3] = $aux[1][3] + 1;
			}
			else{
				$inscricao->situacao = 'Classificável';
				$inscricao->classificacao = $aux[1][3];
				$inscricao->save();
				$aux[0][3] = $aux[0][3] - 1;
				$aux[1][3] = $aux[1][3] + 1;
			}
		}

		foreach ($inscricoesIntegralOrderByDesc as $inscricao) { //especial
			if($aux[0][4] > 0){
				$inscricao->situacao = 'Aprovado';
				$inscricao->classificacao = $aux[1][4];
				$inscricao->save();
				$aux[0][4] = $aux[0][4] - 1;
				$aux[1][4] = $aux[1][4] + 1;
			}
			else{
				$inscricao->situacao = 'Classificável';
				$inscricao->classificacao = $aux[1][4];
				$inscricao->save();
				$aux[0][4] = $aux[0][4] - 1;
				$aux[1][4] = $aux[1][4] + 1;
			}
		}

		return $aux;

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
		$classifcacoes = [1,1,1,1,1];
		$ids = [];
		$aux = [];
		array_push($aux, $vagas);
		array_push($aux, $classifcacoes);
		$aux = $this->aprovarPorPrioridade($aux, $curso, 'transferenciaInterna', $editalId, null); //prioridade 0 = transferenciaInterna
		$aux = $this->aprovarPorPrioridade($aux, $curso, 'reintegracao', $editalId, null);				 //prioridade 1 = reintegracao
		$aux = $this->aprovarPorPrioridade($aux, $curso, 'transferenciaExterna', $editalId, 'sim'); //prioridade 2 = transferenciaExterna, mesmo curso
		$aux = $this->aprovarPorPrioridade($aux, $curso, 'transferenciaExterna', $editalId, 'nao'); //prioridade 3 = transferenciaExterna, curso afim
		$aux = $this->aprovarPorPrioridade($aux, $curso, 'portadorDeDiploma', $editalId, null);		 //prioridade 4 = portadorDeDiploma

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

			$emails = $this->api->getEmailsPreg();
			// foreach ($emails as $key) {
			// 	Mail::to($key)->send(new ClassificacaoCompleta($nomeEdital[0]));
			// }

		}
	}

	public function cadastroClassificacao(Request $request){
		$this->authorize('classificarInscricao', Inscricao::class);
		$inscricao = Inscricao::find($request->inscricaoId);
		$validatedData = $request->validate([
																					'coeficienteDeRendimento' 		=> ['required', 'numeric', 'lt:10.1'],
																					'totalDisciplinas' 						=> ['required', 'numeric'],
																				]);
		$coeficienteDeRendimento = str_replace(",",".",$request->coeficienteDeRendimento);
		$inscricao->coeficienteDeRendimento = $coeficienteDeRendimento;
		$inscricao->totalDisciplinas = $request->totalDisciplinas;
		$inscricao->nota = ($coeficienteDeRendimento + $request->totalDisciplinas) / 2;
		$inscricao->classificacao = 0;
		$inscricao->situacao = 'classificar';
		$inscricao->save();
		// $inscricoesQueFaltamClassificar = Inscricao::where('editalId' , $inscricao->editalId)
		// 																						 ->where('homologado' , 'aprovado')
		// 																						 ->where('homologadoDrca', 'aprovado')
		// 																						 ->where('curso', $inscricao->curso)
		// 																						 ->whereNull('nota')
		// 																						 ->first();
		// if(is_null($inscricoesQueFaltamClassificar)){
		$ids = $this->aprovarInscricoes($inscricao->editalId, $inscricao->curso);
		// if(!is_null($ids)){
		// 	$inscricoesManha 	  = Inscricao::where('turno', 'manhã')->whereIn('id',$ids)->get();
		// 	$inscricoesTarde 	  = Inscricao::where('turno', 'tarde')->whereIn('id',$ids)->get();
		// 	$inscricoesNoite 	  = Inscricao::where('turno', 'noite')->whereIn('id',$ids)->get();
		// 	$inscricoesIntegral = Inscricao::where('turno', 'integral')->whereIn('id',$ids)->get();
		// 	$inscricoesEspecial = Inscricao::where('turno', 'especial')->whereIn('id',$ids)->get();
		// 	$mytime = Carbon::now('America/Recife');
		// 	$mytime = $mytime->toDateString();
		//
		// 	return view('cadastrarDesempate', [
		// 		'inscricoesManha' => $inscricoesManha,
		// 		'inscricoesTarde' => $inscricoesTarde,
		// 		'inscricoesNoite' => $inscricoesNoite,
		// 		'inscricoesIntegral' => $inscricoesIntegral,
		// 		'inscricoesEspecial' => $inscricoesEspecial,
		// 		'idsEmpatados' => $ids,
		// 		'editalId' => $inscricao->editalId,
		// 		'mytime' => $mytime,
		// 	]);
		// }

		$this->verificarCompletudeClassificacoes($inscricao->editalId);

		return redirect()->route('home')->with('jsAlert', 'Inscrição classificada com sucesso!');
		// }
		// else{
		//
		// 	return redirect()->route('home')->with('jsAlert', 'Inscrição classificada com sucesso!');
		// }
	}

	public function notificarCoordenador(Request $request){
		$edital = Edital::find($request->editalId);
		$nomeEdital = explode(".pdf", $edital->nome);

		$mytime = Carbon::now('America/Recife');
		$mytime = $mytime->toDateString();
		$mytime = Carbon::parse($mytime);
		$aux    = Carbon::parse($edital->resultadoFinal);

		$diasRestantes =  $aux->diffInDays($mytime);
		// $emails = $this->api->getEmailsCoordenadorPorCurso($request->cursoId);
		// foreach ($emails as $key) {
		// 	Mail::to($key)->send(new LembreteCoordenador($nomeEdital[0], $diasRestantes));
		// }
		return 'Notificação enviada com sucesso!';
	}

	public function entrar(Request $request){
		if(Auth::check() || $this->api->check()){
			return redirect()->route('home');
		}

		$mytime = Carbon::now('America/Recife');
		$mytime = $mytime->toDateString();
		$editais = Edital::where('publicado', 'sim')
												->orderBy('created_at', 'desc')
												->paginate(10);
		return view('auth.login',     [
																	'editais' => $editais,
																	'mytime'  => $mytime,
																	]);
	}


}
