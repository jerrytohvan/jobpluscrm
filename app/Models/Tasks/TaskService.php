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
        $status = Auth::user()->admin;
        if (!$status) {
            return Task::Create([
                'title' => $array['title'],
                'description' => $array['description'],
                'date_reminder' => $array['date_reminder'],
                'company_id' =>  $array['company_id'],
                'status' => 1,
                'user_id' => Auth::user()->id,
                'type' => 1
            ]);
        } elseif ($status) {
            if ((int)$array['assigned_id'] == 0) {
                return Task::Create([
                    'title' => $array['title'],
                    'description' => $array['description'],
                    'date_reminder' => $array['date_reminder'],
                    'company_id' =>  $array['company_id'],
                    'assigned_id' =>  0,
                    'status' => 0,
                    'user_id' => Auth::user()->id,
                    'type' => 1
                ]);
            } else {
                return Task::Create([
                    'title' => $array['title'],
                    'description' => $array['description'],
                    'date_reminder' => $array['date_reminder'],
                    'company_id' => $array['company_id'],
                    'status' => 1,
                    'user_id' => Auth::user()->id,
                    'assigned_id' => (int)$array['assigned_id'],
                    'type' => 1
                ]);
            }
        }
    }

    // create a reminder
    public function storeReminder($array)
    {
        return Task::Create([
            'title' => $array['title'],
            'description' => $array['description'],
            'date_reminder' => $array['date_reminder'],
            'user_id' => Auth::user()->id,
            'company_id' => $array['company_id'],
            'type' => true,
        ]);
    }
    


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

    public function updateTasksStatus($id)
    {
        $task = Task::find($id);
        $task->status = request()->input('status');
        $task->save();

        return response('Updated Successfully.', 200);
    }

    public function updateTasksOrder()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $id = $task->id;
            foreach (request()->input('tasks') as $tasksNew) {
                if ($tasksNew['id'] == $id) {
                    $task->update(['order' => $tasksNew['order']]);
                }
            }
        }
        return response('Updated Successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyTask($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return response('Updated Successfully.', 200);
        }
    }

    public function insertCollab($tasks,$userIds){
            foreach($tasks as $task){
                    $task->update(['collaborator' =>$userIds]);
                    $task->save();
            }
    }
}
