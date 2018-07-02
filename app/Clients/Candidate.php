<?php

namespace App\Clients;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
  public function employees()
  {
      return $this->hasMany('App\Employees\Employee');
  }
  public function events()
  {
      return $this->belongsToMany('App\Events\Event');
  }

}
