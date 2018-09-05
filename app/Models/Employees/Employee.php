<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  protected $guarded = [];
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

  public function company()
  {
      return $this->belongsTo('App\Models\Clients\Company','id');
  }

  public function tasks()
  {
      return $this->hasMany('App\Models\Tasks\Task');
  }

}
