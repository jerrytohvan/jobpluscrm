<?php

namespace App\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  //post, event, project group
    public function commentable()
      {
         return $this->morphTo();
      }

}
