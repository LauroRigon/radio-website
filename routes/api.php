<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Polls
Route::get('/polls/getPolls', 'Api\PollController@getPolls');
Route::get('/polls/getPoll/{poll}', 'Api\PollController@getPoll');
Route::post('/polls/addVote', 'Api\PollController@addVote');

//Supporters
Route::get('/supporters/getSupporters/{side}', 'Api\SupportersController@getSupporters');

//Posts
Route::get('/posts/getAbout', 'Api\PostController@getAbout'); //About
Route::get('/posts/getPosts', 'Api\PostController@getPosts');
Route::get('/posts/{slug}', 'Api\PostController@getPost');
Route::get('/posts/byCategory/{category}', 'Api\PostController@getByCategory');

//Programming
Route::get('/programming/today', 'Api\ProgrammingController@getTodayProgramming');
Route::get('/programming', 'Api\ProgrammingController@getProgramming');

//Speakers
Route::get('/speakers', 'Api\UserController@getUsers');

//MusicOrders
Route::post('/musicOrder/store', 'Api\MusicOrderController@store');

//Categories
Route::get('/categories', 'Api\CategoryController@getCategories');