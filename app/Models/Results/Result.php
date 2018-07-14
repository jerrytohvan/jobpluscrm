<?php

namespace App\Models\Results;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  public function candidates()
  {
     return $this->hasMany('App\Models\Clients\Candidate');
  }

  public function fields()
  {
      return $this->hasMany('App\Models\Fields\Field');
  }

  public function interests()
  {
      return $this->hasMany('App\Models\Interests\Interest');
  }

  public function users()
  {
      return $this->hasMany('App\Models\Users\User');
  }

  public function projectGroups()
  {
      return $this->hasMany('App\Models\ProjectGroups\ProjectGroup');
  }
}
