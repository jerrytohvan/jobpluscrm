<?php

namespace App\ProjectGroups;

use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
  public function users()
  {
      return $this->hasMany('App\Users\User');
  }

  public function messages()
  {
      return $this->hasMany('App\Messages\Message');
  }
}
