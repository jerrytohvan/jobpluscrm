<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements Authenticatable
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
      return $this->belongsToMany('App\ProjectGroups\ProjectGroup');
  }

  public function events()
  {
      return $this->hasMany('App\Events\Event');
  }

}
