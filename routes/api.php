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

Route::get('/polls/getPolls', 'Api\PollController@getPolls');
Route::get('/polls/getPoll/{poll}', 'Api\PollController@getPoll');
Route::post('/polls/addVote', 'Api\PollController@addVote');
