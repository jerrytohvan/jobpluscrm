<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User  extends Authenticatable
{

  //Using the contract and use Laravel's ready function (see config auth.php 'providers' to see which class is the default check)
  use \Illuminate\Auth\Authenticatable;
  use Notifiable;
	use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
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

  public function tasks()
  {
      return $this->hasMany('App\Models\Tasks\Task');
  }

  public function likes()
  {
      return $this->hasMany('App\Models\Likes\Like');
  }

}
