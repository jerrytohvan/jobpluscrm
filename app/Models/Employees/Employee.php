<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logAttributes = ["*"];

    public function candidate()
    {
        return $this->belongsTo('App\Models\Clients\Candidate');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Clients\Company');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Tasks\Task');
    }
}
