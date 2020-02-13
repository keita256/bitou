<?php

namespace App\Services\DAO;

use DB;
use App\User;

class UserDAO
{
    /*
    |--------------------------------------------
    | get method
    |--------------------------------------------
    */

    public function getUserName($user_id)
    {
        $user = User::where('id', $user_id)->get()->first();
        $user_name = $user->name;

        return $user_name;
    }

    public function getUserMail($user_id)
    {
        $user = User::where('id', $user_id)->get()->first();
        $mail = $user->email;

        return $mail;
    }

    /*
    |--------------------------------------------
    | insert method
    |--------------------------------------------
    */

    /*
    |--------------------------------------------
    | update method
    |--------------------------------------------
    */

    public function updateUserName($user_id, $new_name)
    {
        $user = User::find($user_id);

        $user->name = $new_name;

        return $user->save();
    }

    public function updateUserMail($user_id, $new_email)
    {
        $user = User::find($user_id);

        $user->email = $new_email;

        return $user->save();
    }

    /*
    |--------------------------------------------
    | delete method
    |--------------------------------------------
    */

    /*
    |--------------------------------------------
    | other method
    |--------------------------------------------
    */

    public function isEmptyEmail($email)
    {
        $num = DB::select(
            'select count(*) as num from users where email = :email',
             [
                'email' => $email
             ]
        );

        $num = array_shift($num)->num;

        return $num;
    }
}

?>