<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    public function sender()
    {
        return $this->hasOne('App\Models\Users\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->hasOne('App\Models\Users\User', 'receiver_id');
    }

    public function broadcast()
    {
        return $this->belongsToMany('App\Models\Users\User');
    }

    public function projectGroups()
    {
        return $this->belongsTo('App\Models\ProjectGroups\ProjectGroup');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\Attachements\Attachment');
    }
}
