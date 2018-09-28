<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logAttributes = ["*"];

    public function users()
    {
        return $this->belongsToMany('App\Models\Users\User');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Models\Clients\Company');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employees\Employee');
    }
}
