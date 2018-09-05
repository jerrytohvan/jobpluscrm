<?php

namespace App\Models\Tasks;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskService;
use Illuminate\Support\Collection;

class TaskController extends Controller{
    public function __construct(TaskService $taskSvc){
        $this->svc = $taskSvc;
    }

    public function createTask(Request $request){
        $task = $this->svc->storeTask($request);
        return $task;
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
        $total = [];
        
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

    public function showTaskList($id,$cid){
        $taskList = Task::whereUserId($id)->whereCompanyId($cid)->orderBy('date_reminder','asc')->get();
        if(sizeof($taskList)>0){
            return $taskList;
        }
    }

    public function showEvent($id){
        $event = Task::whereUserId($id)->whereType(false)->orderBy('date_reminder','asc')->get();
        if(sizeof($event) > 0){
            return $event;
        }
    }

    public function updateToDoList($id){
        return $this->svc->updateTask($id, request()->all());
    }

    public function deleteToDoList($id){
        return $this->svc->destroyTask($id);
    }
}