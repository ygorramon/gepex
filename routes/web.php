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
  return redirect()->route('login');
});

Route::prefix('admin')->middleware('can:admin')->group(
    function () {
Route::resource('/usuario', 'UserController')->middleware('auth');
Route::resource('/etapa', 'StepController')->middleware('auth');
Route::resource('/secretaria', 'SecretaryController')->middleware('auth');
Route::resource('/gepex', 'GepexController')->middleware('auth');
Route::get('/secretaria/{id}/servidores', 'SecretaryController@servidores')->middleware('auth');
Route::get('/secretaria/{id}/editar-servidores', 'SecretaryController@adicionarServidores')->middleware('auth');
Route::post('secretaria/{id}/editar-servidores', 'SecretaryController@storeServidores')->middleware('auth');
Route::get('/gepex/{id}/secretaria','GepexController@secretaria')->middleware('auth')->name('gepex-secretaria');

Route::get('/gepex/{id}/secretaria/create', 'GepexController@create')->middleware('auth')->name('gepex-secretaria-create');
Route::post('/gepex/{id}/secretaria/create', 'GepexController@store')->middleware('auth')->name('gepex-secretaria-store');
Route::post('/gepex/{id}/enviar-para-aprovacao', 'GepexController@enviar_para_aprovacao')->middleware('auth')->name('gepex-enviar-para-aprovacao');
    
Route::post('/gepex/{id}/enviar-aprovacao','GepexController@enviar_aprovacao')->middleware('auth')->name('gepex-enviar-aprovacao');
Route::post('/gepex/{id}/iniciar_execucao','GepexController@iniciar_execucao')->middleware('auth')->name('gepex-iniciar-execucao');
Route::get('/gepex-enviadas','GepexController@gepex_enviadas')->middleware('auth')->name('gepex-enviadas');
Route::get('/analise-gepex/{id}','GepexController@analise_gepex')->middleware('auth')->name('gepex-analise');
Route::post('/analise-gepex/{id}', 'GepexController@analisar_gepex')->middleware('auth')->name('gepex-analise-post');
Route::get('/gepex/{id}/definir_etapas', 'GepexController@defenir_etapas')->middleware('auth')->name('gepex-defenir-etapas');
Route::post('/gepex/{id}/definir_etapas', 'GepexController@defenir_etapas_store')->middleware('auth')->name('gepex-defenir-etapas-post');
Route::get('/gepex/{id}/ver_etapas', 'GepexController@ver_etapas')->middleware('auth')->name('gepex-ver-etapas');
Route::post('/gepex/{id}/etapa/{etapaid}/concluir', 'GepexController@concluir_etapa')->middleware('auth')->name('concluir-etapa');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::fallback(function () {
  return redirect()->route('login');
});