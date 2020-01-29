<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;

        return view('/payment/payment', compact('username'));
    }
}
