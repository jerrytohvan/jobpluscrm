<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity;

    protected $fillable = ['content'];
    protected static $logAttributes = ["*"];

    public function comment()
    {
        return $this->morphMany('App\Models\Comments\Comment', 'commentable');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Clients\Company');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes\Like');
    }
}
