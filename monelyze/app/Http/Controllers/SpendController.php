<?php

namespace App\Http\Controllers;

use App\Services\MonelyzeDB as ServicesMonelyzeDB;
use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;

class SpendController extends Controller
{

    public function spend()
    {
        $id = Auth::id();
        $username = Auth::user()->name;
        $expenses = MonelyzeDB::getExpense();

        return view('spend/spend', compact('username', 'expenses'));
    }
}
