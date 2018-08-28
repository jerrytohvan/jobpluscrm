<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{

  //Using the contract and use Laravel's ready function (see config auth.php 'providers' to see which class is the default check)
    use \Illuminate\Auth\Authenticatable;
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $logAttributes = ["*"];

    /**
     * @return Relationship
     */
    public function messages()
    {
        return $this->hasMany('App\Messages\Message');
    }

    public function projectGroups()
    {
        return $this->belongsToMany('App\Models\ProjectGroups\ProjectGroup');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comments\Comment');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Events\Event');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes\Like');
    }
}
