<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\MonelyzeDB;

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
        $username = Auth::user()->name;
        $date = date("Y-m", time());
        $display_date = date("Y年m月", time());
        $month = date("m", time());
        $year = date("Y", time());

        $payments = MonelyzeDB::getPayments($id, $year, $month);

        $monthArray = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");

        return view('/payment/payment', [
            'username' => $username,
            'payments' => $payments,
            'display_date' => $display_date,
            'year' => $year,
            'month' => $month,
            'monthArray' => $monthArray
        ]);
    }

    public function show($yearmonth)
    {
        $id = Auth::id();
        $username = Auth::user()->name;
        $date = date("Y-m", time());
        $year = substr($yearmonth, 0, 4);
        $month = substr($yearmonth, -2);

        $payments = MonelyzeDB::getPayments($id, $year, $month);

        //ここ

        $monthArray = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");

        return view('/payment/payment', [
            'username' => $username,
            'payments' => $payments,
            'year' => $year,
            'month' => $month,
            'monthArray' => $monthArray
        ]);
    }
}