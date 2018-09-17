<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks\DemoTask;

class DemoController extends Controller
{
    public function updateTasksStatus($id)
    {
        $task = DemoTask::find($id);
        $task->status = request()->input('status');
        $task->save();

        return response('Updated Successfully.', 200);
    }

    public function updateTasksOrder()
    {
        $tasks = DemoTask::all();

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
}
