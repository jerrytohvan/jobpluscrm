<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name','email','handphone','interest_id','type','field_id'];
  public function employees()
  {
      return $this->hasMany('App\Models\Employees\Employee');
  }
  public function events()
  {
      return $this->belongsToMany('App\Models\Events\Event');
  }

  public function interests()
  {
      return $this->hasMany('App\Models\Interests\Interest');
  }

  public function fields()
    {
      return $this->hasMany('App\Models\Fields\Field');
    }
}
