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

        return view('/payment/payment', [
            'username' => $username,
            'payments' => $payments,
            'display_date' => $display_date
        ]);
    }
}
