<?php

namespace App\Messages;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  public function sender()
  {
      return $this->hasOne('App\Users\User', 'sender_id');
  }

  public function receiver()
  {
      return $this->hasOne('App\Users\User', 'receiver_id');
  }

  public function broadcast()
  {
      return $this->belongsToMany('App\Users\User');
  }

  public function projectGroups()
  {
      return $this->belongsTo('App\ProjectGroups\ProjectGroup');
  }

  public function attachments()
  {
      return $this->hasMany('App\Attachements\Attachment');
  }
}
