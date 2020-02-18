<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function () { 
    
Route::post('/tweet/create','ApiTweetController@addTweet');

Route::get('/tweets','ApiTweetController@showAllFollowingsTweets');

Route::delete('/tweet/{id}','ApiTweetController@destroy');

Route::post('/user/follow/{id}','AuthController@follow');

Route::post('/user/unfollow/{id}','AuthController@unFollow');




});

Route::post('/user/register','AuthController@register');

Route::post('/user/login','AuthController@login');