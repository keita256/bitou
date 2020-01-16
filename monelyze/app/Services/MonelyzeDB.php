<?php

namespace App\Services;

use DB;
use App\Spend;

class MonelyzeDB
{
    public function getSpends($user_id, $date)
    {
        // 例：$users = DB::select('select * from users where active = ?', [1000]);
        $spends = DB::select(
            'select date, name, content, amount from spends st inner join expenses et on st.expense_id = et.expense_id
            where user_id = :user_id and date = :date',
            [
                'user_id' => $user_id,
                'date' => $date
            ]
        );

        return $spends;
    }

    public function insertSpends($spends)
    {
        foreach($spends as $spend) {
            // 次のレコードに付与する連番の取得
            $num = DB::select(
                'select ifnull(max(number) + 1, 1) as num from spends where user_id = :user_id and date = :date',
                [
                    'user_id' => $spend->user_id,
                    'date' => $spend->date
                ]
            )[0]->num;

            // データの登録
            $new_spend = new Spend();
            $new_spend->user_id = $spend->user_id;
            $new_spend->date = $spend->date;
            $new_spend->number = $num;
            $new_spend->expense_id = $spend->expense_id;
            $new_spend->content = $spend->content;
            $new_spend->amount = $spend->amount;

            $new_spend->save();
        }
    }

    public function updateSpend($new_spend)
    {
        $spend = Spend::where('user_id', $new_spend->id)->
                        where('date', $new_spend->date)->
                        where('number', $new_Spend->number)->
                        get()->
                        first();
        
        $spend->expense_id = $new_spend->expense_id;
        $spend->content = $new_spend->content;
        $spend->amount = $new_spend->amount;

        return $spend->save();
    }

    public function deleteSpend($user_id, $date, $number)
    {
        $spend = Spend::where('user_id', $user_id)->
                        where('date', $date)->
                        where('number', $number)->
                        get()->
                        first();

        return $spend->delete();
    }

    public function getStatistics()
    {
        DB::select('select * from users where active = ?', [1]);
    }
}
?>