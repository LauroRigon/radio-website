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
    Route::get('/users', 'UserController@index');  //criar usuário
    Route::post('/users', 'UserController@store');  //criar usuário
    Route::put('/users/{id}', 'UserController@update'); //atualiza usuário
    Route::delete('/users/{id}', 'UserController@destroy'); //deleta usuário

    Route::put('/users/changePassword/{id}', 'UserController@changePassword'); //troca senha
    Route::post('/users/uploadAvatar/{id}', 'UserController@uploadAvatar'); //upload do avatar
});

Route::get('/home', 'HomeController@index');
