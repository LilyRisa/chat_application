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
Route::post('/login', ['as' => 'login', 'uses' => 'HomeController@postLogin']);