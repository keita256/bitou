<?php

namespace App\Http\Controllers;

use Auth;
use MonelyzeDB;

class StatisticsController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();
        $year = date("Y", time());

        // 統計データオブジェクトを取得
        $statistics_data = MonelyzeDB::getStatistics($user_id, $year);

        return view('statistics/statistics', compact(
            'statistics_data',
            'year'
        ));
    }

    public function show($year)
    {
        // 初期化
        $user_id = Auth::id();

        // 統計データオブジェクトを取得
        $statistics_data = MonelyzeDB::getStatistics($user_id, $year);

        return view('statistics/statistics', compact(
            'statistics_data',
            'year'
        ));
    }

}
