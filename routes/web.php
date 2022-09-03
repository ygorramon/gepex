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
    return view('welcome');
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
Route::post('/gepex/{id}/enviar-aprovação','GepexController@enviar_aprovacao')->middleware('auth')->name('gepex-enviar-aprovacao');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
