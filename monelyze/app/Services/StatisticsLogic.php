<?php

namespace App\Services;

use MonelyzeDB;

class StatisticsLogic
{
    public static function monthlyDataIsEmpty($user_id, $year)
    {
        $result = false;
        $data = MonelyzeDB::monthlyDataIsEmpty($user_id, $year);
        $is_empty = array_shift($data)->num;

        if(0 < $is_empty) {
            $result = true;
        }

        return $result;
    }
}

?>