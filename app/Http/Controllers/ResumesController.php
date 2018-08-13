<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resumes\Resume;

class ResumesController extends Controller
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
        $resumes = Resume::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $resumes;
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
        $resume = new Resume;
        $resume->id = $request->id;
        $resume->filename = $request->filename;
        $resume->candidate_id = $request->candidate_id;
        $resume->extension = $request->extension;
        $resume->save();
        return $resume;
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
        $resume= Resume::find($id);
      return $resume;
      
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
        $resume = Resume::find($id);
        $resume->filename = $request->filename;
        $resume->extension = $request->extension;
        $resume->update();
        return $resume;
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
        Resume::findOrFail($id)->delete();
        return 204;
    }
}
