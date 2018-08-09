<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\Candidate;

class CandidatesController extends Controller
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
        $candidates = Candidate::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $candidates;
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
        $candidate = new Candidate;
        $candidate->id = $request->id;
        $candidate->name = $request->name;
        $candidate->email = $request->email;
        $candidate->handphone = $request->handphone;
        $candidate->interest_id = $request->interest_id;
        $candidate->type = $request->type;
        $candidate->field_id = $request->field_id;
        $candidate->save();
        return $candidate;
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
        $candidate = Candidate::find($id);
        return $candidate;

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
        $candidate = Candidate::find($id);
        $candidate->id = $request->id;
        $candidate->name = $request->name;
        $candidate->email = $request->email;
        $candidate->handphone = $request->handphone;
        $candidate->interest_id = $request->interest_id;
        $candidate->type = $request->type;
        $candidate->field_id = $request->field_id;
        $candidate->update();
        return $candidate;
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
        Candidate::findOrFail($id)->delete();
        return 204;
    }
}
