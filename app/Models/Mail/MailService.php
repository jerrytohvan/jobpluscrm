<?php

namespace App\Models\Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailService
{
    /**
     * Checks user existed and creates a new user
     * @param  Array   $array
     * @return User $user
     * @author jerrytohvan
     */
    public function sendemail()
    {


    }

    public function updateUserProfile(User $user)
    {
        $array = request()->all();
        foreach ($array as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        return $user;
  }
}
