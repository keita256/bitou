<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use MonelyzeDB;

class MonthlyInputController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    public function show($year, $month)
    {
        $user_id = Auth::id();

        // 月初入力データを取得
        $monthly_input_data = MonelyzeDB::getMonthlyInput($user_id, $year, $month);
        $monthly_input_data = array_shit($monthly_input_data);

        return view('/monthly_input/index', compact(
            'year',
            'month',
            'monthly_input_data'
        ));
    }

    public function create(Request $request, $year, $month)
    {
        $user_id = Auth::id();
        $take_amount = $request->take_amount;         // 手取り収入
        $target_spending = $request->target_spending; // 目標支出

        // データベースに登録
        $monthly_input_data = MonelyzeDB::insertPayment($user_id, $year, $month, $take_amount, $target_spending);

        // 月初入力データを取得
        $monthly_input_data = MonelyzeDB::getMonthlyInput($user_id, $year, $month);
        $monthly_input_data = array_shit($monthly_input_data);
        
        return view('/monthly_input/index',compact(
            'year',
            'month',
            'monthly_input_data'
        ));
    }
}
