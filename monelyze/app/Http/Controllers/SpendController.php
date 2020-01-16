<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpendController extends Controller
{
    public function create()
    {
        
    }

    public function spend()
    {
        return view('spend');
    }
}
