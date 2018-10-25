<?php

namespace App\Models\SocialWall;

use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\SocialWall\SocialWallService;
use App\Models\Comments\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Likes\Like;

class SocialWallController extends Controller
{
    public function __construct(SocialWallService $socialWallSvc)
    {
        $this->socialWallSvc = $socialWallSvc;
    }

    public function index()
    {
        //retrieve posts
        $posts = Post::orderBy('created_at', 'desc')->whereCompanyId(null)->get();
        $message = "";
        $status = "";
        return view('layouts.social_wall', ['posts' => $posts, 'message' => $message, 'status' => $status]);
    }

    public function addPost(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
          'body' => 'required|max:1000'
      ]);
        $post = $this->socialWallSvc->addPost($user, $request);
        $message = $post != null ? 'Post successfully created!': 'There was an error';
        $status = $post != null ? 1 : 0;
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function removePost(Request $request)
    {
        $requestArray = request()->all();
        $post_id = $requestArray['post_id'];
        $post = Post::find($post_id);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $comment = $post->comment()->delete();
        $post->delete();
        $status = 1;
        return redirect()->route('social.wall')->with(['message' => 'Successfully deleted!', 'status' => $status]);
    }

    public function editPost(Request $request)
    {
        $this->validate($request, [
          'content' => 'required'
      ]);
        $post = Post::find($request['id']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->content = $request['content'];
        $post->update();
        return response()->json(['updated_content' => $post->content], 200);
    }
    
    public function postLikePost(Request $request)
    { 
       
        $post_id = $request['post_id'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
          return redirect()->back();
       }

        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return redirect()->back();
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
        return redirect()->back();
    }
}
