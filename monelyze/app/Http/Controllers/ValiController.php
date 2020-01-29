<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use Illuminate\Support\Facades\MonelyzeDB;
use App\Http\Controllers\HomeController;

class ValiController extends Controller
{
    public function receiveSpend(Request $request)
    {
        \Log::debug($request->all());


        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'spends.expense_id.*' => 'required|integer',
            'spends.content.*' => 'nullable|string',
            'spends.amount.*' => 'required|integer',
            'spend_date' => 'required|date',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return redirect('/spend')
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        $id = Auth::id();
        MonelyzeDB::insertSpends($request, $id);


        return redirect('/spend')
            ->with('message', '入力しました');
    }

    public function receivePayment(Request $request)
    {
        \Log::debug($request->all());

        $username = Auth::user()->name;

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'payments.content.*' => 'required|string',
            'payments.amount.*' => 'required|integer',
            'payment_date' => 'required|date_format:"Y/m"',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        return redirect('/payment')
            ->with('message', '入力しました');
    }
}
