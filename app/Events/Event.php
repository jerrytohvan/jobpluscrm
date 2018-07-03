<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public function users()
  {
      return $this->belongsToMany('App\Users\User');
  }

  public function candidates()
  {
      return $this->hasMany('App\Clients\Candidate');
  }

  public function customers()
  {
      return $this->hasMany('App\Clients\Customer');
  }

  public function employees()
  {
      return $this->belongToMany('App\Employees\Employee');
  }
}
