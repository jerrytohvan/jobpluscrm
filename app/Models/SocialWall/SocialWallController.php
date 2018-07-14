<?php

namespace App\Models\SocialWall;

use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Comments\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SocialWallController extends Controller
{
  public function index(){
    //retrieve posts
    $posts = Post::orderBy('created_at', 'desc')->get();
    return view('layouts.social_wall', ['posts' => $posts]);
  }

  public function addPost(Request $request)
  {
    // dd($request);
      $user = Auth::user();
      $this->validate($request, [
          'body' => 'required|max:1000'
      ]);
      $post = new Post();
      $post->content = $request['body'];
      $post->user_id = $user->id;
      $message = 'There was an error';
      if ($user->comments()->save($post)) {
          $comment = new Comment();
          $post->comment()->save($comment);
          $message = 'Post successfully created!';
      }
      return redirect()->route('social.wall')->with(['message' => $message]);
  }

  public function removePost($post_id)
  {
      $post = Post::where('id', $post_id)->first();
      if (Auth::user() != $post->user) {
          return redirect()->back();
      }
      $post->delete();
      return redirect()->route('layouts.social_wall')->with(['message' => 'Successfully deleted!']);
  }

  public function editPost(Request $request)
  {
      $this->validate($request, [
          'body' => 'required'
      ]);
      $post = Post::find($request['postId']);
      if (Auth::user() != $post->user) {
          return redirect()->back();
      }
      $post->body = $request['body'];
      $post->update();
      return response()->json(['new_body' => $post->body], 200);
  }

  public function postLikePost(Request $request)
  {
      $post_id = $request['postId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $post = Post::find($post_id);
      if (!$post) {
          return null;
      }
      $user = Auth::user();
      $like = $user->likes()->where('post_id', $post_id)->first();
      if ($like) {
          $already_like = $like->like;
          $update = true;
          if ($already_like == $is_like) {
              $like->delete();
              return null;
          }
      } else {
          $like = new Like();
      }
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->post_id = $post->id;
      if ($update) {
          $like->update();
      } else {
          $like->save();
      }
      return null;
  }
}
