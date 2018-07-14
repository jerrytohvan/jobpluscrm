<?php

namespace App\Models\Interests;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
  public function candidates()
  {
     return $this->belongsToMany('App\Models\Clients\Candidate');
  }

  public function fields()
  {
      return $this->hasMany('App\Models\Fields\Field');
  }

}
