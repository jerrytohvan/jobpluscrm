<?php

namespace App\Models\Attachments;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Attachment extends Model
{
    use LogsActivity;

    protected $guarded = [];

    protected static $logAttributes = ["*"];


    public function sender()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function resume()
    {
        return $this->belongsTo('App\Models\Resumes\Resume');
    }
    public function post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }
    public function attachable()
    {
        return $this->morphTo();
    }
}
