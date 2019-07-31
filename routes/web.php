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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/listaEditais',        'EditalController@listaEditais'           )->name('listaEditais');
Route::post('/fazerInscricao',      'EditalController@editalEscolhido'        )->name('editalEscolhido');
Route::post('/cadastroEdital',      'EditalController@cadastroEdital'         )->name('cadastroEdital');
Route::post('/novoEdital',          'EditalController@novoEdital'             )->name('novoEdital');

Route::post('/cadastroInscricao',   'InscricaoController@cadastroInscricao'   )->name('cadastroInscricao');
Route::post('/homologarInscricao',  'InscricaoController@inscricaoEscolhida'  )->name('inscricaoEscolhida');
Route::post('/inscricaoHomologada', 'InscricaoController@homologarInscricao'  )->name('homologarInscricao');
Route::post('/classificarInscricao','InscricaoController@classificarInscricao')->name('classificarInscricao');
