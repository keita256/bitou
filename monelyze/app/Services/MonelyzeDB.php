<?php

namespace App\Services;

use DB;
use App\Spend;

class MonelyzeDB
{
    public function getSpends($id, $date)
    {
        // 例：$users = DB::select('select * from users where active = ?', [1000]);
        $spends = DB::select(
            'select date, name, content, amount from spends st inner join expenses et on st.expense_id = et.expense_id
            where user_id = :user_id and date = :date',
            [
                'user_id' => $id,
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
            $newSpend = new Spend();
            $newSpend->user_id = $spend->user_id;
            $newSpend->date = $spend->date;
            $newSpend->number = $num;
            $newSpend->expense_id = $spend->expense_id;
            $newSpend->content = $spend->content;
            $newSpend->amount = $spend->amount;

            $newSpend->save();
        }
    }

    public function updateSpend($newSpend)
    {
        $spend = Spend::where('user_id', $newSpend->id)->
                        where('date', $newSpend->date)->
                        where('number', $newSpend->number)->
                        get()->
                        first();
        
        $spend->expense_id = $newSpend->expense_id;
        $spend->content = $newSpend->content;
        $spend->amount = $newSpend->amount;

        return $spend->save();
    }

    public function deleteSpend($id, $date, $number)
    {
        $spend = Spend::where('user_id', $id)->
                        where('date', $date)->
                        where('number', $number)->
                        get()->
                        first();

        return $spend->delete();
    }
}
?>