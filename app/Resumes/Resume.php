<?php

namespace App\Resumes;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
  public function user()
  {
      return $this->belongsTo('App\Users\User');
  }

  public function attachment()
  {
      return $this->hasOne('App\Attachments\Attachment');
  }
}
