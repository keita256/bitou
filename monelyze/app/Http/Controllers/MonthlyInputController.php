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

    public function index()
    {
        $year = date('Y', time());
        $month = date('m', time());
        $username = Auth::user()->name;

        return view('/monthly_input/index', compact(
            'username',
            'year',
            'month'
        ));
    }

    public function show($year, $month)
    {
        $user_id = Auth::id();
        $username = Auth::user()->name;

        // 月初入力データを取得
        $monthly_input_data = MonelyzeDB::getMonthlyInput($user_id, $year, $month);
        $monthly_input_data = array_shit($monthly_input_data);

        return view('/monthly_input/index', compact(
            'username',
            'year',
            'month',
            'monthly_input_data'
        ));
    }

    public function create(Request $request, $year, $month)
    {
        $user_id = Auth::id();
        $username = Auth::user()->name;
        $take_amount = $request->take_amount;
        $target_spending = $request->target_spending;

        // 登録
        MonelyzeDB::insertPayment();
        
        return view('/monthly_input/index',compact(
            ''
        ));
    }
}
