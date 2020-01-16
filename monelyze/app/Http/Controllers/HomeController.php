<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use MonelyzeDB;
use App\Spend;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $date = date("Y-m-d", time());
        $spends = MonelyzeDB::getSpends($id, $date);

        return view('home', compact('spends'));
    }
}
