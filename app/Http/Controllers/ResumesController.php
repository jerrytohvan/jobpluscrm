<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resumes\Resume;
use App\Models\Resumes\ResumeService;

class ResumesController extends Controller
{
    //
    public function __construct(ResumeService $resumeSvc)
    {
        $this->svc = $resumeSvc;
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
    public function store(Resume $resume)
    {
        //
        return $this->svc->storeResume(request()->all());
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
    public function update($id)
    {
        //
        return $this->svc->updateResume($id, request()->all());
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
        return $this->svc->destroyResume($id);
    }
}
