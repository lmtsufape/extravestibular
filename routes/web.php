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

Route::view('/password/reset', 'auth.passwords.reset')->name('password.request');

Auth::routes();

Route::get('/login',                         'InscricaoController@entrar'                       )->name('login');

Route::get('/downloadEdital',                'InscricaoController@downloadEdital'              )->name('downloadEdital');
Route::get('/listarEditais',                 'EditalController@iframeEditais'                   )->name('iframeEditais');
Route::post('/loginApi',                     'HomeController@loginApi'                          )->name('loginApi');

Route::group(['middleware' => ['lmts']], function(){
  Route::get('/home',                        'HomeController@index'                             )->name('home');
  Route::get('/home/servidor',               'HomeController@homeApi'                           )->name('homeApi');

  Route::get( '/novoEdital',                 'EditalController@novoEdital'                      )->name('novoEdital')->middleware('lmts');
  Route::post('/excluirEdital',              'EditalController@deleteEdital'                    )->name('apagarEdital');
  Route::get('/editarEdital',                'EditalController@editarEdital'                    )->name('editarEdital');
  Route::post('/listaEditais',               'EditalController@listaEditais'                    )->name('listaEditais');
  Route::post('/publicarEdital',             'EditalController@publicarEdital'                  )->name('publicarEdital');
  Route::post('/cadastroEdital',             'EditalController@cadastroEdital'                  )->name('cadastroEdital');
  Route::get( '/detalhes',                   'EditalController@detalhesEdital'                  )->name('detalhesEdital');
  Route::get( '/detalhes/servidor',          'EditalController@detalhesEdital'                  )->name('detalhesEditalServidor');
  Route::get( '/listaInscricoes',            'EditalController@editalEscolhido'                 )->name('editalEscolhido');
  Route::post('/gerarClassificacao',         'EditalController@gerarClassificacao'              )->name('gerarClassificacao');
  Route::get( '/detalhesPorcentagem',        'EditalController@detalhesPorcentagem'             )->name('detalhesPorcentagem');
  Route::post('/cadastroEditarEdital' ,      'EditalController@cadastroEditarEdital'            )->name('cadastroEditarEdital');

  Route::get('/edital/{edital}/analistas', 'AnalistaController@index')->name('analistas.index');
  Route::get('/edital/{edital}/analistas/create', 'AnalistaController@create')->name('analistas.create');
  Route::get('/analistas/editais', 'AnalistaController@editais')->name('analistas.editais');
  Route::get('/analistas/edital/{edital}', 'AnalistaController@edital')->name('analistas.edital');
  Route::post('/edital/{edital}/analistas', 'AnalistaController@store')->name('analistas.store');
  Route::delete('/analistas/{analista}', 'AnalistaController@destroy')->name('analistas.destroy');

  Route::post('/cadastroClassificacao',      'InscricaoController@cadastroClassificacao'        )->name('cadastroClassificacao');
  Route::get('/homologarCoordenador',        'InscricaoController@classificarInscricao'         )->name('classificarInscricao');
  Route::get('/classificarInscricao',        'InscricaoController@inscricaoEscolhida'           )->name('seguirParaClassificacao');
  Route::post('/notificarCoordenador',       'InscricaoController@notificarCoordenador'         )->name('notificarCoordenador');
  Route::get('/homologarInscricao',          'InscricaoController@inscricaoEscolhida'           )->name('inscricaoEscolhida');
  Route::post('/atualizarCursoTurno/{inscricao}',        'InscricaoController@atualizarCursoTurno'          )->name('atualizarCursoTurno');
  Route::post('/inscricaoHomologada',        'InscricaoController@homologarInscricao'           )->name('homologarInscricao');
  Route::post('/cadastroInscricao',          'InscricaoController@cadastroInscricao'            )->name('cadastroInscricao');
  Route::get('/ajax-listar-turnos',          'InscricaoController@ajaxCurso'                    )->name('ajaxListarCurso');
  Route::post('/cadastroDesempate',          'InscricaoController@cadastroDesempate'            )->name('cadastroDesempate');

  Route::get('/visualizarInscricao/{inscricao}', 'InscricaoController@visualizarInscricao')->name('visualizarInscricao');
  Route::post('/cadastroErrata',             'ErrataController@cadastroErrata'                  )->name('cadastroErrata');
  Route::post('/deleteErrata',               'ErrataController@deleteErrata'                    )->name('deleteErrata');
  Route::get('/novaErrata',                  'ErrataController@novaErrata'                      )->name('novaErrata');
  Route::post('/modificarErrata',             'ErrataController@modificarErrata'                 )->name('modificarErrata');

  Route::post('/cadastroIsencao',            'IsencaoController@cadastroIsencao'                )->name('cadastroIsencao');
  Route::get('/homologarIsencao',            'IsencaoController@isencaoEscolhida'               )->name('isencaoEscolhida');
  Route::get('/visualizarIsencao',           'IsencaoController@show'                           )->name('visualizarIsencao');
  Route::post('/isencaoHomologada',          'IsencaoController@homologarIsencao'               )->name('homologarIsencao');

  Route::post('/cadastroRecurso',            'RecursoController@cadastroRecurso'                )->name('cadastroRecurso');
  Route::get('/homologarRecurso',            'RecursoController@recursoEscolhido'               )->name('recursoEscolhido');
  Route::post('/recursoHomologado',          'RecursoController@homologarRecurso'               )->name('homologarRecurso');

  Route::get('/dadosUsuario',                'DadosUsuarioController@verDadosUsuario'           )->name('verDadosUsuario');
  Route::get('/editarDadosUsuario',          'DadosUsuarioController@editarDadosUsuario'        )->name('editarDadosUsuario');
  Route::post('/cadastroDadosUsuario',       'DadosUsuarioController@cadastroDadosUsuario'      )->name('cadastroDadosUsuario');
  Route::post('/cadastroEditarDadosUsuario', 'DadosUsuarioController@cadastroEditarDadosUsuario')->name('cadastroEditarDadosUsuario');

  Route::get('/download',                    'InscricaoController@downloadArquivo'              )->name('download');

});
