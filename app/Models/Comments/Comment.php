<?php

namespace App\Models\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['commentable_type', 'commentable_id', 'content'];

  //post, event, project group
    public function commentable()
      {
         return $this->morphTo();
      }
      public function user()
        {
          return $this->belongsTo('App\Models\Users\User');
        }

}
