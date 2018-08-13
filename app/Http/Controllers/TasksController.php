<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;

class TasksController extends Controller
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
        $tasks = Task::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $tasks;
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
        $task = new Task;
        $task->id = $request->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->date_reminder = $request->date_reminder;
        $task->reminder_type = $request->reminder_type;
        $task->date_completed = $request->date_completed;
        $task->company_id = $request->company_id;
        $task->employee_id = $request->employee_id;
        $task->assigned_to_id = $request->assigned_to_id;
        $task->save();
        return $task;
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
        $task= task::find($id);
      return $task;
      
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
        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->date_reminder = $request->date_reminder;
        $task->reminder_type = $request->reminder_type;
        $task->date_completed = $request->date_completed;
        $task->company_id = $request->company_id;
        $task->employee_id = $request->employee_id;
        $task->assigned_to_id = $request->assigned_to_id;
        $task->update();
        return $task;
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
        Task::findOrFail($id)->delete();
        return 204;
    }
}
