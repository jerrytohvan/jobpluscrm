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
        if (Auth::user()->admin == true) {
            $users = User::all()->sortBy('name');
            $companies = Company::all()->sortBy('name');
            return view('layouts.index_task', compact('users', 'companies', 'message', 'status'));
        } else {
            $userCIds = Task::whereUserId(Auth::user()->id)->orWhere('assigned_id', Auth::user()->id)->orWhereNotNull('collaborator->Auth::user()->id')->pluck('company_id')->toArray();
            $userCompanyIds = UserCompany::whereUserId(Auth::user()->id)->pluck('company_id')->toArray();
            $allCIds = array_merge($userCIds, $userCompanyIds);
            $companies = Company::whereIn('id', $allCIds)->orWhere('user_id', Auth::user()->id)->orderBy('name', 'asc')->get();
            return view('layouts.index_tasks_user', compact('companies', 'message', 'status'));
        }
    }

    public function createTask()
    {
        $task = $this->svc->storeTask(request()->all());
        if ($task == null) {
            $message = "Failed to add task";
            $status = 0;
        }
        $message = "Task successfully created!";
        $status = 1;
        if (Auth::user()->admin == true) {
            $users = User::all();
            $companies = Company::all();
            return view('layouts.index_task', compact('status', 'message', 'users', 'companies'));
        } else {
            $userCIds = Task::whereUserId(Auth::user()->id)->orWhere('assigned_id', Auth::user()->id)->orWhereNotNull('collaborator->Auth::user()->id')->pluck('company_id')->toArray();
            $userCompanyIds = UserCompany::whereUserId(Auth::user()->id)->pluck('company_id')->toArray();
            $allCIds = array_merge($userCIds, $userCompanyIds);
            $companies = Company::whereIn('id', $allCIds)->orWhere('user_id', Auth::user()->id)->orderBy('name', 'asc')->get();
            return view('layouts.index_tasks_user', compact('companies', 'message', 'status'));
        }
    }

    public function createTaskInCompanyView()
    {
        $message = "Failed to add task!";
        $status = 0;
        if (Auth::user()->admin == true) {
            $users = User::all();
            $companies = Company::all();
            if ($this->svc->storeTask(request()->all())) {
                $message = "Task successfully added!";
                $status = 1;
            }
            return redirect()->back()->with(['message' => $message, 'status' => $status,  'users' => $users, 'companies' => $companies]);
        } else {
            $companies = Company::whereUserId(Auth::user()->id)->get();
            if ($this->svc->storeTask(request()->all())) {
                $message = "Task successfully added!";
                $status = 1;
            }
            return redirect()->back()->with(['message' => $message, 'status' => $status, 'companies' => $companies]);
        }
    }


    public function display()
    {
        $client = new Client();

        try {
            $res = $client->request('GET', 'https://dbscript1.herokuapp.com/mailData');
            $content = $res->getBody()->getContents();
            $var = json_decode($content, true);
            $emailSend = $this->mTc->processTaskForEmail($var);
            $teleSend = $this->tSvc->send($var);
        } catch (Exception $e) {
            error_log(print_r($e->getMessage(), true));
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


    public function editTask()
    {
        $message = "Task update was unsuccessful! ";
        $status = 0;
        $task = Task::find(request()->input('task_id'));
        if ($task!=null) {
            $mod_date = date('Y-m-d H:i:s', strtotime(request()->input('date')));

            if (!empty(request()->input('consultant'))) {
                $task->update([
            'title' => request()->input('title'),
            'date_reminder' =>  $mod_date,
            'assigned_id' => !empty(request()->input('consultant')) ? request()->input('consultant') : null
          ]);
            } elseif (request()->input('consultant')=="") {
                $task->update([
        'title' => request()->input('title'),
        'date_reminder' =>  $mod_date,
        'assigned_id' => null
      ]);
            } else {
                $task->update([
          'title' => request()->input('title'),
          'date_reminder' =>  $mod_date
        ]);
            }
            $task->save();
            $message = "Task succesfully updated!";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }
}
