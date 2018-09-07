<?php

namespace App\Models\Tasks;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;
use App\Models\Users\User;
use App\Models\Clients\Company;
use App\Models\Tasks\TaskService;
use Illuminate\Support\Collection;

class TaskController extends Controller{
    public function __construct(TaskService $taskSvc){
        $this->svc = $taskSvc;
    }

    public function index(){
        $users = User::all();
        $companies = Company::all();
        return view('layouts.index_task',compact('users','companies'));
      }

    public function createTask(Request $request){
        $users = User::all();
        $companies = Company::all();
        $task = $this->svc->storeTask($request);
        if ( $task == null) {
            $message = "Failed to add event";
            $status = 0;
        }
        return view('layouts.index_task', compact('status', 'message','users','companies'));
    }

    public function createReminder(Request $request){
        $reminder = $this->svc->storeReminder($request);
        return $reminder;
    }


    
    // public function createTaskList(Request $request){
    //     $tasklist = $this->svc->storeTaskList($request);
    //     return $tasklist;
    // }

    public function showToDoList($id){
        
        $task = Task::whereUserId($id)->whereType(true)->orderBy('date_reminder','asc')->get();
        if(sizeof($task) > 0){
            $assigned = Task::whereAssignedId($id)->whereType(true)->orderBy('date_reminder','asc')->get();
            if(sizeof($assigned) > 0){
                foreach ($task as &$a1) {
                    array_push($total,$a1);
                }
                foreach ($assigned as &$a2) {
                    array_push($total,$a2);
                }
              return $total;
            }
        }
    }

    public function showTaskList($company_id){
        $taskList = Task::whereUserId(Auth::user()->id)->whereCompanyId($company_id)->orderBy('date_reminder','asc')->get();
        if(sizeof($taskList)>0){
            return $taskList;
        }
    }

    public function showEvent(){
        $event = Task::whereUserId(Auth::user()->idn_to_utf8)->whereType(false)->orderBy('date_reminder','asc')->get();
        if(sizeof($event) > 0){
            return $event;
        }
    }

    public function showAllTask(){
        $task = Task::whereType(true)->orderBy('date_reminder','asc')->get();
        error_log(print_r( sizeof($task),true));
        return $task;
    }

    public function closeTask($id){
        $task = Task::find('id',$id);
        $task->status = 3;
        $task->save();
        return $task;
      }

    public function updateToDoList($id){
        return $this->svc->updateTask($id, request()->all());
    }

    public function deleteToDoList($id){
        return $this->svc->destroyTask($id);
    }
}