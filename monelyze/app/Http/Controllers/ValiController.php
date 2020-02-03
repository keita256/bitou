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
        
        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'spends.expense_id.*' => 'required|integer|min:1|max:15',
            'spends.content.*' => 'nullable|string|max:100',
            'spends.amount.*' => 'required|integer|digits_between:1,11',
            'spend_date' => 'required|date',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        // 登録処理
        $user_id = Auth::id();
        MonelyzeDB::insertSpends($user_id, $request->spend_date, $request->spends);

        return back()
            ->with('message', '入力しました');
    }

    public function updateSpend(Request $request)
    {

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'spends.expense_id.*' => 'required|integer|min:1|max:15',
            'spends.content.*' => 'nullable|string|max:100',
            'spends.amount.*' => 'required|integer|digits_between:1,11',
            'spend_date' => 'required|date',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        $user_id = Auth::id();
        $date = $request->spend_date;
        $number = $request->number;
        $expense_id = $request->expense_id;
        $content = $request->content;
        $amount = $request->amount;

        // 登録処理
        MonelyzeDB::updateSpend($user_id, $date, $number, $expense_id, $content, $amount);

        return back()
            ->with('message', '入力しました');
    }

    public function insertPayment(Request $request, $year, $month)
    {

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'payments.content.*' => 'required|string|max:100',
            'payments.amount.*' => 'required|integer|digits_between:1,11',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        $user_id = Auth::id();

        MonelyzeDB::insertPayments($user_id, $year, $month, $request->payments);

        return back()
            ->with('message', '入力しました');
    }

    public function updatePayment(Request $request, $year, $month)
    {

        $username = Auth::user()->name;

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'payments.content.*' => 'required|string|max:100',
            'payments.amount.*' => 'required|integer|digits_between:1,11',
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

        return back()
            ->with('message', '更新しました');
    }


    public function insertMonthlyInput(Request $request, $year, $month)
    {

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'take_amount' => 'required|integer|digits_between:1,11',
            'target_spending' => 'required|integer|digits_between:1,11',
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

    public function updateMonthlyInput(Request $request, $year, $month)
    {

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'take_amount' => 'required|integer|digits_between:1,11',
            'target_spending' => 'required|integer|digits_between:1,11',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        // 更新処理
        $user_id = Auth::id();
        MonelyzeDB::updateMonthlyInput($user_id, $year, $month, $request->take_amount, $request->target_spending);

        return back()
            ->with('message', '更新しました');
    }

    public function updateUserName(Request $request)
    {
        \Log::debug($request->all());

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'userName' => 'required|string',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        // 更新処理
        $user_id = Auth::id();
        MonelyzeDB::updateUserName($user_id, $request->userName);

        $username = MonelyzeDB::getUserName($user_id);
        $usermail = MonelyzeDB::getUserMail($user_id);

        return view('/user', [
            'username'=> $username,
            'mail' => $usermail,
        ])
            ->with('message', '更新しました');
    }

    public function updateUserMail(Request $request)
    {
        \Log::debug($request->all());

        // バリデーションルール
        $validator = Validator::make($request->all(), [

            'userMail' => 'required|email',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('message', '入力に誤りがあります');
        }

        // 更新処理
        $user_id = Auth::id();
        MonelyzeDB::updateUserMail($user_id, $request->userMail);

        $username = MonelyzeDB::getUserName($user_id);
        $usermail = MonelyzeDB::getUserMail($user_id);

        return view('/user', [
            'username'=> $username,
            'mail' => $usermail,
        ])
            ->with('message', '更新しました');
    }

}
