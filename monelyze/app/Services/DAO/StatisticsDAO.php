<?php

namespace App\Services\DAO;

use DB;

class StatisticsDAO
{
    // 指定された年の月ごとの消費額を取得(固定費を含まない)
    public function getMonthlyConsumption($user_id, $year)
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
    public function getMonthlyFixedCosts($user_id, $year)
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
    public function getMonthlyTargetSpending($user_id, $year)
    {
        $monthly_target_spending = DB::select(
            'select month, target_spending as total from monthly_inputs where user_id = :user_id and year = :year',
            [
                'user_id' => $user_id,
                'year' => $year
            ]
        );

        return $monthly_target_spending;
    }

    // 指定された年の月ごとの手取り収入を取得
    public function getMonthlyTakeAmount($user_id, $year)
    {
        $monthly_take_amount = DB::select(
            'select month, take_amount as total from monthly_inputs where user_id = :user_id and year = :year',
            [
                'user_id' => $user_id,
                'year' => $year
            ]
        );

        return $monthly_take_amount;
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