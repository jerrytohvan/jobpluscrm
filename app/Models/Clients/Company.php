<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany('App\Models\Employees\Employee');
    }
    public function candidates()
    {
        return $this->hasMany('App\Models\Clients\Candidate');
    }
    public function events()
    {
        return $this->belongsToMany('App\Models\Events\Event');
    }

    public function files()
    {
        return $this->morphMany('App\Models\Attachments\Attachment', 'attachable');
    }
}
