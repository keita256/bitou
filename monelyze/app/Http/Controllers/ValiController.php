<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class ValiController extends Controller
{
    public function receiveSpend(Request $request)
    {
        \Log::debug($request);

        
        // バリデーションルール
        $validator = Validator::make($request->all(), [
            'spend_id' => 'required|integer',
            'spend_content' => 'nullable|string',
            'spend_amount' => 'required|integer',
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
