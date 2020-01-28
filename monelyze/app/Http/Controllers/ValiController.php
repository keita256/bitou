<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Facades\MonelyzeDB;

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

        

        
        return redirect('/spend')
            ->with('message', '入力しました');
    }
}
