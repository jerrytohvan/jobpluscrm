<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public function users()
  {
      return $this->belongsToMany('App\Models\Users\User');
  }

  public function candidates()
  {
      return $this->hasMany('App\Models\Clients\Candidate');
  }

  public function customers()
  {
      return $this->hasMany('App\Models\Clients\Customer');
  }

  public function employees()
  {
      return $this->belongToMany('App\Models\Employees\Employee');
  }

}
