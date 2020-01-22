<?php

namespace App\Services;

use DB;
use App\Spend;
use App\User;

class MonelyzeDB
{

    public function getUserName($id)
    {
        // 例：$users = DB::select('select * from users where active = ?', [1000]);
        $user = User::where('id', $id)->get()->first();
        $name = $user->name;

        return $name;
    }

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

    // 指定された年の月間消費額を取得(固定費を含む)
    public function getMonthlyConsumptionAndPayment($user_id, $year)
    {
        $start = $year . '0101';
        $end = $year . '1231';

        $monthly_total = DB::select(
            'select st.month, (ifnull(st.total, 0) + ifnull(pt.total, 0)) as total from (select date_format(date, "%m") as month, sum(amount) as total from spends where user_id = ? and date between ? and ? group by date_format(date, "%m") order by month) st left outer join (select month, sum(amount) as total from payments where user_id = ? and year = ? group by month order by month) pt on st.month = pt.month',
            [
                $user_id,
                $start,
                $end,
                $user_id,
                $year
            ]
        );
        
        return $monthly_total;
    }

    // 指定された年の月ごとの消費額合計を取得(固定費を含まない)
    public function getConsumption($user_id, $year)
    {
        $start = $year . '0101';
        $end = $year . '1231';

        $consumption = DB::select(
            'select date_format(date, "%m") as month, sum(amount) as total from spends where user_id = :user_id and date between :start and :end group by date_format(date, "%m") order by month',
            [
                'user_id' => $user_id,
                'start' => $start,
                'end' => $end
            ]
        );

        return $consumption;
    }

    // 指定された年月の消費額と目標支出の取得
    public function getConsumptionAndTargetSpending($user_id, $year)
    {
        $start = $year . '0101';
        $end = $year . '1231';

        $consumptionAndTargetSpending = DB::select(
            'select st.month, (ifnull(st.total, 0) + ifnull(pt.total, 0)) as total, ts.target_spending from (select date_format(date, "%m") as month, sum(amount) as total from spends where user_id = ? and date between ? and ? group by date_format(date, "%m") order by month) st left outer join (select month, sum(amount) as total from payments where user_id = ? and year = ? group by month order by month) pt on st.month = pt.month, (select month, target_spending from monthly_inputs where user_id = ? and year = ?) ts where st.month = ts.month;',
            [
                $user_id,
                $start,
                $end,
                $user_id,
                $year,
                $user_id,
                $year
            ]
        );

        return $consumptionAndTargetSpending;
    }

    // 指定された月の費目ごとの消費額を取得
    public function getExpenseConsumption($user_id, $year, $month)
    {
        $expenseConsumption = DB::select(
            'select expenses.name, ifnull(sum(spends.amount), 0) as total from (select date, expense_id, amount from spends where user_id = :user_id and date_format(date, "%Y") = :year and date_format(date, "%m") = :month) spends right outer join expenses on spends.expense_id = expenses.expense_id group by name',
            [
                'user_id' => $user_id,
                'year' => $year,
                'month' => $month
            ]
        );

        return $expenseConsumption;
    }
}
?>