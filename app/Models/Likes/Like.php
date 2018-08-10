<?php


namespace App\Models\Likes;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $guarded = [];
  public function user()
  {
      return $this->belongsTo('App\Models\Users\User');
  }

  public function post()
  {
      return $this->belongsTo('App\Models\Posts\Post');
  }
}
