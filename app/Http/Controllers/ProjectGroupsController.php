<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectGroups\ProjectGroup;

class ProjectGroupsController extends Controller
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
    public function store(Request $request)
    {
        //
        $projectGroup = new ProjectGroup;
        $projectGroup->id = $request->id;
        $projectGroup->group_name = $request->group_name;
        $projectGroup->admin_id = $request->admin_id;
        $projectGroup->user_id = $request->user_id;
        $projectGroup->save();
        return $projectGroup;
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
    public function update(Request $request, $id)
    {
        //
        $projectGroup = ProjectGroup::find($id);
        $projectGroup->group_name = $request->group_name;
        $projectGroup->admin_id = $request->admin_id;
        $projectGroup->user_id = $request->user_id;
        $projectGroup->update();
        return $projectGroup;
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
        ProjectGroup::findOrFail($id)->delete();
        return 204;
    }
}
