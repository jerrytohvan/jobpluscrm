<?php

namespace App\Models\SocialWall;

use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Comments\Comment;

use Illuminate\Http\Request;


class SocialWallService
{
  //index, show, create, delete, edit

  /**
   * Checks user existed and creates a new user
   * @param  Array   $array
   * @return Company $company
   * @author jerrytohvan
   */
   public function addPost($user, $array)
   {
     $post = new Post();
     $post->content =$array['body'];
     $post->user_id = $user->id;
     if ($user->comments()->save($post)) {
         $comment = new Comment();
         $post->comment()->save($comment);

     }
     return $post;
     }
}
