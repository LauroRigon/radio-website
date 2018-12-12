<?php

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/*
 * Rotas da área de admin do site
 * */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //Rotas de usuário
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UserController@index')->name('user_index')->middleware('master');  //pagina de usuários
        Route::post('/create', 'UserController@store')->middleware('master');  //criar usuário
        //Route::put('/{id}', 'UserController@update'); //atualiza usuário
        Route::delete('/delete/{id}', 'UserController@destroy')->middleware('master'); //deleta usuário

        Route::get('/profile', 'UserController@profile')->name('user_profile');
        Route::post('/changePassword', 'UserController@changePassword'); //troca senha
        Route::post('/uploadAvatar', 'UserController@uploadAvatar'); //upload do avatar
        Route::put('/setMaster/{user}', 'UserController@setMaster'); //troca senha

        Route::get('/getUsers', 'UserController@getUsers')->middleware('master'); //get all users
        Route::get('/getUserComplete/{user}', 'UserController@getUserComplete'); //retorna informações mais completas sobre usuário
        Route::get('/getCurrentUser', 'UserController@getCurrentUserData')->name('getCurrentUser'); //retorna informações sobre o user logado
    });

    //Rotas de categorias
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'CategoryController@index')->name('categories');  //pagina de categorias
        Route::post('/create', 'CategoryController@store');  //criar categoria
        Route::put('/edit/{id}', 'CategoryController@update'); //atualiza categoria
        Route::delete('delete/{id}', 'CategoryController@destroy'); //deleta categoria

        Route::get('/getCategories', 'CategoryController@getCategories');
    });

    //Rotas de posts
    Route::group(['prefix' => 'posts'], function() {
        Route::get('/', 'PostController@index')->name('post_index');  //pagina de posts
        Route::get('/preview/{post}', 'PostController@preview')->name('post_preview');

        Route::get('/create', 'PostController@create')->name('post_create');//formulário para criar post
        Route::post('/store', 'PostController@store')->name('post_store');  //criar post

        Route::get('/edit/{post}', 'PostController@edit');//form pra atualizar
        Route::post('/update/{post}', 'PostController@update')->name('post_update'); //atualiza post
        Route::delete('/delete/{id}', 'PostController@destroy')->name('post_delete'); //deleta post

        Route::get('/all', 'PostController@all')->name('post_all')->middleware('master');   //retorna view de todos os posts
        Route::get('/getAllPosts', 'PostController@getAllPosts')->middleware('master');   //retorna todos os posts
        Route::get('/pending', 'PostController@pending')->name('post_pending')->middleware('master');  //pagina de posts nao autorizados
        Route::get('/getPendingPosts', 'PostController@getPendingPosts');

        Route::post('/approvePost/{post}', 'PostController@approvePost')->name('post_approve')->middleware('master');//permite um post ser publicado
        Route::post('/disapprovePost/{post}', 'PostController@disapprovePost')->name('post_disapprove')->middleware('master');//reprova um post ser publicado
        Route::post('/setAbout/{id}', 'PostController@setAsAbout')->middleware('master');//coloca um post como conteúdo da sessão sobre

        Route::get('/getMyPosts', 'PostController@getMyPosts');//retorna todos posts do user logado

        //Rotas para galeria de imagens
        Route::group(['prefix' => 'gallery'], function () {
            Route::post('/sendGalleryImg', 'GalleryController@storeTempGallery')->name('send_gallery');//guarda galeria em pasta temp
            Route::post('/deleteGalleryImg', 'GalleryController@destroy');//deleta uma imagem da galeria
            Route::get('/getGallery/{post}', 'GalleryController@getGallery')->name('get_gallery');//retorna todas imagens de um post
        });
    });

    //Rotas para as enquetes
    Route::group(['prefix' => 'polls'], function() {
        Route::get('/', 'PollController@index')->name('poll_index');
        Route::get('/create', 'PollController@create')->name('poll_create');
        Route::post('/store', 'PollController@store');
        Route::delete('delete/{id}', 'PollController@destroy');

        Route::get('/view/{poll}', 'PollController@show')->name('poll_view');

        Route::get('/getMyPolls', 'PollController@getMyPolls');

        Route::post('/closePoll/{poll}', 'PollController@closePoll')->name('poll_close');
    });

    //Rotas para as notificações
    Route::group(['prefix' => 'notifications'], function() {
        Route::get('/', 'NotificationController@index')->name('notification_index');

        Route::get('/getNotifications', 'NotificationController@getNotifications')->name('notification_get');

        Route::post('/markAsRead', 'NotificationController@markAsRead')->name('notification_masrkAsRead');
    });

    //Rotas para programação
    Route::group(['prefix' => 'programming'], function() {
        Route::get('/', 'ProgrammingController@index')->name('programming_index');
        Route::get('/create', 'ProgrammingController@create')->name('programming_create');

        Route::post('/store', 'ProgrammingController@store')->name('programming_store');

        Route::get('/delete/{program}', 'ProgrammingController@destroy')->name('programming_delete');
    });

    //Rotas para pedidos de musicas
    Route::group(['prefix' => 'musicorders'], function() {
        Route::get('/', 'MusicOrderController@index')->name('musicorder_index');
        Route::get('/getMusicOrders', 'MusicOrderController@getMusicOrders')->name('musicorder_get');

        Route::get('/delete/{program}', 'MusicOrderController@destroy')->name('musicorder_delete');
    });

    Route::group(['prefix' => 'supporters'], function() {
        Route::get('/', 'SupportersController@index')->name('supporter_index');
        Route::get('/getSupporters', 'SupportersController@getSupporters');

        Route::get('/create', 'SupportersController@create');
        Route::post('/store', 'SupportersController@store')->name('supporter_store');

        Route::get('/edit/{supporter}', 'SupportersController@edit');
        Route::post('/update/{supporter}', 'SupportersController@update')->name('supporter_update');


        Route::delete('/delete/{supporter}', 'SupportersController@destroy');

    });
});

/*
 * Rotas públicas
 * */
Route::get('/', 'HomeController@index');


Route::get('/programacao', 'ProgrammingController@indexPublic')->name('programming_indexpublic');
Route::get('/locutores', 'UserController@indexPublic')->name('users_indexpublic');
Route::get('/sobre', 'HomeController@aboutShow')->name('about');

//enquetes apis
//Route::get('/getPoll/{poll}', 'PollController@getPoll')->name('poll_get');
//Route::post('/addVote/{pollId}', 'PollController@addVote')->name('add_vote');

//noticias
Route::group(['prefix' => 'noticias'], function () {
    Route::get('/{post}', 'PostController@show')->name('post_show');
    Route::get('/categoria/{categoria}', 'PostController@getByCategory')->name('post_getByCategory');
    Route::get('/getGallery/{post}', 'GalleryController@getGallery')->name('get_public_gallery');//retorna todas imagens de um post
});

//pedidos de musicas
Route::group(['prefix' => 'musicOrder'], function () {
    Route::post('/store', 'MusicOrderController@store')->name('order_store');
});

