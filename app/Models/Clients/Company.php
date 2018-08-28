<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logAttributes = ["*"];


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
