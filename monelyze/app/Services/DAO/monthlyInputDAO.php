<?php

namespace App\Services\DAO;

use DB;
use App\Monthly_input;

class MonthlyInputDAO
{
    /*
    |--------------------------------------------
    | get method
    |--------------------------------------------
    */

    public function getMonthlyInput($user_id, $year, $month)
    { 
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

    /*
    |--------------------------------------------
    | insert method
    |--------------------------------------------
    */

    public function insertMonthlyInput($user_id, $year, $month, $take_amount, $target_spending)
    {
        $new_monthly_input = new Monthly_input();
        $new_monthly_input->user_id = $user_id;
        $new_monthly_input->year = $year;
        $new_monthly_input->month = $month;
        $new_monthly_input->take_amount = $take_amount;
        $new_monthly_input->target_spending = $target_spending;

        return $new_monthly_input->save();
    }

    /*
    |--------------------------------------------
    | update method
    |--------------------------------------------
    */

    public function updateMonthlyInput($user_id, $year, $month, $take_amount, $target_spending)
    {
        return $monthly_input = Monthly_input::where('user_id', $user_id)->
                                        where('year', $year)->
                                        where('month', $month)->
                                        update(
                                            [
                                                'take_amount' => $take_amount,
                                                'target_spending' => $target_spending
                                            ]
                                        );
    }

    /*
    |--------------------------------------------
    | delete method
    |--------------------------------------------
    */

    /*
    |--------------------------------------------
    | isEmpty method
    |--------------------------------------------
    */

    // user_idとyearをもとにデータが存在するか取得
    public function isEmptyMonthlyData($user_id, $year)
    {
        $result = DB::select(
            'select count(*) as num from monthly_inputs where user_id = :user_id and year = :year',
            [
                'user_id' => $user_id,
                'year' => $year
            ]
        );

        return $result;
    }

    // 指定された年月の月初入力レコードが存在するか取得(middlewareで使用)
    public function isEmptyMonthlyInput($user_id, $year, $month)
    {
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
}

?>