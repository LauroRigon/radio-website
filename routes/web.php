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
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index');

    //Rotas para gerenciamento de usuário
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UserController@index')->name('user_index')->middleware('master');  //pagina de usuários
        Route::post('/create', 'UserController@store')->middleware('master');  //criar usuário
        Route::put('/{id}', 'UserController@update'); //atualiza usuário
        Route::delete('/delete/{id}', 'UserController@destroy')->middleware('master'); //deleta usuário

        Route::get('/profile', 'UserController@show')->name('user_profile');
        Route::post('/changePassword', 'UserController@changePassword'); //troca senha
        Route::post('/uploadAvatar', 'UserController@uploadAvatar'); //upload do avatar

        Route::get('/getUsers', 'UserController@getUsers')->middleware('master'); //get all users
        Route::get('/getUserComplete/{user}', 'UserController@getUserComplete'); //retorna informações mais completas sobre usuário
        Route::get('/getCurrentUser', 'UserController@getCurrentUserData')->name('getCurrentUser'); //retorna informações sobre o user logado
    });

    //Rotas para gerenciamento de categoritas
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'CategoryController@index')->name('categories');  //pagina de categorias
        Route::post('/create', 'CategoryController@store');  //criar categoria
        Route::put('/edit/{id}', 'CategoryController@update'); //atualiza categoria
        Route::delete('delete/{id}', 'CategoryController@destroy'); //deleta categoria

        Route::get('/getCategories', 'CategoryController@getCategories');
    });

    //Rotas de gerenciamento de posts
    Route::group(['prefix' => 'posts'], function() {
        Route::get('/', 'PostController@index');  //pagina de posts

        Route::get('/create', 'PostController@create')->name('post_create');//formulário para criar post
        Route::post('/store', 'PostController@store')->name('post_store');  //criar post

        Route::put('/{id}', 'PostController@update'); //atualiza post
        Route::delete('/{id}', 'PostController@destroy'); //deleta post

        Route::post('/allowPost/{id}', 'PostController@allowPost')->middleware('master');//permite um post se publicado
        Route::post('/setAbout/{id}', 'PostController@setAsAbout')->middleware('master');//coloca um post como conteúdo da sessão sobre

        //Rotas para gerenciamento de galeria de imagens
        Route::group(['prefix' => 'gallery'], function () {
            Route::post('/sendGalleryImg', 'GalleryController@storeTempGallery')->name('send_gallery');//guarda galeria em pasta temp
            Route::post('/deleteGalleryImg', 'GalleryController@destroy');//deleta uma imagem da galeria
        });
    });

    Route::group(['prefix' => 'polls'], function() {
        Route::post('/', 'PollController@store');
        Route::delete('/{id}', 'PollController@destroy');

        Route::post('/addVote/{pollId}', 'PollController@addVote');
    });
});

Route::get('/home', 'HomeController@index');
