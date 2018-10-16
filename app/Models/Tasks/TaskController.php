<?php

namespace App\Models\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskService;
use App\Models\Users\User;
use App\Models\Users\UserCompany;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Chats\TelegramService;

class TaskController extends Controller
{
    public function __construct(TaskService $taskSvc, TelegramService $teleSvc)
    {
        $this->svc = $taskSvc;
        $this->tSvc = $teleSvc;
    }

    public function index()
    {
        $message = "";
        $status = "";
        $users = User::all();
        $companies = Company::all();
        $task = Task::all();
        //return $task;
        return view('layouts.index_task', compact('users', 'companies', 'task', 'message', 'status'));
    }

    public function createTask()
    {
        $users = User::all();
        $companies = Company::all();
        $task = $this->svc->storeTask(request()->all());
        if ($task == null) {
            $message = "Failed to add task";
            $status = 0;
        }
        $message = "Task successfully created!";
        $status = 1;
        return view('layouts.index_task', compact('status', 'message', 'users', 'companies'));
    }

    public function display()
    {
        // $task = Task::all();
        $client = new Client();
        

        try {
            $res = $client->request('GET', 'http://localhost:3000/mailData');
            //error_log(print_r($res, true));
            $content = $res->getBody()->getContents();
            error_log(print_r($content, true));
            $var = json_decode($content,true);
            //$teleMessage = $this->tSvc->send($var);
            //error_log(print_r($var, true));
            // if (sizeof($var) > 0) {
            //     error_log(print_r( " more than 1", true));
            // }
        } catch (Exception $e) {
            error_log(print_r( $e->getMessage(), true));
        }

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

    public function showTaskList($companyId)
    {
        $userIds = array();
        $userCompany = UserCompany::whereCompanyId('1')->get();
        foreach ($userCompany as $user) {
            $userIds[] = $user->user_id;
        }
        $tasks = Task::whereCompanyId($companyId)->get();
        $this->svc->insertCollab($tasks, $userIds);
        $crTasks = Task::whereCompanyId($companyId)->whereUserId('Auth::user()->id')->get();
        $aTasks = Task::whereCompanyId($companyId)->whereAssignedId('Auth::user()->id')->get();
        $coTasks = Task::whereCompanyId($companyId)->where('collaborator->Auth::user()->id')->get();
        if (sizeof($crTasks) > 0) {
            return $crTasks;
        } else if (sizeof($aTasks) > 0) {
            return $aTasks;
        } else if (sizeof($coTasks) > 0) {
            return $coTasks;
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
        $status = Auth::user()->admin;
        //$createdTask = Task::whereUserId($user_id)->whereType(true)->where('date_reminder', '>', $now)->get();
        // $assignedTask = Task::whereAssignedId($user_id)->whereType(true)->where('date_reminder', '>', $now)->get();
        // $expiredTask = Task::whereAssignedId($user_id)->whereType(true)->where('date_reminder', '<', $now)->where('status', '<', 3)->orderBy('date_reminder', 'asc')->get();
        $expiredCreatedTask = Task::whereUserId($user->id)->whereType(true)->where('status', '<', 2)->where('date_reminder', '<', $now)->orderBy('date_reminder', 'asc')->get();
        $expiredAssignedTask = Task::whereAssignedId($user->id)->whereType(true)->where('status', '<', 2)->where('date_reminder', '<', $now)->orderBy('date_reminder', 'asc')->get();
        if ($status) {
            if ($condition == 'monthly') {
                $monthly = Date((Carbon::now()->format('Y-m-d 00:00:00')), strtotime("+1 month"));
                $createdTask = Task::whereUserId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                $onGoingTask = Task::whereAssignedId($user_id)->whereType(true)->whereStatus(1)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                $closedCreatedTask = Task::whereUserId($user_id)->whereStatus(2)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                $closedAssignedTask = Task::whereAssignedId($user_id)->whereStatus(2)->where('date_reminder', '<', $monthly)->orderBy('date_reminder', 'asc')->get();
                //return view('ur view',compact('createdTask','onGoingTask','closedCreatedTask','closedAssignedTask','expiredCreatedTask','expiredAssignedTask'));
            } elseif ($condition == 'yearly') {
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

    public function breakdownReport()
    {
        $now = Carbon::now();
    }

    public function closeTask($id)
    {
        $task = Task::find('id', $id);
        $status = Auth::user()->admin;
        if ($status || $task->user_id == Auth::user()->id) {
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
