<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\CandidateService;
use App\Models\Clients\Candidate;

class CandidatesController extends Controller
{
    //
    public function __construct(CandidateService $candidateSvc)
    {
        $this->svc = $candidateSvc;
        // $this->middleware('auth');
    }
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
    public function store(Candidate $candidate)
    {
        //
        return $this->svc->storeCandidate(request()->all());
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
    public function update($id)
    {
        //
        return $this->svc->updateCandidate($id, request()->all());
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
        return $this->svc->destroyCandidate($id);
    }
}
