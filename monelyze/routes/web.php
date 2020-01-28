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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/spend', 'SpendController@spend');

Route::post('/spend', 'ValiController@receiveSpend');

Route::get('/users/edit', 'UserController@edit');

Route::get('/statistics', 'StatisticsController@index');

Route::get('/', function () {
    return view('welcome');
});
