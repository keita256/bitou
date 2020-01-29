<?php

namespace App\Services;

use MonelyzeDB;

class StatisticsLogic
{
    public static function existData($user_id, $year)
    {
        $existData = false;
        $is_empty = array_shift(MonelyzeDB::existMonthlyInputData($user_id, $year))->num;

        if(0 < $is_empty) {
            $existData = true;
        }

        return $existData;
    }
}

?>