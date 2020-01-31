<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;
use Illuminate\Support\Facades\Redirect;
use App\Services\MonthlyDataLogic;

class PaymentController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        $date = date("Y-m", time());
        $month = date("m", time());
        $month = (int)$month;
        $year = date("Y", time());

        $payments = MonelyzeDB::getPayments($id, $year, $month);
        $totalAmount = MonelyzeDB::getMonthlyFixedCosts($id, $year);
        $totalAmount = MonthlyDataLogic::monthlyDataToArray($totalAmount);

        return view('/payment/payment', [
            'payments' => $payments,
            'totalAmount' => $totalAmount,
            'year' => $year,
            'month' => $month,
        ]);
    }

    public function show($year, $month)
    {
        $id = Auth::id();
        $date = date("Y-m", time());

        $payments = MonelyzeDB::getPayments($id, $year, $month);
        $totalAmount = MonelyzeDB::getMonthlyFixedCosts($id, $year);
        $totalAmount = MonthlyDataLogic::monthlyDataToArray($totalAmount);

        return view('/payment/payment', [
            'payments' => $payments,
            'totalAmount' => $totalAmount,
            'year' => $year,
            'month' => $month,
        ]);
    }

    public function delete($year, $month)
    {
        $id = Auth::id();
        $username = Auth::user()->name;

        //削除処理

        return redirect();
    }
}