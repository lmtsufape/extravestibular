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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home',                  'HomeController@index'                       )->name('home');
Route::get('/loginhome',             'HomeController@loginComEditais'             )->middleware('auth');
Route::get('/listarEditais',         'EditalController@iframeEditais'             )->name('iframeEditais');


Route::get('/download',              'InscricaoController@downloadArquivo'        )->name('download')->middleware('auth');

Route::get( '/novoEdital',           'EditalController@novoEdital'                )->name('novoEdital')->middleware('auth');
Route::post('/excluirEdital',        'EditalController@deleteEdital'              )->name('apagarEdital');
Route::post('/editarEdital/{edital}','EditalController@editarEdital'              )->name('editarEdital');
Route::post('/editarEdital'        ,'EditalController@cadastroEditarEdital'       )->name('cadastroEditarEdital');
Route::post('/listaEditais',         'EditalController@listaEditais'              )->name('listaEditais');
Route::post('/cadastroEdital',       'EditalController@cadastroEdital'            )->name('cadastroEdital');
Route::get( '/detalhes/{edital}',    'EditalController@detalhesEdital'            )->name('detalhesEdital')->middleware('auth');
Route::get( '/detalhesPorcentagem',  'EditalController@detalhesPorcentagem'       )->name('detalhesPorcentagem')->middleware('auth');
Route::get( '/listaInscricoes',      'EditalController@editalEscolhido'           )->name('editalEscolhido')->middleware('auth');
Route::post('/gerarClassificacao',   'EditalController@gerarClassificacao'        )->name('gerarClassificacao');

Route::post('/cadastroInscricao',    'InscricaoController@cadastroInscricao'      )->name('cadastroInscricao');
Route::post('/cadastroDesempate',    'InscricaoController@cadastroDesempate'      )->name('cadastroDesempate');
Route::get('/homologarInscricao',    'InscricaoController@inscricaoEscolhida'     )->name('inscricaoEscolhida')->middleware('auth');
Route::post('/inscricaoHomologada',  'InscricaoController@homologarInscricao'     )->name('homologarInscricao');
Route::get('/classificarInscricao',   'InscricaoController@classificarInscricao'  )->name('classificarInscricao')->middleware('auth');
Route::post('/cadastroClassificacao','InscricaoController@cadastroClassificacao'  )->name('cadastroClassificacao');

Route::post('/cadastroIsencao',      'IsencaoController@cadastroIsencao'          )->name('cadastroIsencao');
Route::post('/homologarIsencao',     'IsencaoController@isencaoEscolhida'         )->name('isencaoEscolhida');
Route::post('/isencaoHomologada',    'IsencaoController@homologarIsencao'         )->name('homologarIsencao');


Route::post('/cadastroRecurso',      'RecursoController@cadastroRecurso'          )->name('cadastroRecurso');
Route::post('/homologarRecurso',     'RecursoController@recursoEscolhido'         )->name('recursoEscolhido');
Route::post('/recursoHomologado',    'RecursoController@homologarRecurso'         )->name('homologarRecurso');

Route::get('/dadosUsuario',          'DadosUsuarioController@verDadosUsuario'     )->name('verDadosUsuario')->middleware('auth');
Route::post('/cadastroDadosUsuario', 'DadosUsuarioController@cadastroDadosUsuario')->name('cadastroDadosUsuario');
