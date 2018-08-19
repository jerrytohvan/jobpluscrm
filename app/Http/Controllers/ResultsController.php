<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Results\Result;

class ResultsController extends Controller
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
        $results = Result::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $results;
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
        $result = new Result;
        $result->id = $request->id;
        $result->interest_id = $request->interest_id;
        $result->field_id = $request->field_id;
        $result->candidate_id = $request->candidate_id;
        $result->user_id = $request->user_id;
        $result->project_group_id = $request->project_group_id;
        $result->save();
        return $result;
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
        $result = Result::find($id);
        return $result;

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
        $result = Result::find($id);
        $result->interest_id = $request->interest_id;
        $result->field_id = $request->field_id;
        $result->candidate_id = $request->candidate_id;
        $result->user_id = $request->user_id;
        $result->project_group_id = $request->project_group_id;
        $result->update();
        return $result;
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
        Result::findOrFail($id)->delete();
        return 204;
    }
}
