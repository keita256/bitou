<?php

namespace App\Http\Controllers;

use App\Services\MonelyzeDB as ServicesMonelyzeDB;
use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;

class SpendController extends Controller
{
    public function create()
    {
        

        if ($id = Auth::id()) {
            return redirect('/spend')->with('message', '入力しました');
        }
        return redirect('/spend')->with('message', '入力に誤りがあります')
    }

    public function spend()
    {
        $id = Auth::id();
        $username = MonelyzeDB::getUserName($id);
        $expenses = MonelyzeDB::getExpense();

        return view('spend/spend', compact('username', 'expenses'));
    }
}
