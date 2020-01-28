<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user_name = Auth::user()->name;;

        $total_monthly_consumption = MonelyzeDB::getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額
        $monthly_savings = MonelyzeDB::getMonthlySavings($user_id, $year);                    // 月ごとの節約額を取得
        $monthly_balance = MonelyzeDb::getMonthlyBalance($user_id, $year);                    // 月ごとの残金を取得
        $annual_consumption = array_sum($total_monthly_consumption); // 年間消費額
        $annual_savings = array_sum($monthly_savings);               // 年間節約額
        $annual_balance = array_sum($monthly_balance);               // 年間残金

        return view('statistics/statistics',compact(
                'total_monthly_consumption',
                'monthly_savings',
                'monthly_balance',
                'annual_consumption',
                'annual_savings',
                'annual_balance',
                'year',
                'user_name',
        ));
    }

    public function show($year)
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;;

        $total_monthly_consumption = MonelyzeDB::getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額
        $monthly_savings = MonelyzeDB::getMonthlySavings($user_id, $year);                    // 月ごとの節約額を取得
        $monthly_balance = MonelyzeDb::getMonthlyBalance($user_id, $year);                    // 月ごとの残金を取得
        $annual_consumption = array_sum($total_monthly_consumption); // 年間消費額
        $annual_savings = array_sum($monthly_savings);               // 年間節約額
        $annual_balance = array_sum($monthly_balance);               // 年間残金

        return view('statistics/statistics',compact(
                'total_monthly_consumption',
                'monthly_savings',
                'monthly_balance',
                'annual_consumption',
                'annual_savings',
                'annual_balance',
                'year',
                'user_name',
        ));
    }
}