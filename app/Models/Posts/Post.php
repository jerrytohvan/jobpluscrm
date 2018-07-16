<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['content'];

  public function comment()
 {

     return $this->morphMany('App\Models\Comments\Comment', 'commentable');
 }

   public function user()
   {
       return $this->belongsTo('App\Models\Users\User');
   }

   public function likes()
   {
       return $this->hasMany('App\Models\Likes\Like');
   }

}
