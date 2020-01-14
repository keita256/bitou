<?php

namespace App\Services;

use DB;

class MonelyzeDB
{
    public function getSpends($id, $date)
    {
        // 例：$users = DB::select('select * from users where active = ?', [1000]);
        $spends = DB::select(
            'select date, name, content, amount from spends st inner join expenses et on st.expense_id = et.expense_id
            where user_id = :id and date = :date',
            ['id' => $id, 'date' => $date]
        );

        return $spends;
    }

    public function insertSpends($spends)
    {
        foreach($spends as $spend) {
            DB::insert('insert into users (id, name) values (:id, :date, :expense_id, :content, )', [1, 'Dayle']);
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
?>