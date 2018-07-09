<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  public function employees()
  {
      return $this->hasMany('App\Models\Employees\Employee');
  }
  public function events()
  {
      return $this->belongsToMany('App\Models\Events\Event');
  }

}
