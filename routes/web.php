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

Route::middleware('auth')->group(function(){
    Route::get('/tweets',  'TweetsController@index')->name('home');
    Route::POST('/tweets', 'TweetsController@store');
    
    Route::POST('/profiles/{username}/follow','FollowsController@store');
    Route::get('/profiles/{username}/edit','ProfilesController@edit'); //->middleware('can:edit,user');

    Route::patch('/profiles/{username}','ProfilesController@update');
});

Route::get('/profiles/{username}','ProfilesController@show')->name('profile');


Auth::routes(); 