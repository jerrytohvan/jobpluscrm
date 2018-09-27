<?php

namespace App\Models\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskService;
use App\Models\Users\User;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(TaskService $taskSvc)
    {
        $this->svc = $taskSvc;
    }

    public function index()
    {
        $users = User::all();
        $companies = Company::all();
        $task = Task::all();
        //return $task;
        return view('layouts.index_task', compact('users', 'companies','task'));
    }

    public function createTask(Request $request)
    {
        $users = User::all();
        $companies = Company::all();
        $task = $this->svc->storeTask($request);
        if ($task == null) {
            $message = "Failed to add event";
            $status = 0;
        }
        return view('layouts.index_task', compact('status', 'message', 'users', 'companies'));
    }

    public function display(){
        $task = Task::all();
        $client = new Client();

        // $request = $client->get('http://localhost:8000/tasks', [
        //     GuzzleHttp\RequestOptions::JSON => ['foo' => 'bar'],
        // ]);

        $res = $client->request('GET', 'http://localhost:3000/mailData');
        error_log(print_r($res->getBody()->getContents(), true));
        //return $task;
    }

    public function createReminder(Request $request)
    {
        $reminder = $this->svc->storeReminder($request);
        return $reminder;
    }

    // public function createTaskList(Request $request){
    //     $tasklist = $this->svc->storeTaskList($request);
    //     return $tasklist;
    // }

    public function showToDoList()
    {
        $now = Carbon::now()->format('Y-m-d 00:00:00');
        $task = Task::whereUserId(Auth::user()->id)->whereType(true)->whereStatus(1)->where('date_reminder', '>', $now)->orderBy('date_reminder', 'asc')->get();
        $assigned = Task::whereAssignedId(Auth::user()->id)->whereType(true)->whereStatus(1)->where('date_reminder', '>', $now)->orderBy('date_reminder', 'asc')->get();

        // foreach ($task as &$a1) {
        //     array_push($total, $a1);
        // }
        // foreach ($assigned as &$a2) {
        //     array_push($total, $a2);
        // }

        // $creator = array($task);
        // $assignedTo = array($assigned);
        // array_push($creator, $assignedTo);
        //return $creator;

        //return('to view',compact('task','assigned'))

    }

    public function showTaskList($company_id)
    {
        $taskList = Task::whereUserId(Auth::user()->id)->whereCompanyId($company_id)->orderBy('date_reminder', 'asc')->get();
        if (sizeof($taskList) > 0) {
            return $taskList;
        }
    }

    public function showEvent()
    {
        $event = Task::whereUserId(Auth::user()->id)->whereType(false)->orderBy('date_reminder', 'asc')->get();
        if (sizeof($event) > 0) {
            return $event;
        }
    }

    public function showAllTask(User $user)
    {
        $now = Carbon::now()->format('Y-m-d 00:00:00');
        $user_id = $user->id;
        $condition = request()->get('date');
        //$createdTask = Task::whereUserId($user_id)->whereType(true)->where('date_reminder', '>', $now)->get();
        // $assignedTask = Task::whereAssignedId($user_id)->whereType(true)->where('date_reminder', '>', $now)->get();
        // $expiredTask = Task::whereAssignedId($user_id)->whereType(true)->where('date_reminder', '<', $now)->where('status', '<', 3)->orderBy('date_reminder', 'asc')->get();
        $expiredCreatedTask = Task::whereUserId($user->id)->whereType(true)->where('status', '<', 2)->where('date_reminder', '<', $now)->orderBy('date_reminder', 'asc')->get();
        $expiredAssignedTask = Task::whereAssignedId($user->id)->whereType(true)->where('status', '<', 2)->where('date_reminder', '<', $now)->orderBy('date_reminder', 'asc')->get();
        if (Auth::user()->id == 1) {
            if ($condition == 'monthly') {
                $monthly = Date((Carbon::now()->format('Y-m-d 00:00:00')), strtotime("+1 month"));
                $createdTask = Task::whereUserId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                $onGoingTask = Task::whereAssignedId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                $closedCreatedTask = Task::whereUserId($user_id)->whereStatus(2)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                $closedAssignedTask = Task::whereAssignedId($user_id)->whereStatus(2)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                //return view('ur view',compact('createdTask','onGoingTask','closedCreatedTask','closedAssignedTask','expiredCreatedTask','expiredAssignedTask'));
            } else if ($condition == 'yearly') {
                $yearly = Date((Carbon::now()->format('Y-m-d 00:00:00')), strtotime("+1 year"));
                $createdTask = Task::whereUserId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $yearly)->orderBy('date_reminder', 'asc')->get();
                $onGoingTask = Task::whereAssignedId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $yearly)->orderBy('date_reminder', 'asc')->get();
                $closedCreatedTask = Task::whereUserId($user_id)->whereStatus(2)->where('date_reminder', '<', $yearly)->orderBy('date_reminder', 'asc')->get();
                $closedAssignedTask = Task::whereAssignedId($user_id)->whereStatus(2)->where('date_reminder', '<', $yearly)->orderBy('date_reminder', 'asc')->get();
                //return view('ur view',compact('createdTask','onGoingTask','closedCreatedTask','closedAssignedTask','expiredCreatedTask','expiredAssignedTask'));
            } else {
                $default = Date((Carbon::now()->format('Y-m-d 00:00:00')), strtotime("+7 days"));
                $createdTask = Task::whereUserId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $deafult)->orderBy('date_reminder', 'asc')->get();
                $onGoingTask = Task::whereAssignedId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $default)->orderBy('date_reminder', 'asc')->get();
                $closedCreatedTask = Task::whereUserId($user_id)->whereStatus(2)->where('date_reminder', '<', $default)->orderBy('date_reminder', 'asc')->get();
                $closedAssignedTask = Task::whereAssignedId($user_id)->whereStatus(2)->where('date_reminder', '<', $default)->orderBy('date_reminder', 'asc')->get();
                //return view('ur view',compact('createdTask','onGoingTask','closedCreatedTask','closedAssignedTask','expiredCreatedTask','expiredAssignedTask'));
            }

        }



        //$qd = string($mnth) +" 00:00:00";
        //error_log(print_r( typeof($mnth),true));
        //return $qd;
        // $task = Task::where('date_reminder', '<',$now)->get();
        // return $task;
    }

    public function breakdownReport(){
        $now = Carbon::now();

    }

    public function closeTask($id)
    {
        $task = Task::find('id', $id);
        if (Auth::user()->id == 1 || $task->username == Auth::user()->id) {
            $task->status = 2;
            $task->save();
            return $task;
        }
    }

    public function updateToDoList($id)
    {
        return $this->svc->updateTask($id, request()->all());
    }

    public function deleteToDoList($id)
    {
        return $this->svc->destroyTask($id);
    }

}
