<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Tasks\DemoTask;

class AccountController extends Controller
{
    //points to auth::
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tasks = DemoTask::orderBy('order')->select('id', 'title', 'order', 'status')->get();

        $tasksOpen = $tasks->filter(function ($task, $key) {
            return $task->status == 0;
        })->values();

        $tasksOnGoing = $tasks->filter(function ($task, $key) {
            return $task->status == 1;
        })->values();


        $tasksClosed = $tasks->filter(function ($task, $key) {
            return  $task->status == 2;
        })->values();

        return view('layouts.dashboard', compact('tasksOpen', 'tasksOnGoing', 'tasksClosed'));
    }

    public function index_data_presentation()
    {
        return view('layouts.data_presentation');
    }

    public function index_settings()
    {
        return view('layouts.settings');
    }
}
