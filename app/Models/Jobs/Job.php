<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model
{
    use LogsActivity;
    protected $guarded = [];
    protected static $logAttributes = ["*"];
}
