<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Likes\Like;

class LikesController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $likes = Like::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $likes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $like = new Like;
        $like->id = $request->id;
        $like->user_id = $request->user_id;
        $like->post_id = $request->post_id;
        $like->comment_id = $request->comment_id;
        $like->save();
        return $like;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $like = Like::find($id);
        return $like;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $like = Like::find($id);
        $like->user_id = $request->user_id;
        $like->post_id = $request->post_id;
        $like->comment_id = $request->comment_id;
        $like->update();
        return $like;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Like::findOrFail($id)->delete();
        return 204;
    }
}
