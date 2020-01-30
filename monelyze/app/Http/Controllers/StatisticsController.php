<?php

namespace App\Http\Controllers;

use App\Services\MonthlyDataLogic;
use App\Services\StatisticsLogic;
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
        $username = Auth::user()->name;
        $monthly_consumption = MonelyzeDB::getMonthlyConsumption($user_id, $year); // 月ごとの消費額(固定費を含まない)
        $monthly_fixed_costs = MonelyzeDB::getMonthlyFixedCosts($user_id, $year); // 月ごとの固定費を取得

        // オブジェクトを配列に変換
        $monthly_consumption = MonthlyDataLogic::monthlyDataToArray($monthly_consumption);
        $monthly_fixed_costs = MonthlyDataLogic::monthlyDataToArray($monthly_fixed_costs);

        $monthly_savings = MonelyzeDB::getMonthlySavings($user_id, $year); // 月ごとの節約額を取得
        $monthly_balance = MonelyzeDb::getMonthlyBalance($user_id, $year); // 月ごとの残金を取得
        $annual_consumption = array_sum(MonthlyDataLogic::addArrayElement($monthly_consumption, $monthly_fixed_costs)); // 年間消費額
        $annual_savings = array_sum($monthly_savings); // 年間節約額
        $annual_balance = array_sum($monthly_balance); // 年間残金

        return view('statistics/statistics', compact(
            'monthly_consumption',
            'monthly_fixed_costs',
            'monthly_savings',
            'monthly_balance',
            'annual_consumption',
            'annual_savings',
            'annual_balance',
            'year',
            'username',
        ));
    }

    public function show($year)
    {
        // 初期化
        $user_id = Auth::id();
        $username = Auth::user()->name;
        $monthly_consumption = [];
        $monthly_fixed_costs = [];
        $monthly_savings = [];
        $monthly_balance = [];
        $annual_consumption = 0;
        $annual_savings = 0;
        $annual_balance = 0;
        

        if (StatisticsLogic::monthlyDataIsEmpty($user_id, $year)) {
            $monthly_consumption = MonelyzeDB::getMonthlyConsumption($user_id, $year); // 月ごとの消費額(固定費を含まない)
            $monthly_fixed_costs = MonelyzeDB::getMonthlyFixedCosts($user_id, $year); // 月ごとの固定費を取得

            // オブジェクトを配列に変換
            $monthly_consumption = MonthlyDataLogic::monthlyDataToArray($monthly_consumption);
            $monthly_fixed_costs = MonthlyDataLogic::monthlyDataToArray($monthly_fixed_costs);

            $monthly_savings = MonelyzeDB::getMonthlySavings($user_id, $year); // 月ごとの節約額を取得
            $monthly_balance = MonelyzeDb::getMonthlyBalance($user_id, $year); // 月ごとの残金を取得
            $annual_consumption = array_sum(MonthlyDataLogic::addArrayElement($monthly_consumption, $monthly_fixed_costs)); // 年間消費額
            $annual_savings = array_sum($monthly_savings); // 年間節約額
            $annual_balance = array_sum($monthly_balance); // 年間残金
        }

        return view('statistics/statistics', compact(
            'monthly_consumption',
            'monthly_fixed_costs',
            'monthly_savings',
            'monthly_balance',
            'annual_consumption',
            'annual_savings',
            'annual_balance',
            'year',
            'username',
        ));
    }

}
