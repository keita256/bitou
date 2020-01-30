<?php

namespace App\Services;

/* --------------------------------------------Logic-----------------------------------------------
* 
* monthlyDataToArray($data_obj)...データオブジェクトをサイズが１２の配列に変換する
* addArrayElement($array1, $array2)...第一引数の配列に第二引数で渡された配列を要素ごとに加算する
* subtractArrayElement($array1, $array2)...第一引数の配列に第二引数で渡された配列を要素ごとに減算する
* 
*--------------------------------------------------------------------------------------------------*/
class MonthlyDataLogic
{
    public static function monthlyDataToArray($data_obj)
    {
        $monthly_array = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 1月から12月

        foreach($data_obj as $data) {
            $monthly_array[(int)$data->month - 1] = $data->total;
        }

        return $monthly_array;
    }

    public static function addArrayElement($array_1, $array_2)
    {
        for($i = 0; $i < count($array_1); $i++) {
            $array_1[$i] += $array_2[$i];
        }

        return $array_1;
    }

    public static function subtractArrayElement($array_1, $array_2)
    {
        for($i = 0; $i < count($array_1); $i++) {
            $array_1[$i] -= $array_2[$i];
        }

        return $array_1;
    }

    public static function monthlyInputDataFormatter($monthly_input_data)
    {
        
    }
}
?>