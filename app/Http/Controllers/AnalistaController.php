<?php

namespace App\Http\Controllers;

use App\Analista;
use App\Edital;
use App\Inscricao;
use App\Isencao;
use App\Mail\EmailAnalista;
use App\Mail\EmailParaAnalistaNaoCadastrado;
use App\Recurso;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AnalistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Edital $edital)
    {
        return view('analistas.index', ['edital' => $edital]);
    }

    public function editais()
    {
        $analistas = Auth::user()->analistas;
        $mytime = Carbon::now('America/Recife');
        return view('analistas.editais', compact('analistas', 'mytime'));
    }

    public function edital(Edital $edital)
    {
        $mytime = Carbon::now('America/Recife');
        $mytime = $mytime->toDateString();
        $inscricoesClassificadas = Inscricao::where('editalId', $edital->id)
            ->where('nota', '!=', null)
            ->count();
        $inscricoesNaoClassificadas = Inscricao::where('editalId', $edital->id)
            ->whereNull('nota')
            ->count();
        $inscricoesClassificadas = json_decode($inscricoesClassificadas);
        $inscricoesNaoClassificadas = json_decode($inscricoesNaoClassificadas);
        $inscricoesHomologadas = Inscricao::where('editalId', $edital->id)
            ->orWhere('homologado', 'aprovado')
            ->orWhere('homologado', 'rejeitado')
            ->orWhere('homologadoDrca', 'aprovado')
            ->orWhere('homologadoDrca', 'rejeitado')
            ->count();
        $inscricoesNaoHomologadas = Inscricao::where('editalId', $edital->id)
            ->where('homologado', 'nao')
            ->where('homologadoDrca', 'nao')
            ->count();
        $recursosTaxaHomologados = Recurso::where([['editalId', $edital->id], ['tipo', 'taxa'], ['homologado', 'aprovado']])
            ->orWhere([['editalId', $edital->id], ['tipo', 'taxa'], ['homologado', 'rejeitado']])
            ->count();
        $recursosTaxaNaoHomologados = Recurso::where('editalId', $edital->id)
            ->where('tipo', 'taxa')
            ->where('homologado', 'nao')
            ->count();
        $recursosClassificacaoHomologados = Recurso::where([['editalId', $edital->id], ['tipo', 'classificacao'], ['homologado', 'aprovado']])
            ->orWhere([['editalId', $edital->id], ['tipo', 'classificacao'], ['homologado', 'rejeitado']])
            ->count();
        $recursosClassificacaoNaoHomologados = Recurso::where('editalId', $edital->id)
            ->where('tipo', 'classificacao')
            ->where('homologado', 'nao')
            ->count();
        $recursosResultadoHomologados = Recurso::where([['editalId', $edital->id], ['tipo', 'resultado'], ['homologado', 'aprovado']])
            ->orWhere([['editalId', $edital->id], ['tipo', 'resultado'], ['homologado', 'rejeitado']])
            ->count();
        $recursosResultadoNaoHomologados = Recurso::where('editalId', $edital->id)
            ->where('tipo', 'resultado')
            ->where('homologado', 'nao')
            ->count();
        $isencoesHomologadas = Isencao::where('editalId', $edital->id)
            ->where('parecer', 'deferida')
            ->orWhere('parecer', 'indeferida')
            ->count();
        $isencoesNaoHomologadas = Isencao::where('editalId', $edital->id)
            ->where('parecer', 'nao')
            ->count();
        $erratas = $edital->errata;
        return view('analistas.edital', compact('edital', 'inscricoesHomologadas', 'inscricoesNaoHomologadas',
            'isencoesHomologadas', 'isencoesNaoHomologadas', 'recursosTaxaHomologados', 'recursosTaxaNaoHomologados',
            'recursosClassificacaoHomologados', 'recursosClassificacaoNaoHomologados', 'recursosResultadoHomologados',
            'recursosResultadoNaoHomologados', 'inscricoesClassificadas', 'inscricoesNaoClassificadas', 'mytime', 'erratas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Edital $edital, Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $usuario = User::where('email', $request->email)->first();
        $nome = explode(".pdf", $edital->nome)[0];
        if ($usuario == null) {
            $passwordTemporario = Str::random(8);
            Mail::to($request->email)->send(new EmailParaAnalistaNaoCadastrado($nome, $passwordTemporario, $request->email));
            $usuario = new User();
            $usuario->email       = $request->email;
            $usuario->password    = bcrypt($passwordTemporario);
            $usuario->tipo = 'candidato';
            $usuario->save();
            $analista = new Analista();
            $analista->user_id = $usuario->id;
            $analista->edital_id = $edital->id;
            $analista->save();
        } else if ($usuario->analistas()->where('edital_id', $edital->id)->get()->count() <= 0) {
            $analista = new Analista();
            $analista->user_id = $usuario->id;
            $analista->edital_id = $edital->id;
            $analista->save();
            Mail::to($request->email)->send(new EmailAnalista($nome));
        } else {
            return redirect()->back()->with('jsAlert', 'Esse analista já está cadastrado para o edital.')->withInput($validatedData);
        }
        return redirect()->route('analistas.index', $edital)->with('jsAlert', 'Analista cadastrado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Analista  $analista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analista $analista)
    {
        $edital = $analista->edital;
        $analista->delete();
        return redirect()->route('analistas.index', $edital)->with('jsAlert', 'Analista deletado do edital.');
    }
}
