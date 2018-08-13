<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Interests\Interest;
use App\Models\Interests\InterestService;

class InterestsController extends Controller
{
    //
    public function __construct(InterestService $interestSvc)
    {
        $this->svc = $interestSvc;
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
        $interests = Interest::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $interests;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Interest $interest)
    {
        //
        return $this->svc->storeInterest(request()->all());
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
        $interest = Interest::find($id);
        return $interest;

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
        return $this->svc->updateInterest($id, request()->all());
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
        return $this->svc->destroyInterest($id);
    }
}
