<?php

namespace App\Models\Comments;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logAttributes = ["*"];

    //post, event, project group
    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Clients\Company');
    }
    public function post()
    {
        return $this->belongsTo('App\Models\Posts\Post', 'id');
    }
}
