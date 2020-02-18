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

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/users','UserController@index');
    
    Route::get('/tweets/create','TweetController@create');
    Route::get('/tweets','TweetController@index')->name('tweets.index');
    Route::post('/tweets','TweetController@store');
    // Route::delete('/tweets/{tweet_id}', 'TweetController@destroy')->name('tweets.destroy');

    Route::get('users/{user_id}/follow', 'UserController@followUser')->name('user.follow');
    Route::get('Users/{user_id}/unfollow', 'UserController@unFollowUser')->name('user.unfollow');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');