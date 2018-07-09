<?php

namespace App\Models\Resumes;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
  public function user()
  {
      return $this->belongsTo('App\Models\Users\User');
  }

  public function attachment()
  {
      return $this->hasOne('App\Models\Attachments\Attachment');
  }
}
