<?php

namespace App\Models\Tasks;

use App\Models\Tasks\Task;
use App\Models\Users\User;
use Auth;

class TaskService
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array $array
     * @return \Illuminate\Http\Response
     */
    //default task/event for todolist
    public function storeTask($array)
    {
        return Task::Create([
            'title' => $array['title'],
            'description' => $array['description'],
            'date_reminder' => $array['date_reminder'],
            'user_id' => $array['user_id'],
            'company_id' => $array['company_id'],
            'status' => $array['status'],
            //'user_id' => Auth::user()->id,
            'assigned_id' => $array['assigned_id'],
            //'assigned_to_id' => User::where('email',$array['assigned_to_id'])->first() == "" ? null :User::where('email',$array['assigned_to_id'])->first()->id,
            'type' => $array['type'],
        ]);
    }

    // create a reminder
    public function storeReminder($array)
    {
        return Task::Create([
            'title' => $array['title'],
            'description' => $array['description'],
            'date_reminder' => $array['date_reminder'],
            'user_id' => $array['user_id'],
            'company_id' => $array['company_id'],
            //'user_id' => Auth::user()->id,
            //'assigned_to_id' => $array['assigned_to_id'],
            //'assigned_to_id' => User::where('email',$array['assigned_to_id'])->first() == "" ? null :User::where('email',$array['assigned_to_id'])->first()->id,
            'type' => $array['type'],
        ]);
    }

    //create a tasklist for company page
    // public function storeTaskList($array)
    // {

    //   return Task::Create([
    //     'title' => $array['title'],
    //     'description' => $array['title'],
    //     'status' => $array['status'],
    //     'type' => $array['type'],
    //     'assigned_id' => $array['assigned_id'],
    //     'company_id' => $array['company_id']
    //   ]);
    // }

    //retrieve all task for todolist
    // public function getToDoList(){
    //  return Task::whereUserId(21)->whereType(true)->get() == "" ? null:Task::whereAssignedToId(Auth::user()->id)->whereType(true)->get()->sort('date_reminder','asc');
    // }

    //retrieve all event for calendarview
    // public function getEventList(){
    //   return Task::whereUserId(Auth::user()->id)->whereType(false)->get()->sort('date_reminder','asc') == "" ? null:Task::whereAssignedToId(Auth::user()->id)->whereType(false)->get()->sort('date_reminder','asc');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateTask($id, $array)
    {
        $task = Task::find($id);
        foreach ($array as $key => $value) {
            $task->$key = $value;
        }
        $task->save();
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyTask($id)
    {

        //if (Task::whereUserId(Auth::user()->id != 21)) {
            Task::findOrFail($id)->delete();
            return 204;
        //}

    }

}
