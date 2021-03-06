<?php

namespace App\Http\Controllers;

use App\Services\MonelyzeDB as ServicesMonelyzeDB;
use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;

class SpendController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->middleware('auth');
    }

    public function spend()
    {
        $id = Auth::id();
        $username = Auth::user()->name;
        $expenses = MonelyzeDB::getExpense();

        return view('spend/spend', compact('username', 'expenses'));
    }

    public function delete(Request $request)
    {
        $id = Auth::id();
        $date = $request->spend_date;
        $number = $request->number;

        MonelyzeDB::deleteSpend($id, $date, $number);

        return back()
            ->with('message', '削除しました');
    }
}
