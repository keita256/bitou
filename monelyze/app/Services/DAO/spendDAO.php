<?php

namespace App\Services\DAO;

use DB;
use App\Spend;

class SpendDAO
{
    /*
    |--------------------------------------------
    | get method
    |--------------------------------------------
    */

    public function getSpends($user_id, $date)
    {
        $spends = DB::select(
            'select date, number, name, content, st.expense_id, amount from spends st inner join expenses et on st.expense_id = et.expense_id
            where user_id = :user_id and date = :date',
            [
                'user_id' => $user_id,
                'date' => $date
            ]
        );

        return $spends;
    }

    /*
    |--------------------------------------------
    | insert method
    |--------------------------------------------
    */

    public function insertSpends($user_id, $date, $spends)
    {
        $result = false;

        $expense = $spends['expense_id'];
        $content = $spends['content'];
        $amount = $spends['amount'];

        $date = str_replace('/', '-', $date);

        for($i = 0; $i < count($expense); $i++) {
            // 次のレコードに付与する連番の取得
            $num = DB::select(
                'select ifnull(max(number) + 1, 1) as num from spends where user_id = :user_id and date = :date',
                [
                    'user_id' => $user_id,
                    'date' => $date
                ]
            );
            $num = array_shift($num)->num;

            // データの登録
            $new_spend = new Spend();
            $new_spend->user_id = $user_id;
            $new_spend->date = $date;
            $new_spend->number = $num;
            $new_spend->expense_id = $expense[$i];
            $new_spend->content = $content[$i];
            $new_spend->amount = $amount[$i];

            $result = $new_spend->save(); // 戻り値boolean

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

    public function updateSpend($user_id, $date, $number, $expense_id, $content, $amount)
    {
        return $spend = Spend::where('user_id', $user_id)->
                        where('date', $date)->
                        where('number', $number)->
                        update(
                            [
                                'expense_id' => $expense_id,
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

    public function deleteSpend($user_id, $date, $number)
    {
        return $spend = Spend::where('user_id', $user_id)->
                        where('date', $date)->
                        where('number', (int)$number)->
                        delete();
    }
}

?>