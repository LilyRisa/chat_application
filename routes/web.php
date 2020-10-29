<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@getHome']);
Route::get('/', ['as' => 'login', 'uses' => 'HomeController@login']);
Route::post('/reg', ['as' => 'reg', 'uses' => 'HomeController@postRegister']);
Route::post('/login', ['as' => 'postlogin', 'uses' => 'HomeController@postLogin']);

Route::middleware(['checkuser'])->group(function(){
	// profile
       Route::get('/profile', ['as' => 'profile', 'uses' => 'ProfileController@HomeProfile']);
       Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
       Route::get('/chatroom', ['as' => 'room', 'uses' => 'RoomController@index']);
       Route::get('/chatuser', ['as' => 'chatuser', 'uses' => 'ChatPrivateController@index']);
       Route::post('/des_profile', ['as' => 'des_profile', 'uses' => 'ProfileController@description']);
       Route::post('/gender_profile', ['as' => 'gender_profile', 'uses' => 'ProfileController@gender']);
       Route::post('/avatar', ['as' => 'avatar', 'uses' => 'ProfileController@avatar']);
     // end profile
     // search user
       Route::get('/search', ['as' => 'getsearch', 'uses' => 'UsersController@index']);
       Route::post('/search_users', ['as' => 'postsearch', 'uses' => 'UsersController@search']);

});