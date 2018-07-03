<?php

namespace App\Users;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{

  //Using the contract and use Laravel's ready function (see config auth.php 'providers' to see which class is the default check)
  use \Illuminate\Auth\Authenticatable;

  /**
   * @return Relationship
   */
  public function messages()
  {
      return $this->hasMany('App\Messages\Message');
  }

  public function projectGroups()
  {
      return $this->belongsToMany('App\ProjectGroups\ProjectGroup');
  }

  public function events()
  {
      return $this->hasMany('App\Events\Event');
  }

}
