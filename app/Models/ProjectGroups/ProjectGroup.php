<?php

namespace App\Models\ProjectGroups;

use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
    protected $casts = [
        'user_id' => 'array'
    ];
  public function users()
  {
      return $this->hasMany('App\Models\Users\User');
  }

  public function messages()
  {
      return $this->hasMany('App\Models\Messages\Message');
  }
}
