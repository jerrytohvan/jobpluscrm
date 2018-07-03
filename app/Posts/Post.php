<?php

namespace App\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function comments()
 {
     return $this->morphMany('App\Comments\Comment', 'commentable');
 }
}
