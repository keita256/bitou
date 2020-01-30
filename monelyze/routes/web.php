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

use App\Http\Controllers\PaymentController;

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/spend', 'SpendController@spend');

Route::post('/spend', 'ValiController@receiveSpend');

Route::get('/users/edit', 'UserController@edit');

Route::get('/statistics', 'StatisticsController@index');
Route::get('/statistics/{year}', 'StatisticsController@show');

Route::get('/monthlyInput', 'MonthlyInputController@index');
Route::get('/monthlyInput/{year}/{month}', 'MonthlyInputController@show');
Route::post('/monthlyInput/{year}/{month}', 'MonthlyInputController@create');

Route::get('/payment', 'PaymentController@index');
Route::get('payment/{yearmonth}', 'PaymentController@show');
Route::post('/payment', 'ValiController@receivePayment');
Route::post('/payment/edit/{yearmonth}/{serialNum}', 'ValiController@receivePayment');
Route::post('/payment/delete/{yearmonth}/{serialNum}', 'PaymentController@delete');

Route::get('/', function () {
    return view('welcome');
});
