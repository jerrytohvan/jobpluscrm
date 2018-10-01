<?php


namespace App\Models\Likes;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Like extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logAttributes = ["*"];
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }
}
