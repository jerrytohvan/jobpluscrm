<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectGroups\ProjectGroup;
use App\Models\ProjectGroups\ProjectGroupService;

class ProjectGroupsController extends Controller
{
    //
    public function __construct(ProjectGroupService $projectGroupSvc)
    {
        $this->svc = $projectGroupSvc;
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
        $projectGroups = ProjectGroup::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $projectGroups;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectGroup $projectGroup)
    {
        //
        return $this->svc->storeProjectGroup(request()->all());
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
        $projectGroup= ProjectGroup::find($id);
      return $projectGroup;
      
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
        return $this->svc->updateProjectGroup($id, request()->all());
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
        return $this->svc->destroyProjectGroup($id);
    }
}
