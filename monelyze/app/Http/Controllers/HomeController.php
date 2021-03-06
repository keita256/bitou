<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use MonelyzeDB;
use App\Spend;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $date = date("Y-m-d", time());
        $month = date("m", time());
        $year = date("Y", time());
        $day = date("d", time());

        // 家計簿データ取得
        $spends = MonelyzeDB::getSpends($user_id, $date);

        // 費目の取得
        $expenses = MonelyzeDB::getExpense();

        // 当月の費目ごとの消費額を取得
        $monthly_expense_consumptions = MonelyzeDB::getExpenseConsumption($user_id, $year, $month);

        // 月初入力データの取得
        $monthly_input = MonelyzeDB::getMonthlyInput($user_id, $year, $month);

        // 月初入力データが存在するか
        $monthly_input_data_is_empty = MonelyzeDB::isEmptyMonthlyInput($user_id, $year, $month);
        $monthly_input_data_is_empty = array_shift($monthly_input_data_is_empty)->emp;

        return view('home', compact(
            'spends',
            'expenses',
            'year',
            'month',
            'day',
            'monthly_expense_consumptions',
            'monthly_input',
            'monthly_input_data_is_empty'
        ));
    }

    public function show($year, $month, $day)
    {
        $user_id = Auth::id();
        $date = $year . '-' . $month . '-' .$day;

        // 家計簿データ取得
        $spends = MonelyzeDB::getSpends($user_id, $date);

        // 費目の取得
        $expenses = MonelyzeDB::getExpense();

        // 当月の費目ごとの消費額を取得
        $monthly_expense_consumptions = MonelyzeDB::getExpenseConsumption($user_id, $year, $month);

        // 月初入力データの取得
        $monthly_input = MonelyzeDB::getMonthlyInput($user_id, $year, $month);

        // 月初入力データが存在するか
        $monthly_input_data_is_empty = MonelyzeDB::isEmptyMonthlyInput($user_id, $year, $month);
        $monthly_input_data_is_empty = array_shift($monthly_input_data_is_empty)->emp;

        return view('home', compact(
            'spends',
            'expenses',
            'year',
            'month',
            'day',
            'monthly_expense_consumptions',
            'monthly_input',
            'monthly_input_data_is_empty'
        ));
    }
}
