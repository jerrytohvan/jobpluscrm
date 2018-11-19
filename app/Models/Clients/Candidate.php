<?php

namespace App\Models\Clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Candidate extends Model
{
    use LogsActivity;

    protected $guarded = [];

    protected static $logAttributes = ["*"];


    public function employees()
    {
        return $this->hasMany('App\Models\Employees\Employee');
    }

    public function company()
    {
        return $this->belongsToMany('App\Models\Clients\Company');
    }

    public function files()
    {
        return $this->morphMany('App\Models\Attachments\Attachment', 'attachable');
    }
}
