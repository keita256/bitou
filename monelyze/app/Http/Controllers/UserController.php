<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MonelyzeDB;

class UserController extends Controller
{

    public function index()
    {
        $id = Auth::id();
        $username = MonelyzeDB::getUserName($id);
        $mail = Auth::user()->email;

        return view('user', compact('username'), compact('mail'));
    }

    public function nameSetting()
    {
        $username = Auth::user()->name;

        return view('/settings/nameSetting', compact('username'));
    }

    public function mailSetting()
    {
        $mail = Auth::user()->email;

        return view('/settings/mailSetting', compact('mail'));
    }
}
