<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['domain' => Request::getHost()], function () {


    Route::get('/login', 'LoginController@login')->name('login');
    Route::get('/logar', 'LoginController@logar')->name('login.logar');
    Route::get('/logout', 'LoginController@logout')->name('login.logout');

//SYSTEM
    Route::get('/cep', 'Controller@cep')->name('cep');
//EMAIL
    Route::get('/mail', 'Backoffice\HomeController@mail')->name('email');

    /*
     * BACKOFFICE
     */
    Route::group(array('middleware' => ['web', 'auth']), function () {
        /*
         * ROTAS ADMIN
         */
        Route::get('/', 'Backoffice\HomeController@index')->name('dashboard')->middleware('auth');

        /*
         * FINANCEIRO
         */
        Route::get('/categoria', 'Backoffice\CategoriaController@index')->name('categoria.index')->middleware('auth');
        Route::get('/categoria/create', 'Backoffice\CategoriaController@create')->name('categoria.create')->middleware('auth');
        Route::post('/categoria/save', 'Backoffice\CategoriaController@save')->name('categoria.save')->middleware('auth');
        Route::get('/categoria/{id}/edit', 'Backoffice\CategoriaController@edit')->name('categoria.edit')->middleware('auth');
        Route::get('/categoria/{id}/delete', 'Backoffice\CategoriaController@delete')->name('categoria.delete')->middleware('auth');
        Route::post('/categoria/{id}/update', 'Backoffice\CategoriaController@update')->name('categoria.update')->middleware('auth');
        Route::get('/categoria/data', 'Backoffice\CategoriaController@data')->name('categoria.data')->middleware('auth');


        //Lancamentos

        Route::get('/lancamento', 'Backoffice\LancamentoController@index')->name('lancamento.index')->middleware('auth');
        Route::get('/lancamento/create', 'Backoffice\LancamentoController@create')->name('lancamento.create')->middleware('auth');
        Route::post('/lancamento/save', 'Backoffice\LancamentoController@save')->name('lancamento.save')->middleware('auth');
        Route::get('/lancamento/{id}/edit', 'Backoffice\LancamentoController@edit')->name('lancamento.edit')->middleware('auth');
        Route::get('/lancamento/{id}/delete', 'Backoffice\LancamentoController@delete')->name('lancamento.delete')->middleware('auth');
        Route::post('/lancamento/{id}/update', 'Backoffice\LancamentoController@update')->name('lancamento.update')->middleware('auth');
        Route::get('/lancamento/data', 'Backoffice\LancamentoController@data')->name('lancamento.data')->middleware('auth');
        Route::get('/lancamento/{tipo}/grid/','Backoffice\LancamentoController@grid')->name('lancamento.grid')->middleware('auth');

        //Fluxo Caixa

        Route::get('/fluxo', 'Backoffice\FluxoController@index')->name('fluxo.index')->middleware('auth');

        /*
         * Usuarios
         */
        Route::get('/usuario', 'Backoffice\UsuarioController@index')->name('usuario.index')->middleware('auth');
        Route::get('/usuario/edit/{id}', 'Backoffice\UsuarioController@edit')->name('usuario.edit')->middleware('auth');
        Route::post('/usuario/update/{id}', 'Backoffice\UsuarioController@update')->name('usuario.update')->middleware('auth');
        Route::get('/usuario/delete/{id}', 'Backoffice\UsuarioController@delete')->name('usuario.delete')->middleware('auth');
        Route::get('/usuario/data', 'Backoffice\UsuarioController@data')->name('usuario.data')->middleware('auth');
        Route::get('/usuario/create', 'Backoffice\UsuarioController@create')->name('usuario.create')->middleware('auth');
        Route::post('/usuario/save', 'Backoffice\UsuarioController@save')->name('usuario.save')->middleware('auth');


    });
});
