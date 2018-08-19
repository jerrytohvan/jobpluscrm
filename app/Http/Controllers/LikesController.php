<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Likes\Like;
use App\Models\Likes\LikeService;

class LikesController extends Controller
{
  public function __construct(LikeService $likeSvc)
  {
      $this->svc = $likeSvc;
      // $this->middleware('auth');
  }

    public function index()
    {
        // load the view and pass the employees
        return Like::orderBy('id', 'asc')->get();
    }


    public function show(Like $like)
    {
        return $like;
    }


    public function store()
    {
        return $this->svc->storeLike(request()->all());
    }


    public function update(Like $like)
    {

        return $this->svc->updateLike($like, request()->all());
    }

    public function destroy(Like $like)
    {
        return $this->svc->destroyLike($like);
    }
}
