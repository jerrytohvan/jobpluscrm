<?php

namespace App\Employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  public function customer()
  {
      return $this->belongsTo('App\Clients\Customer');
  }

  public function candidate()
  {
      return $this->belongsTo('App\Clients\Candidate');
  }

  public function resume()
  {
      return $this->hasOne('App\Resumes\Resume');
  }

  public function events()
  {
      return $this->hasMany('App\Events\Event');
  }

}
