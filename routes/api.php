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
Route::post('/user/register','AuthController@register');
Route::post('/user/login','AuthController@login');


Route::get('greeting', 'MessageController@index')
      ->middleware('localization');

Route::middleware('auth:api')->group(function () { 
    // Tweets routes
    Route::get('/tweets/timeline','TweetController@index');
    Route::get('/tweets/user','TweetController@userTweets');
    Route::post('/tweets','TweetController@store');
    Route::delete('/tweets/{tweet}','TweetController@destroy');

    //Follow and Unfollow routes
    Route::post('/user/follow/{id}','FollowerController@follow');
    Route::post('/user/unfollow/{id}','FollowerController@unFollow');
});

