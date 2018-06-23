<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
  //Telling table name = protected $table = 'users2';

  //Using the contract and use Laravel's ready function (see config auth.php 'providers' to see which class is the default check)
  use \Illuminate\Auth\Authenticatable;


}
