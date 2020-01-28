<?php

namespace App\Services;

use DB;
use App\Spend;
use App\User;
use App\Expense;

class MonelyzeDB
{

    public function getUserName($id)
    {
        $user = User::where('id', $id)->get()->first();
        $name = $user->name;

        return $name;
    }

    public function getExpense()
    {
        $expenses = Expense::get();

        return $expenses;

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

    // 指定された年月の月初入力レコードが存在するか取得
    public function getEmptyMonthlyInput($user_id, $year, $month)
    {
        $user_id = 1;
        $year = 2020;
        $month = 1;

        $result = DB::select(
            'select count(*) as emp from monthly_inputs where user_id = :user_id and year = :year and month = :month',
            [
                'user_id' => $user_id,
                'year' => $year,
                'month' => $month,
            ]
        );

        return $result;
    }

    // 指定された年の月ごとの消費額を取得(固定費を含まない)
    private function getMonthlyConsumption($user_id, $year)
    {
        $start = $year . '0101';
        $end = $year . '1231';

        $monthly_consumption = DB::select(
            'select date_format(date, "%m") as month, sum(amount) as total from spends where user_id = :user_id and date between :start and :end group by date_format(date, "%m") order by month',
            [
                'user_id' => $user_id,
                'start' => $start,
                'end' => $end
            ]
        );

        return $monthly_consumption;
    }

    // 指定された年の月ごとの固定費を取得
    private function getMonthlyFixedCosts($user_id, $year)
    {
        $monthly_fixed_costs = DB::select(
            'select month, sum(amount) as total from payments where user_id = :user_id and year = :year group by month order by month',
            [
                'user_id' => $user_id,
                'year' => $year
            ]
        );

        return $monthly_fixed_costs;
    }

    // 指定された年の月ごとの目標支出の取得
    private function getMonthlyTargetSpending($user_id, $year)
    {
        $monthly_target_spending = DB::select(
            'select month, target_spending from monthly_inputs where user_id = :user_id and year = :year',
            [
                'user_id' => $user_id,
                'year' => $year
            ]
        );

        return $monthly_target_spending;
    }

    // 指定された年の月ごとの手取り収入を取得
    private function getMonthlyTakeAmount($user_id, $year)
    {
        $monthly_take_amount = DB::select(
            'select month, take_amount from monthly_inputs where user_id = :user_id and year = :year',
            [
                'user_id' => $user_id,
                'year' => $year
            ]
        );

        return $monthly_take_amount;
    }

    // 指定された年の月ごとの消費額(固定費を含む)を取得し配列で返す
    public function getTotalMonthlyConsumption($user_id, $year)
    {
        $total_monthly_consumption = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 1月から12月のデータ
        
        $monthly_consumption = $this->getMonthlyConsumption($user_id, $year);
        $monthly_fixed_costs = $this->getMonthlyFixedCosts($user_id, $year);

        foreach($monthly_consumption as $mc) {
            $total_monthly_consumption[((int)$mc->month) - 1] += $mc->total;
        }

        foreach($monthly_fixed_costs as $mfc) {
            $total_monthly_consumption[$mfc->month - 1] += $mfc->total;
        }

        return $total_monthly_consumption;
    }

    // 指定された年の月ごとの節約額を取得( 目標支出 - 消費額(固定費を含む) )
    public function getMonthlySavings($user_id, $year)
    {
        $monthly_savings = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 1月から12月のデータ

        $total_monthly_consumption = $this->getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額(固定費を含む)
        $monthly_target_spending = $this->getMonthlyTargetSpending($user_id, $year);     // 月ごとの目標支出

        foreach($monthly_target_spending as $mts) {
            $monthly_savings[$mts->month -1] += $mts->target_spending;
        }

        for($i = 0; $i < count($total_monthly_consumption); $i++) {
            $monthly_savings[$i] -= $total_monthly_consumption[$i];
        }

        return $monthly_savings;
    }

    // 指定された年の月ごとの残金を取得( 手取り収入 - 消費額(固定費を含む) )
    public function getMonthlyBalance($user_id, $year)
    {
        $monthly_balance = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 1月から12月のデータ

        $monthly_take_amount = $this->getMonthlyTakeAmount($user_id, $year);             // 月ごとの手取り収入を取得
        $total_monthly_consumption = $this->getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額を取得(固定費を含む)

        foreach($monthly_take_amount as $mta) {
            $monthly_balance[$mta->month -1] += $mta->take_amount;
        }

        for($i = 0; $i < count($total_monthly_consumption); $i++) {
            $monthly_balance[$i] -= $total_monthly_consumption[$i];
        }

        return $monthly_balance;
    }

    // 指定された年月の費目ごとの消費額を取得
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