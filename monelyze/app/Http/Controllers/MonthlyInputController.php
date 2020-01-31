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

    public function index($year, $month)
    {
        return view('/monthly_input/index', compact(
            'year',
            'month',
        ));
    }
}
