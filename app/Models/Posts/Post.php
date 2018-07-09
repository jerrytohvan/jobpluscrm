<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function comments()
 {
     return $this->morphMany('App\Models\Comments\Comment', 'commentable');
 }
}
