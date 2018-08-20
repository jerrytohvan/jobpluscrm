<?php

namespace App\Models\Clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
require_once '..\vendor\autoload.php';

class Candidate extends Model
{
    protected $guarded = [];
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
