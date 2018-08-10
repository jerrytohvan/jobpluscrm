<?php

namespace App\Models\Likes;

use Illuminate\Http\Request;
use App\Models\Likes\Like;

class LikeService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeLike($array)
  {
      return Like::Create([
        'user_id' => $array['user_id'],
        'post_id' => $array['post_id'],
        'comment_id' => $array['comment_id']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateLike(Like $like, $array)
  {
      $like->user_id = request()->input('user_id');
      $like->post_id = request()->input('post_id');
      $like->comment_id = request()->input('comment_id');
      $like->save();
      return $like;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyLike(Like $like)
  {
      $like->delete();
      return 204;
  }

}
