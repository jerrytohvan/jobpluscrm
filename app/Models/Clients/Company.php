<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
<<<<<<< HEAD
  protected $guarded = [];
=======
  protected $guarded =  [];
>>>>>>> 221d2b605ae84d5a998db6f865af23f42d0aaecb

  public function employees()
  {
      return $this->hasMany('App\Models\Employees\Employee');
  }
  public function events()
  {
      return $this->belongsToMany('App\Models\Events\Event');
  }
}
