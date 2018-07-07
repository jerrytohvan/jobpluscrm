<?php

namespace App\Attachments;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
  public function message()
  {
      return $this->belongsTo('App\Messages\Message');
  }

  public function sender()
  {
      return $this->belongsTo('App\Users\User');
  }

  public function receiver()
  {
      return $this->belongsTo('App\Users\User');
  }

  public function projectGroup()
  {
      return $this->belongsTo('App\ProjectGroups\ProjectGroup');
  }

  public function event()
  {
      return $this->belongsTo('App\Events\Event');
  }

  public function resume()
  {
      return $this->belongsTo('App\Resumes\Resume');
  }
  public function post()
  {
      return $this->belongsTo('App\Posts\Post');
  }
}
