<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  public function customer()
  {
      return $this->belongsTo('App\Models\Clients\Customer');
  }

  public function candidate()
  {
      return $this->belongsTo('App\Models\Clients\Candidate');
  }

  public function resume()
  {
      return $this->hasOne('App\Models\Resumes\Resume');
  }

  public function events()
  {
      return $this->hasMany('App\Models\Events\Event');
  }

}
