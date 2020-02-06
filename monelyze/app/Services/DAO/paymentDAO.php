<?php

namespace App\Services\DAO;

use DB;
use App\Payment;

class PaymentDAO
{
    /*
    |--------------------------------------------
    | get method
    |--------------------------------------------
    */

    public function getPayments($user_id, $year, $month)
    {
        $fixedConsts = DB::select(
            'select number, content, amount from payments where user_id = :user_id and year = :year and month = :month',
            [
                'user_id' => $user_id,
                'year' =>$year,
                'month' => $month
            ]
        );

        return $fixedConsts;
    }

    /*
    |--------------------------------------------
    | insert method
    |--------------------------------------------
    */

    public function insertPayments($user_id, $year, $month, $payments)
    { 
        $result = false;
        $content = $payments['content'];
        $amount = $payments['amount'];
        
        for($i = 0; $i < count($content); $i++) {
            // 次のレコードに付与する連番の取得
            $num = DB::select(
                'select ifnull(max(number) + 1, 1) as num from payments where user_id = :user_id and year = :year and month = :month',
                [
                    'user_id' => $user_id,
                    'year' => $year,
                    'month' => $month
                ]
            );
            $num = array_shift($num)->num;

            // データの登録
            $new_payment = new Payment();
            $new_payment->user_id = $user_id;
            $new_payment->year = $year;
            $new_payment->month = $month;
            $new_payment->number = $num;
            $new_payment->content = $content[$i];
            $new_payment->amount = $amount[$i];

            $result = $new_payment->save();

            if($result == false) {
                return $result;
            }
        }

        return $result;
    }

    /*
    |--------------------------------------------
    | update method
    |--------------------------------------------
    */

    public function updatePayment($user_id, $year, $month, $number, $content, $amount)
    {
        return $payment = Payment::where('user_id', $user_id)->
                            where('year', $year)->
                            where('month', $month)->
                            where('number', $number)->
                            update(
                                [
                                    'content' => $content,
                                    'amount' => $amount
                                ]
                            );
    }

    /*
    |--------------------------------------------
    | delete method
    |--------------------------------------------
    */

    public function deletePayment($user_id, $year, $month, $number)
    {
        return $payment = Payment::where('user_id', $user_id)->
                            where('year', $year)->
                            where('month', $month)->
                            where('number', $number)->
                            delete();
    }
}

?>