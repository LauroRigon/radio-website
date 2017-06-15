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
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

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

    //Rotas para gerenciamento de categorias
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'CategoryController@index')->name('categories');  //pagina de categorias
        Route::post('/create', 'CategoryController@store');  //criar categoria
        Route::put('/edit/{id}', 'CategoryController@update'); //atualiza categoria
        Route::delete('delete/{id}', 'CategoryController@destroy'); //deleta categoria

        Route::get('/getCategories', 'CategoryController@getCategories');
    });

    //Rotas de gerenciamento de posts
    Route::group(['prefix' => 'posts'], function() {
        Route::get('/', 'PostController@index')->name('post_index');  //pagina de posts
        Route::get('/preview/{post}', 'PostController@preview')->name('post_preview');

        Route::get('/create', 'PostController@create')->name('post_create');//formulário para criar post
        Route::post('/store', 'PostController@store')->name('post_store');  //criar post

        Route::get('/edit/{post}', 'PostController@edit');//form pra atualizar
        Route::post('/update/{post}', 'PostController@update')->name('post_update'); //atualiza post
        Route::delete('/delete/{id}', 'PostController@destroy')->name('post_delete'); //deleta post

        Route::get('/pending', 'PostController@pending')->name('post_pending')->middleware('master');  //pagina de posts nao autorizados
        Route::get('/getPendingPosts', 'PostController@getPendingPosts');

        Route::post('/approvePost/{post}', 'PostController@approvePost')->name('post_approve')->middleware('master');//permite um post ser publicado
        Route::post('/disapprovePost/{post}', 'PostController@disapprovePost')->name('post_disapprove')->middleware('master');//reprova um post ser publicado
        Route::post('/setAbout/{id}', 'PostController@setAsAbout')->middleware('master');//coloca um post como conteúdo da sessão sobre

        Route::get('/getMyPosts', 'PostController@getMyPosts');//retorna todos posts do user logado
        Route::get('/getGallery/{post}', 'PostController@getGallery');//retorna todas imagens de um post

        //Rotas para gerenciamento de galeria de imagens
        Route::group(['prefix' => 'gallery'], function () {
            Route::post('/sendGalleryImg', 'GalleryController@storeTempGallery')->name('send_gallery');//guarda galeria em pasta temp
            Route::post('/deleteGalleryImg', 'GalleryController@destroy');//deleta uma imagem da galeria
        });
    });

    Route::group(['prefix' => 'polls'], function() {
        Route::get('/', 'PollController@index')->name('poll_index');
        Route::get('/create', 'PollController@create')->name('poll_create');
        Route::post('/store', 'PollController@store');
        Route::delete('delete/{id}', 'PollController@destroy');

        Route::get('/view/{poll}', 'PollController@show')->name('poll_view');

        Route::post('/addVote/{pollId}', 'PollController@addVote');

        Route::get('/getMyPolls', 'PollController@getMyPolls');

        Route::post('/closePoll/{poll}', 'PollController@closePoll')->name('poll_close');
    });

    Route::group(['prefix' => 'notifications'], function() {
        Route::get('/', 'NotificationController@index')->name('notification_index');

        Route::get('/getNotifications', 'NotificationController@getNotifications')->name('notification_get');

        Route::post('/markAsRead', 'NotificationController@markAsRead')->name('notification_masrkAsRead');
    });

    Route::group(['prefix' => 'programming'], function() {
        Route::get('/', 'ProgrammingController@index')->name('programming_index');
    });
});

Route::get('/home', 'HomeController@index');
