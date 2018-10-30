<?php

namespace App\Models\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Chats\TelegramService;
use App\Models\Clients\Company;
use App\Models\Mail\MailController;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskService;
use App\Models\Users\User;
use App\Models\Users\UserCompany;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(TaskService $taskSvc, TelegramService $teleSvc, MailController $mailTc)
    {
        $this->svc = $taskSvc;
        $this->tSvc = $teleSvc;
        $this->mTc = $mailTc;
    }

    public function index()
    {
        $message = "";
        $status = "";
        if(Auth::user()->admin == true){
        $users = User::all()->sortBy('name');
        $companies = Company::all()->sortBy('name');
        //$task = Task::all();
        return view('layouts.index_task', compact('users', 'companies',  'message', 'status'));
        }else{
        $companies = Company::whereUserId(Auth::user()->id)->get();
        return view('layouts.index_tasks_user', compact( 'companies',  'message', 'status'));
        }
        
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


    public function createTaskInCompanyView()
    {
        $message = "Failed to add task!";
        $status = 0;
        $users = User::all();
        $companies = Company::all();
        if ($this->svc->storeTask(request()->all())) {
            $message = "Task successfully added!";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status,  'users' => $users, 'companies' => $companies]);
    }


    public function display()
    {
        $client = new Client();

        try {
            $res = $client->request('GET', 'https://dbscript.herokuapp.com/mailData');
            $content = $res->getBody()->getContents();
            $var = json_decode($content, true);
            $emailSend = $this->mTc->processTaskForEmail($var);
            $teleSend = $this->tSvc->send($var);
        } catch (Exception $e) {
            error_log(print_r($e->getMessage(), true));
        }
    }

    public function createReminder(Request $request)
    {
        $reminder = $this->svc->storeReminder($request);
        return $reminder;
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
        } elseif (sizeof($aTasks) > 0) {
            return $aTasks;
        } elseif (sizeof($coTasks) > 0) {
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

    //error_log(print_r( $tasks,true));
    // public function topfew()
    // {
    //     $dateFrom = null;
    //     $dateTo = null;
    //     $requestArray = request()->all();
    //     if (sizeof($requestArray) != 0) {
    //         $dateFrom = Date($requestArray['from']);
    //         $dateTo = Date($requestArray['to']);
    //     }

    //     if ($dateFrom != null && $dateTo != null) {
    //         $companies = Company::all();
    //         $id = Auth::user()->id;
    //         $user = User::all();
    //         $collaboratorsIn = Auth::user()->companies->map(function ($value, $key) {
    //             return $value->id;
    //         });
    //         $users = User::all();
    //         // $tasks = Task::whereUserId($id)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orWhere('assigned_id', $id)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orWhereIn('company_id', $collaboratorsIn)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orderBy('task', 'asc')->get();
    //         $tasks = Task::whereUserId($id)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orWhere('assigned_id', $id)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orWhereIn('company_id', $collaboratorsIn)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orderBy('date_reminder', 'desc')->get();
    //         $tasksOpen = $tasks->map(function ($value, $key) use ($companies, $users) {
    //             // $value['company'] = Company::find($value['company_id'])->name;
    //             $value['company'] = $companies->filter(function ($company) use ($value) {
    //                 return $company->id == $value['company_id'];
    //             })->first()->name;
    //             $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['user_id'];
    //             })->first()->name : "";
    //             // $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name : "";
    //             $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['assigned_id'];
    //             })->first()->name : "";

    //             return $value;
    //         })->filter(function ($task, $key) {
    //             return $task->status == 0;
    //         })->values();

    //         $tasksOnGoing = $tasks->map(function ($value, $key) use ($companies, $users) {
    //             $value['company'] = $companies->filter(function ($company) use ($value) {
    //                 return $company->id == $value['company_id'];
    //             })->first()->name;
    //             $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['user_id'];
    //             })->first()->name : "";
    //             $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['assigned_id'];
    //             })->first()->name : "";
    //             return $value;
    //         })->filter(function ($task, $key) {
    //             return $task->status == 1;
    //         })->values();

    //         $tasksClosed = $tasks->map(function ($value, $key) use ($companies, $users) {
    //             $value['company'] = $companies->filter(function ($company) use ($value) {
    //                 return $company->id == $value['company_id'];
    //             })->first()->name;
    //             $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['user_id'];
    //             })->first()->name : "";
    //             $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['assigned_id'];
    //             })->first()->name : "";
    //             return $value;
    //         })->filter(function ($task, $key) {
    //             return $task->status == 2;
    //         })->values();

    //         $message = "hi";
    //         $status = "200";

    //         return view('layouts.dummy', compact('tasksOpen', 'message', 'status'));
    //     } else {
    //         $today = Carbon::now('Asia/Singapore')->format('Y-m-d 00:00:00');
    //         $tmr = Carbon::tomorrow('Asia/Singapore')->format('Y-m-d 00:00:00');
    //         $id = Auth::user()->id;
    //         $user = User::all();
    //         $collaboratorsIn = Auth::user()->companies->map(function ($value, $key) {
    //             return $value->id;
    //         });
    //         $tasks = Task::whereUserId($id)->whereBetween('date_reminder', [$today,$tmr])->orWhere('assigned_id', $id)->whereBetween('date_reminder', [$today,$tmr])->orWhereIn('company_id', $collaboratorsIn)->whereBetween('date_reminder', [$today,$tmr])->orderBy('date_reminder', 'desc')->Limit(5)->get();

    //         //retrieve all company and users
    //         $companies = Company::all();
    //         $users = User::all();
    //         $tasksOpen = $tasks->map(function ($value, $key) use ($companies, $users) {
    //             // $value['company'] = Company::find($value['company_id'])->name;
    //             $value['company'] = $companies->filter(function ($company) use ($value) {
    //                 return $company->id == $value['company_id'];
    //             })->first()->name;
    //             $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['user_id'];
    //             })->first()->name : "";
    //             // $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name : "";
    //             $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['assigned_id'];
    //             })->first()->name : "";

    //             return $value;
    //         })->filter(function ($task, $key) {
    //             return $task->status == 0;
    //         })->values();

    //         $tasksOnGoing = $tasks->map(function ($value, $key) use ($companies, $users) {
    //             $value['company'] = $companies->filter(function ($company) use ($value) {
    //                 return $company->id == $value['company_id'];
    //             })->first()->name;
    //             $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['user_id'];
    //             })->first()->name : "";
    //             $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['assigned_id'];
    //             })->first()->name : "";
    //             return $value;
    //         })->filter(function ($task, $key) {
    //             return $task->status == 1;
    //         })->values();

    //         $tasksClosed = $tasks->map(function ($value, $key) use ($companies, $users) {
    //             $value['company'] = $companies->filter(function ($company) use ($value) {
    //                 return $company->id == $value['company_id'];
    //             })->first()->name;
    //             $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['user_id'];
    //             })->first()->name : "";
    //             $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
    //                 return $user->id == $value['assigned_id'];
    //             })->first()->name : "";
    //             return $value;
    //         })->filter(function ($task, $key) {
    //             return $task->status == 2;
    //         })->values();

    //         $message = "hi";
    //         $status = "200";

    //         return view('layouts.dummy', compact('tasksOpen', 'message', 'status'));
    //     }
    // }

    public function updateToDoList($id)
    {
        return $this->svc->updateTask($id, request()->all());
    }

    public function deleteToDoList($id)
    {
        return $this->svc->destroyTask($id);
    }
}
