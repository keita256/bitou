<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use MonelyzeDB;
use App\Http\Controllers\HomeController;

class ValiController extends Controller
{
    public function insertSpend(Request $request)
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

        // 登録処理
        $user_id = Auth::id();
        MonelyzeDB::insertSpends($user_id, $request->spend_date, $request->spends);

        return redirect('/spend')
            ->with('message', '入力しました');
    }

    public function insertPayment(Request $request, $year, $month)
    {
        \Log::debug($request->all());

        $username = Auth::user()->name;

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'payments.content.*' => 'required|string',
            'payments.amount.*' => 'required|integer',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        $user_id = Auth::id();

        MonelyzeDB::insertPayments($user_id, $year, $month, $request->payments);

        return redirect('/payment')
            ->with('message', '入力しました');
    }

    public function updatePayment(Request $request, $year, $month)
    {
        \Log::debug($request->all());

        $username = Auth::user()->name;

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'payments.content.*' => 'required|string',
            'payments.amount.*' => 'required|integer',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        $user_id = Auth::id();
        $number = $request->number;
        $content = $request->content;
        $amount = $request->amount;

        MonelyzeDB::updatePayment($user_id, $year, $month, $number, $content, $amount);

        return redirect('/payment')
            ->with('message', '更新しました');
    }


    public function insertMonthlyInput(Request $request, $year, $month)
    {
        \Log::debug($request->all());

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'take_amount' => 'required|integer',
            'target_spending' => 'required|integer',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        // 登録処理
        $user_id = Auth::id();
        MonelyzeDB::insertMonthlyInput($user_id, $year, $month, $request->take_amount, $request->target_spending);

        return redirect('/monthlyInput/' . $year . '/' . $month)
            ->with('message', '入力しました');
    }

    public function updateUser(Request $request)
    {
        \Log::debug($request->all());

        $username = Auth::user()->name;

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        return redirect('/user/edit')
            ->with('message', '入力しました');
    }


}
