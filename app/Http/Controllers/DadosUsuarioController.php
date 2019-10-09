<?php

namespace extravestibular\Http\Controllers;

use extravestibular\DadosUsuario;
use Illuminate\Http\Request;
use extravestibular\User;
use Illuminate\Support\Facades\Validator;
use Auth;

class DadosUsuarioController extends Controller
{
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'nome' => ['required', 'string', 'max:255'],
    //         'cpf'  => ['required', 'max:11']
    //         // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

  public function cadastroDadosUsuario(Request $request){
    $validatedData = $request->validate([ 'nome'              => ['required', 'string', 'max:255'],
                                          'cpf'               => ['required', 'size:11'],
                                          'rg'                => ['required', 'size:7'],
                                          'orgaoEmissor'      => ['required', 'min:3', 'max:5'],
                                          'orgaoEmissorUF'    => ['required', 'size:2', 'string'],
                                          'tituloEleitoral'   => ['required', 'min:12', 'max:12'],
                                          'filiacao'          => ['required', 'max:255'],
                                          'endereco'          => ['required', 'string', 'max:255'],
                                          'num'               => ['required'],
                                          'bairro'            => ['required', 'max:255'],
                                          'cidade'            => ['required', 'max:255'],
                                          'uf'                => ['required', 'size:2'],
                                          'foneResidencial'   => ['nullable','min:10', 'max:13'],
                                          'foneCelular'       => ['nullable','min:10', 'max:13'],
                                          'foneComercial'     => ['nullable','min:10', 'max:13'],
                                          'nascimento'        => ['required', 'date'],

                                        ]);




    DadosUsuario::create([
      'nome'                  => $request->nome,
      'rg'                    => $request->rg,
      'orgaoEmissor'          => $request->orgaoEmissor,
      'orgaoEmissorUF'        => $request->orgaoEmissorUF,
      'cpf'                   => $request->cpf,
      'tituloEleitoral'       => $request->tituloEleitoral,
      'filiacao'              => $request->filiacao,
      'endereco'              => $request->endereco,
      'num'                   => $request->num,
      'bairro'                => $request->bairro,
      'cidade'                => $request->cidade,
      'uf'                    => $request->uf,
      'foneResidencial'       => $request->foneResidencial,
      'foneCelular'           => $request->foneCelular,
      'foneComercial'         => $request->foneComercial,
      'nascimento'            => $request->nascimento,
    ]);
    $usuario = User::find(Auth::user()->id);
    $aux = DadosUsuario::where('cpf', $request->cpf)->first();
    $usuario->dados = (Integer) $aux->id;
    $usuario->save();
    return redirect()->route('home')->with('jsAlert', 'Dados de Usuário cadastrado.');
  }

  public function cadastroEditarDadosUsuario(Request $request){
    $validatedData = $request->validate([ 'nome'              => ['required', 'string', 'max:255'],
                                          'cpf'               => ['required', 'size:11'],
                                          'rg'                => ['required', 'size:7'],
                                          'orgaoEmissor'      => ['required', 'min:3', 'max:5'],
                                          'orgaoEmissorUF'    => ['required', 'size:2', 'string'],
                                          'tituloEleitoral'   => ['required', 'min:12', 'max:12'],
                                          'filiacao'          => ['required', 'max:255'],
                                          'endereco'          => ['required', 'string', 'max:255'],
                                          'num'               => ['required'],
                                          'bairro'            => ['required', 'max:255'],
                                          'cidade'            => ['required', 'max:255'],
                                          'uf'                => ['required', 'size:2'],
                                          'foneResidencial'   => ['nullable','min:10', 'max:13'],
                                          'foneCelular'       => ['nullable','min:10', 'max:13'],
                                          'foneComercial'     => ['nullable','min:10', 'max:13'],
                                          'nascimento'        => ['required', 'date'],

                                        ]);


    $dados = DadosUsuario::find(Auth::user()->dados);


    $dados->nome            = $request->nome;
    $dados->rg              = $request->rg;
    $dados->orgaoEmissor    = $request->orgaoEmissor;
    $dados->orgaoEmissorUF  = $request->orgaoEmissorUF;
    $dados->cpf             = $request->cpf;
    $dados->tituloEleitoral = $request->tituloEleitoral;
    $dados->filiacao        = $request->filiacao;
    $dados->endereco        = $request->endereco;
    $dados->num             = $request->num;
    $dados->bairro          = $request->bairro;
    $dados->cidade          = $request->cidade;
    $dados->uf              = $request->uf;
    $dados->foneResidencial = $request->foneResidencial;
    $dados->foneCelular     = $request->foneCelular;
    $dados->foneComercial   = $request->foneComercial;
    $dados->nascimento      = $request->nascimento;

    $dados->save();
    return redirect()->route('home')->with('jsAlert', 'Dados de Usuário atualizados.');
  }

  public function verDadosUsuario(Request $request){
    return view('cadastrarDadosUsuario');
  }
  public function editarDadosUsuario(Request $request){
    $dados = DadosUsuario::find(Auth::user()->dados);
    return view('cadastrarEditarDadosUsuario',['dados' => $dados]);
  }
}
