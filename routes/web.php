<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(!is_null(session('tipo'))){
      return redirect()->route('homeApi');
    }
    return redirect()->route('home');
});

Auth::routes();

Route::get('/listarEditais',         'EditalController@iframeEditais'             )->name('iframeEditais');

Route::group(['middleware' => 'lmts'], function(){
  Route::get('/home',                        'HomeController@index'                             )->name('home');
  Route::get('/home/servidor',               'HomeController@homeApi'                           )->name('homeApi');
  Route::post('/loginApi',                   'HomeController@loginApi'                          )->name('loginApi')->middleware('guest');

  Route::get('/download',                    'InscricaoController@downloadArquivo'              )->name('download');

  Route::get( '/novoEdital',                 'EditalController@novoEdital'                      )->name('novoEdital')->middleware('lmts');
  Route::post('/excluirEdital',              'EditalController@deleteEdital'                    )->name('apagarEdital');
  Route::post('/publicarEdital',             'EditalController@publicarEdital'                  )->name('publicarEdital');
  Route::get('/editarEdital',                'EditalController@editarEdital'                    )->name('editarEdital');
  Route::post('/cadastroeditarEdital' ,      'EditalController@cadastroEditarEdital'            )->name('cadastroEditarEdital');
  Route::post('/listaEditais',               'EditalController@listaEditais'                    )->name('listaEditais');
  Route::post('/cadastroEdital',             'EditalController@cadastroEdital'                  )->name('cadastroEdital');
  Route::get( '/detalhes',                   'EditalController@detalhesEdital'                  )->name('detalhesEdital')->middleware('auth');
  Route::get( '/detalhes/servidor',          'EditalController@detalhesEdital'                  )->name('detalhesEditalServidor');
  Route::get( '/detalhesPorcentagem',        'EditalController@detalhesPorcentagem'             )->name('detalhesPorcentagem');
  Route::get( '/listaInscricoes',            'EditalController@editalEscolhido'                 )->name('editalEscolhido');
  Route::post('/gerarClassificacao',         'EditalController@gerarClassificacao'              )->name('gerarClassificacao');

  Route::post('/cadastroInscricao',          'InscricaoController@cadastroInscricao'            )->name('cadastroInscricao');
  Route::post('/cadastroDesempate',          'InscricaoController@cadastroDesempate'            )->name('cadastroDesempate');
  Route::get('/homologarInscricao',          'InscricaoController@inscricaoEscolhida'           )->name('inscricaoEscolhida');
  Route::post('/inscricaoHomologada',        'InscricaoController@homologarInscricao'           )->name('homologarInscricao');
  Route::get('/classificarInscricao',        'InscricaoController@classificarInscricao'         )->name('classificarInscricao');
  Route::post('/cadastroClassificacao',      'InscricaoController@cadastroClassificacao'        )->name('cadastroClassificacao');
  Route::post('/notificarCoordenador',       'InscricaoController@notificarCoordenador'         )->name('notificarCoordenador');

  Route::post('/cadastroIsencao',            'IsencaoController@cadastroIsencao'                )->name('cadastroIsencao');
  Route::post('/homologarIsencao',           'IsencaoController@isencaoEscolhida'               )->name('isencaoEscolhida');
  Route::post('/isencaoHomologada',          'IsencaoController@homologarIsencao'               )->name('homologarIsencao');

  Route::post('/cadastroRecurso',            'RecursoController@cadastroRecurso'                )->name('cadastroRecurso');
  Route::post('/homologarRecurso',           'RecursoController@recursoEscolhido'               )->name('recursoEscolhido');
  Route::post('/recursoHomologado',          'RecursoController@homologarRecurso'               )->name('homologarRecurso');

  Route::get('/dadosUsuario',                'DadosUsuarioController@verDadosUsuario'           )->name('verDadosUsuario')->middleware('auth');
  Route::post('/cadastroDadosUsuario',       'DadosUsuarioController@cadastroDadosUsuario'      )->name('cadastroDadosUsuario');
  Route::post('/cadastroEditarDadosUsuario', 'DadosUsuarioController@cadastroEditarDadosUsuario')->name('cadastroEditarDadosUsuario');
  Route::post('/editarDadosUsuario',         'DadosUsuarioController@editarDadosUsuario'        )->name('editarDadosUsuario');
});
