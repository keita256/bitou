<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class MonthlyInputController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    public function index()
    {
        $username = Auth::user()->name;

        return view('/monthly_input/create', compact('username'));
    }
}
