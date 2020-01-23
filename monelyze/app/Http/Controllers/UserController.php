<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;

class UserController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $username = MonelyzeDB::getUserName($id);

        return view('user', compact('username'));
    }
}
