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

Route::get('/spend', 'SpendController@spend');
Route::post('/spend', 'ValiController@insertSpend');

Route::get('/users/edit', 'UserController@index');
Route::get('/users/nameSetting', 'UserController@nameSetting');
Route::post('/users/nameSetting', 'UserController@nameSetting');
Route::get('/users/mailSetting', 'UserController@mailSetting');
Route::post('/users/mailSetting', 'UserController@mailSetting');

Route::get('/statistics', 'StatisticsController@index');
Route::get('/statistics/{year}', 'StatisticsController@show');

Route::get('/monthlyInput', function () {
    $year = date('Y', time());
    $month = date('m', time());

    return view('/monthly_input/index', compact('year', 'month'));
});
Route::get('/monthlyInput/{year}/{month}', 'MonthlyInputController@index');
Route::post('/monthlyInput/{year}/{month}', 'ValiController@insertMonthlyInput');

Route::get('/payment', 'PaymentController@index');
Route::get('/payment/{year}/{month}', 'PaymentController@show');
Route::post('/payment/insert/{year}/{month}', 'ValiController@insertPayment');
Route::post('/payment/edit/{year}/{month}/', 'ValiController@updatePayment');
Route::post('/payment/delete/{year}/{month}/', 'PaymentController@delete');


