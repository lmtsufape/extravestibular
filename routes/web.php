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

Route::get('/home',                  'HomeController@index'                     )->name('home');

Route::get('/download',              'InscricaoController@downloadArquivo'      )->name('download');

Route::post('/novoEdital',           'EditalController@novoEdital'              )->name('novoEdital');
Route::post('/listaEditais',         'EditalController@listaEditais'            )->name('listaEditais');
Route::post('/cadastroEdital',       'EditalController@cadastroEdital'          )->name('cadastroEdital');
Route::post('/listaInscricoes',      'EditalController@editalEscolhido'         )->name('editalEscolhido');

Route::post('/cadastroInscricao',    'InscricaoController@cadastroInscricao'    )->name('cadastroInscricao');
Route::post('/homologarInscricao',   'InscricaoController@inscricaoEscolhida'   )->name('inscricaoEscolhida');
Route::post('/inscricaoHomologada',  'InscricaoController@homologarInscricao'   )->name('homologarInscricao');
Route::post('/classificarInscricao', 'InscricaoController@classificarInscricao' )->name('classificarInscricao');
Route::post('/cadastroClassificacao','InscricaoController@cadastroClassificacao')->name('cadastroClassificacao');

Route::post('/cadastroIsencao',      'IsencaoController@cadastroIsencao'        )->name('cadastroIsencao');

Route::post('/cadastroRecurso',      'RecursoController@cadastroRecurso'        )->name('cadastroRecurso');
Route::post('/homologarRecurso',     'RecursoController@recursoEscolhido'       )->name('recursoEscolhido');
Route::post('/recursoHomologado',    'RecursoController@homologarRecurso'       )->name('homologarRecurso');
