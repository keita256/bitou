<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;

class SpendController extends Controller
{
    public function create()
    {
        
    }

    public function spend()
    {
        $id = Auth::id();
        $name = MonelyzeDB::getUserName($id);

        return view('spend/spend', compact('name'));
    }
}
