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
    $validatedData = $request->validate(['nome'               => ['required', 'string', 'max:255'],
                                          'cpf'               => ['required', 'min:11', 'max:11'],
                                          'rg'                => ['required', 'min:7', 'max:7'],
                                          'orgaoEmissor'      => ['required', 'min:3', 'max:5'],
                                          'orgaoEmissorUF'    => ['required', 'min:2', 'max:2'],
                                          'tituloEleitoral'   => ['required', 'min:12', 'max:12'],
                                          'filiacao'          => ['required', 'max:255'],
                                          'endereco'          => ['required', 'string', 'max:255'],
                                          'num'               => ['required'],
                                          'bairro'            => ['required', 'max:255'],
                                          'cidade'            => ['required', 'max:255'],
                                          'uf'                => ['required', 'min:2', 'max:2'],
                                          'foneResidencial'   => ['nullable','min:10', 'max:11'],
                                          'foneCelular'       => ['nullable','min:10', 'max:11'],
                                          'foneComercial'     => ['nullable','min:10', 'max:11'],

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
    ]);
    $usuario = User::find(Auth::user()->id);
    $aux = DadosUsuario::where('cpf', $request->cpf)->first();
    $usuario->dados = (Integer) $aux->id;
    $usuario->save();
    return redirect()->route('home')->with('jsAlert', 'Dados de Usuário atualizados.');
  }

  public function verDadosUsuario(Request $request){
    return view('cadastrarDadosUsuario');
  }
}
