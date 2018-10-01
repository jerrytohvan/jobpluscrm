<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Tasks\Task;
use App\Models\Clients\Company;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //points to auth::
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id = Auth::user()->id;
        $tasks = Task::orderBy('order')->whereUserId($id)->orWhere('assigned_id', $id)->get();
        //MAP WITH TASK OWNER, DUE, COMPANY NAME, DATE LEFT

        $tasksOpen = $tasks->map(function ($value, $key) {
            $value['company'] = Company::find($value['company_id'])->name;
            $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name : "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 0;
        })->values();

        $tasksOnGoing = $tasks->map(function ($value, $key) {
            $value['company'] = Company::find($value['company_id'])->name;
            $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name  : "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 1;
        })->values();

        $tasksClosed = $tasks->map(function ($value, $key) {
            $value['company'] = Company::find($value['company_id'])->name;
            $value['assignee'] =!empty($value['assigned_id']) ? User::find($value['assigned_id'])->name  : "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 2;
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

    public function constructStringFromDateTime($date)
    {
        if ($date->invert) {
            return "Pass due date";
        }
        $string = "Due in ";
        if ($date->y != "0") {
            $string .= $date->y;
            if ($date->y == '1') {
                $string .= " year";
            } else {
                $string .= " years";
            }
        } elseif ($date->m != '0') {
            $string .= $date->m;
            if ($date->m == '1') {
                $string .= " month";
            } else {
                $string .= " months";
            }
        } elseif ($date->d != '0') {
            $string .= $date->d;
            if ($date->d == '1') {
                $string .= " day";
            } else {
                $string .= " days";
            }
        } elseif ($date->h != '0') {
            $string .= $date->h;
            if ($date->h == '1') {
                $string .= " day";
            } else {
                $string .= " days";
            }
        } elseif ($date->i != '0') {
            $string .= $date->i;
            if ($date->i == '1') {
                $string .= " minute";
            } else {
                $string .= " minutes";
            }
        } elseif ($date->s != '0') {
            $string .= $date->s;
            if ($date->s == '1') {
                $string .= " second";
            } else {
                $string .= " seconds";
            }
        }
        return $string;
    }
}
