<?php

namespace App\Models\Attachments;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
  public function message()
  {
      return $this->belongsTo('App\Models\Messages\Message');
  }

  public function sender()
  {
      return $this->belongsTo('App\Models\Users\User');
  }

  public function receiver()
  {
      return $this->belongsTo('App\Models\Users\User');
  }

  public function projectGroup()
  {
      return $this->belongsTo('App\Models\ProjectGroups\ProjectGroup');
  }

  public function event()
  {
      return $this->belongsTo('App\Models\Events\Event');
  }

  public function resume()
  {
      return $this->belongsTo('App\Models\Resumes\Resume');
  }
  public function post()
  {
      return $this->belongsTo('App\Models\Posts\Post');
  }
}
