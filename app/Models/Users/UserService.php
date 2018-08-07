<?php

namespace App\Models\Users;

use App\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserService
{
  /**
   * Checks user existed and creates a new user
   * @param  Array   $array
   * @return User $user
   * @author jerrytohvan
   */
  public function createUser(Array $array){
    return User::create(['name' => $array->name,
        'email' => $array->email,
      'password' => bcrypt($array->password),
      'admin' => $array->admin
      ]);
  }
}
