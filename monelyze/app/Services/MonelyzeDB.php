<?php

namespace App\Services;

use DB;
use App\Spend;
use App\User;
use App\Expense;
use App\Payment;
use App\Monthly_input;
use App\Services\MonthlyDataLogic;

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

    public function getPayments($user_id, $year, $month)
    {
        $payments = DB::select(
            'select content, amount from payments where user_id = :user_id and year = :year and month = :month',
            [
                'user_id' => $user_id,
                'year' =>$year,
                'month' => $month
            ]
        );

        return $payments;
    }

    public function getMonthlyInput($user_id, $year, $month)
    {
        $user_id = 1;
        $year = 2020;
        $month = 1;
        
        $monthly_input = DB::select(
            'select take_amount, target_spending from monthly_inputs where user_id = :user_id and year = :year and month = :month',
            [
                'user_id' => $user_id,
                'year' => $year,
                'month' => $month
            ]
        );

        return $monthly_input;
    }

    public function insertSpends($user_id, $date, $spends)
    {
        $expense = $spends->expesne_id;
        $content = $spends->content;
        $amount = $spends->amount;

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

            $new_spend->save();
        }
    }

    public function insertPayments($user_id, $date, $payments)
    {
        $year = (int)substr($date, 0, 4);
        $month = (int)substr($date, 5);  
        $content = $payments->content;
        $amount = $payments->amount;
        
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
            $new_payment = new Spend();
            $new_payment->user_id = $user_id;
            $new_payment->year = $year;
            $new_payment->month = $month;
            $new_payment->number = $num;
            $new_payment->content = $content[$i];
            $new_payment->amount = $amount[$i];

            $new_payment->save();
        }
    }

    public function insertMonthlyInput($user_id, $date, $monthly_input)
    {
        $year = (int)substr($date, 0, 4);
        $month = (int)substr($date, 5);

        $new_monthly_input = new Monthly_input();
        $new_monthly_input->user_id = $user_id;
        $new_monthly_input->year = $year;
        $new_monthly_input->month = $month;
        $new_monthly_input->taket_amount = $monthly_input->take_amount;
        $new_monthly_input->target_spending = $monthly_input->target_spending;

        $new_monthly_input->save();
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

    // 指定された年月の月初入力レコードが存在するか取得(middlewareで使用)
    public function getEmptyMonthlyInput($user_id, $year, $month)
    {
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

    // user_idをもとにデータ入力のある年を取得
    public function get()
    {

    }

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

    // 指定された年の月ごとの消費額(固定費を含む)を取得し配列で返す
    public function getTotalMonthlyConsumption($user_id, $year)
    {
        // 初期化
        $total_monthly_consumption = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];    // 1月から12月のデータ
        $monthly_consumption = $this->getMonthlyConsumption($user_id, $year); // 月ごとの消費額
        $monthly_fixed_costs = $this->getMonthlyFixedCosts($user_id, $year);  // 月ごとの固定費

        // オブジェクトを配列に変換
        $monthly_consumption = MonthlyDataLogic::monthlyDataToArray($monthly_consumption);
        $monthly_fixed_costs = MonthlyDataLogic::monthlyDataToArray($monthly_fixed_costs);

        // 配列の要素ごとに加算
        $total_monthly_consumption = MonthlyDataLogic::addArrayElement($total_monthly_consumption, $monthly_consumption);
        $total_monthly_consumption = MonthlyDataLogic::addArrayElement($total_monthly_consumption, $monthly_fixed_costs);
        
        return $total_monthly_consumption;
    }

    // 指定された年の月ごとの節約額を取得( 目標支出 - 消費額(固定費を含む) )
    public function getMonthlySavings($user_id, $year)
    {
        // 初期化
        $monthly_savings = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];                         // 1月から12月のデータ
        $total_monthly_consumption = $this->getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額(固定費を含む)
        $monthly_target_spending = $this->getMonthlyTargetSpending($user_id, $year);     // 月ごとの目標支出

        // オブジェクトを配列に変換
        $monthly_target_spending = MonthlyDataLogic::monthlyDataToArray($monthly_target_spending);

        // 配列の要素ごとに加算、減算
        $monthly_savings = MonthlyDataLogic::addArrayElement($monthly_savings, $monthly_target_spending);
        $monthly_savings = MonthlyDataLogic::subtractArrayElement($monthly_savings, $total_monthly_consumption);

        return $monthly_savings;
    }

    // 指定された年の月ごとの残金を取得( 手取り収入 - 消費額(固定費を含む) )
    public function getMonthlyBalance($user_id, $year)
    {
        // 初期化
        $monthly_balance = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 1月から12月のデータ
        $monthly_take_amount = $this->getMonthlyTakeAmount($user_id, $year);             // 月ごとの手取り収入を取得
        $total_monthly_consumption = $this->getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額を取得(固定費を含む)

        // オブジェクトを配列に変換
        $monthly_take_amount = MonthlyDataLogic::monthlyDataToArray($monthly_take_amount);

        // 配列の要素ごとに加算、減算
        $monthly_balance = MonthlyDataLogic::addArrayElement($monthly_balance, $monthly_take_amount);
        $monthly_balance = MonthlyDataLogic::subtractArrayElement($monthly_balance, $total_monthly_consumption);

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