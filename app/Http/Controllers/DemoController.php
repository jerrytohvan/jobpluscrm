<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tasks\DemoTask;

class DemoController extends Controller
{
    public function updateTasksStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|boolean',
        ]);

        $task = DemoTask::find($id);
        $task->status = $request->status;
        $task->save();

        return response('Updated Successfully.', 200);
    }

    public function updateTasksOrder(Request $request)
    {
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);

        $tasks = DemoTask::all();

        foreach ($tasks as $task) {
            $id = $task->id;
            foreach ($request->tasks as $tasksNew) {
                if ($tasksNew['id'] == $id) {
                    $task->update(['order' => $tasksNew['order']]);
                }
            }
        }

        return response('Updated Successfully.', 200);
    }
}
