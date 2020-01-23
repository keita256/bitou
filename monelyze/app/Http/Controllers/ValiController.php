<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class ValiController extends Controller
{
    public function receiveData(Request $request)
    {
        // バリデーションルール
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'age' => 'required|integer',
            'file' => 'required|file|image|max:10000',
            'comment' => 'required',
        ]);

        // バリデーションエラーだった場合
        if ($validator->fails()) {
            return redirect('')
                ->withErrors($validator)
                ->withInput();
        }

        return view('sample_vali', ['status' => true]);
    }
}
