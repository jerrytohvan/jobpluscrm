<?php

namespace App\Models\ProjectGroups;
use Illuminate\Http\Request;
use App\Models\ProjectGroups\ProjectGroup;

class ProjectGroupService
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array $array
     * @return \Illuminate\Http\Response
     */
    public function storeProjectGroup($array)
    {
        return ProjectGroup::Create([
            'group_name' => $array['group_name'],
            'admin_id' => $array['admin_id'],
            'user_id' => $array['user_id'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateProjectGroup($id, $array)
    {
        $projectGroup = ProjectGroup::find($id);
        foreach ($array as $key => $value) {
            $projectGroup->$key = $value;
        }
        $projectGroup->save();
        return $projectGroup;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyProjectGroup($id)
    {
        ProjectGroup::findOrFail($id)->delete();
        return 204;
    }

}
