<?php

namespace App\Models\Calendar;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskService;

class CalendarController extends Controller
{
    public function __construct(TaskService $taskSvc)
    {
        $this->svc =$taskSvc;
    }
    public function index()
    {
        $tasks = Task::all()->sortBy('created_at');
        return view('layouts.index_calendar',compact('tasks'));
    }

    public function add_new_event(Request $request)
    {
        $event = $this->svc->storeTask($request);
        if ($event == null) {
            $message = "Failed to add event";
            $status = 0;
        }
        print($event);
        return view('layouts.index_calendar', compact('status', 'message'));
    }

    public function update_event(Request $request)
    {
        $event = $this->svc->updateTask($id, $request);
    }

    public function removeTask($task_id)
  {
      $task = Task::where('id', $task_id)->first();
      $message = "Task deleted";
      $task->delete();
      return redirect()->route('layouts.index_calendar')->with(['message']);
  }
}
