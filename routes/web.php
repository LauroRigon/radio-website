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

Auth::routes();

/*
 * Rotas da área de admin do site
 * */
Route::group(['prefix' => 'admin'], function () {
    //Rotas para gerenciamento de usuário
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UserController@index');  //pagina de usuários
        Route::post('/', 'UserController@store');  //criar usuário
        Route::put('/{id}', 'UserController@update'); //atualiza usuário
        Route::delete('/{id}', 'UserController@destroy'); //deleta usuário

        Route::put('/changePassword/{id}', 'UserController@changePassword'); //troca senha
        Route::post('/uploadAvatar/{id}', 'UserController@uploadAvatar'); //upload do avatar
    });

    //Rotas para gerenciamento de categoritas
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'UserController@index');  //pagina de categorias
        Route::post('/', 'UserController@store');  //criar categoria
        Route::put('/{id}', 'UserController@update'); //atualiza categoria
        Route::delete('/{id}', 'UserController@destroy'); //deleta categoria
    });

});

Route::get('/home', 'HomeController@index');
