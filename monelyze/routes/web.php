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

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/home', 'HomeController@index');

Route::get('/logout', 'LogoutController@logout');

Route::get('/spend', 'SpendController@spend');
Route::post('/spend', 'ValiController@insertSpend');
Route::post('/spend/edit', 'ValiController@updateSpend');
Route::post('/spend/delete', 'SpendController@delete');

Route::get('/users/edit', 'UserController@index');
Route::get('/users/nameSetting', 'UserController@nameSetting');
Route::post('/users/nameSetting', 'UserController@nameSetting');
Route::get('/users/mailSetting', 'UserController@mailSetting');
Route::post('/users/mailSetting', 'UserController@mailSetting');

Route::get('/statistics', 'StatisticsController@index');
Route::get('/statistics/{year}', 'StatisticsController@show');

Route::get('/monthlyInput/{year}/{month}', 'MonthlyInputController@index');
Route::post('/monthlyInput/{year}/{month}', 'ValiController@insertMonthlyInput');
Route::put('/monthlyInput/{year}/{month}', 'ValiController@updateMonthlyInput');

Route::get('/payment', 'PaymentController@index');
Route::get('/payment/{year}/{month}', 'PaymentController@show');
Route::post('/payment/insert/{year}/{month}', 'ValiController@insertPayment');
Route::post('/payment/edit/{year}/{month}/', 'ValiController@updatePayment');
Route::post('/payment/delete/{year}/{month}/', 'PaymentController@delete');


