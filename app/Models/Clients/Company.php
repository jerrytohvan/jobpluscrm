<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
<<<<<<< HEAD
  protected $guarded = [];
=======
  protected $guarded =  [];
>>>>>>> 221d2b60... api cleaned up and edited candidates model

  public function employees()
  {
      return $this->hasMany('App\Models\Employees\Employee');
  }
  public function events()
  {
      return $this->belongsToMany('App\Models\Events\Event');
  }
}
