<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Tasks\Task;
use App\Models\Posts\Post;
use App\Models\Users\UserCompany;
use App\Models\Clients\Company;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Clients;

class AccountController extends Controller
{
    //points to auth::
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        $id = Auth::user()->id;
        $collaboratorsIn = Auth::user()->companies->map(function ($value, $key) {
            return $value->id;
        });
        $tasks = Task::orderBy('order')->whereUserId($id)->orWhere('assigned_id', $id)->orWhereIn('company_id', $collaboratorsIn)->get();

        //retrieve all company and users
        $companies = Company::all();
        $users = User::all();
        $tasksOpen = $tasks->map(function ($value, $key) use ($companies,$users) {
            // $value['company'] = Company::find($value['company_id'])->name;
            $value['company'] =  $companies->filter(function ($company) use ($value) {
                return $company->id == $value['company_id'];
            })->first()->name;

            // $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name : "";
            $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
                return $user->id == $value['assigned_id'];
            })->first()->name :  "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 0;
        })->values();

        $tasksOnGoing = $tasks->map(function ($value, $key) use ($companies,$users) {
            $value['company'] =  $companies->filter(function ($company) use ($value) {
                return $company->id == $value['company_id'];
            })->first()->name;
            $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
                return $user->id == $value['assigned_id'];
            })->first()->name :  "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 1;
        })->values();

        $tasksClosed = $tasks->map(function ($value, $key) use ($companies,$users) {
            $value['company'] =  $companies->filter(function ($company) use ($value) {
                return $company->id == $value['company_id'];
            })->first()->name;
            $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
                return $user->id == $value['assigned_id'];
            })->first()->name:  "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 2;
        })->values();
        $tasksOverdue = $this->tasksOverdue();
        $leadsComparison = $this->newLeadsComparison();
        $taskComparison = $this->taskCompletedComparison();
        $taskThisWeek = $this->taskThisWeek();
        $leadsThisWeek = $this->leadsThisWeek();
        $overdueComparison = $this->overdueComparison();
        $totalTaskCompletedThisYear = $this->totalTaskCompletedThisYear();
        $companiesYTD = $this->companiesYTD();

        //construct message for last announcement
        $lastestAnnouncement = Post::whereCompanyId(null)->latest('created_at')->first();
        $announcementMsg= "";
        if ($lastestAnnouncement!=null) {
            $announcementMsg= '"' . $lastestAnnouncement->content . '"' . ' - by ' . $lastestAnnouncement->user->name;
        }

        $message = "";
        $status = 0;
        return view('layouts.dashboard', compact('tasksOpen', 'tasksOnGoing', 'tasksClosed', 'tasksOverdue', 'leadsComparison', 'taskComparison', 'taskThisWeek', 'leadsThisWeek', 'overdueComparison', 'totalTaskCompletedThisYear', 'companiesYTD', 'announcementMsg', 'message', 'status'));
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
        if ($date->y != 0) {
            $string .= $date->y;
            if ($date->y == '1') {
                $string .= " year";
            } else {
                $string .= " years";
            }
        } elseif ($date->m != 0) {
            $string .= $date->m;
            if ($date->m == 1) {
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
                $string .= " hour";
            } else {
                $string .= " hours";
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


    // AFTER THIS IS THE METRIC CONTROLLER PLEASE DO NOT DELETE
    // AFTER THIS IS THE METRIC CONTROLLER PLEASE DO NOT DELETE
    // AFTER THIS IS THE METRIC CONTROLLER PLEASE DO NOT DELETE

    // today's date end
    public function todayDateEnd()
    {
        $todayDateEnd = Carbon::now('Asia/Singapore')->format('Y-m-d 23:59:59');
        return $todayDateEnd;
    }
    //today's date
    public function todayDate()
    {
        $todayDate = Carbon::now('Asia/Singapore')->format('Y-m-d');
        return $todayDate;
    }
    // 7 days ago date
    public function thisWeek()
    {
        $todayDate = $this->todayDate();
        $sevenDaysAgoDate = Date('Y-m-d', strtotime("-7 days"));
        return $sevenDaysAgoDate;
    }
    // 14 days ago date
    public function lastWeek()
    {
        $todayDate = $this->todayDate();
        $sevenDaysAgoDate = $this->thisWeek();
        $fourteenDaysAgoDate =Date('Y-m-d', strtotime("-14 day"));
        return $fourteenDaysAgoDate;
    }

    // Metric 1
    //overdue task
    public function tasksOverdue()
    {
        $overdueTasks=null;
        $now = $this->todayDate();
      if (Auth::user()->admin == true){
        $overdueTasks = Task::where('status', '<', 2)->where('date_reminder', '<=', $now)->get();
      }else{
        $overdueTasks = Task::whereUserId(Auth::user()->id)->where('status', '<', 2)->where('date_reminder', '<=', $now)->get();
        }
      return sizeof($overdueTasks);
    }
    // overdue last week only
    public function overdueTaskThisWeek()
    {
        $now = $this->todayDate();
        $sevenDaysAgoDate = $this->thisWeek();

          if (Auth::user()->admin == true){
        $overdueTasksThisWeek = Task::where('status', '<', 2)->where('date_reminder', '<=', $now)->where('date_reminder', '>=', $sevenDaysAgoDate)->get();
        return sizeof($overdueTasksThisWeek);
      }else{
        $overdueTasksThisWeek = Task::whereUserId(Auth::user()->id)->where('status', '<', 2)->where('date_reminder', '<=', $now)->where('date_reminder', '>=', $sevenDaysAgoDate)->get();
        return sizeof($overdueTasksThisWeek);
      }
    }
    // overdue comparison
    public function overdueComparison()
    {
        $sevenDaysAgoDate = $this->thisWeek();
        $fourteenDaysAgoDate = $this->lastWeek();

        //overdue this week
        $overdueTasksThisWeek =$this->overdueTaskThisWeek();
        // overdue last week
        $overdueTaskLastWeek = 0;
        if(Auth::user()->admin == true){
        $taskOverdueLastWeek = Task::where('status', '<', 2)->where('date_reminder', '<=', $sevenDaysAgoDate)->where('date_reminder', '>=', $fourteenDaysAgoDate)->get();
      }else{
        $taskOverdueLastWeek = Task::whereUserId(Auth::user()->id)->where('status', '<', 2)->where('date_reminder', '<=', $sevenDaysAgoDate)->where('date_reminder', '>=', $fourteenDaysAgoDate)->get();
      }
        foreach ($taskOverdueLastWeek as $task) {
            $overdueTaskLastWeek++;
        }
        //compare
        if ($overdueTaskLastWeek == 0 && $overdueTasksThisWeek == 0) {
            return 0;
        } elseif ($overdueTaskLastWeek == 0 || $overdueTasksThisWeek == 0) {
            if ($overdueTaskLastWeek == 0) {
                return "n/a";
            } else {
                return "n/a";
            }
        } elseif ($overdueTaskLastWeek >= $overdueTasksThisWeek) {
            //increase
            return -$overdueTasksThisWeek/$overdueTaskLastWeek *100;
        } else {
            //decrease
            return $overdueTasksThisWeek/$overdueTaskLastWeek *100;
        }
    }

    // METRIC 2
    // task competed  of the last 7 days
    public function taskThisWeek()
    {
        $completedThisWeek = 0;
        $todayDate = $this->todayDateEnd();
        $sevenDaysAgoDate = $this->thisWeek();
        $completedTaskThisWeek = Task::whereStatus(2)->where('updated_at', '<=', $todayDate)->where('updated_at', '>=', $sevenDaysAgoDate)->get();
        $completedThisWeek = sizeof($completedTaskThisWeek);
        return $completedThisWeek;
    }

    // task of last 7 versus last 14
    public function taskCompletedComparison()
    {
        $todayDate = $this->todayDateEnd();
        $sevenDaysAgoDate = $this->thisWeek();
        $fourteenDaysAgoDate = $this->lastWeek();
        $completedLastWeek = 0;
        $taskPercentageChange = 0.0;
        // tasks in the prev week
        $completedTaskPreviousWeek = Task::whereStatus(2)->where('updated_at', '<=', $sevenDaysAgoDate)->where('updated_at', '>=', $fourteenDaysAgoDate)->get();
        $completedLastWeek = sizeof($completedTaskPreviousWeek);
        //tasks this week counter
        $completedThisWeek = $this->taskThisWeek();
        if ($completedThisWeek != 0 && $completedLastWeek == 0) {
            $taskPercentageChange = 100.0;
        }

        if ($completedLastWeek != 0) {
            $taskPercentageChange = $completedThisWeek/$completedLastWeek;
        }
        return $taskPercentageChange;
    }

    //total task completed this year
    public function totalTaskCompletedThisYear()
    {
        $todayDate = $this->todayDateEnd();
        $firstDayOfYear = Date('Y-m-d', strtotime('first day of january this year'));
          if (Auth::user()->admin == true){
        $completedTaskForYear = Task::whereStatus(2)->where('updated_at', '<=', $todayDate)->where('updated_at', '>=', $firstDayOfYear)->get();
        return sizeof($completedTaskForYear);
      }else{
        $completedTaskForYear = Task::whereUserId(Auth::user()->id)->whereStatus(2)->where('updated_at', '<=', $todayDate)->where('updated_at', '>=', $firstDayOfYear)->get();
        return sizeof($completedTaskForYear);
      }
      return null;
    }


    // Metric 3
    // companies created last 7 days
    public function leadsThisWeek()
    {
        $todayDate = $this->todayDate();
        $sevenDaysAgoDate = $this->thisWeek();
        $madeThisWeek = 0;
        // companies created last 7 days
        $companiesCreatedPreviousWeek = Company::where('created_at', '<=', $todayDate)->where('created_at', '>=', $sevenDaysAgoDate)->get();
        foreach ($companiesCreatedPreviousWeek as $task) {
            $madeThisWeek++;
        }
        return $madeThisWeek;
    }
    // companies compared with last 14 days ratio
    public function newLeadsComparison()
    {
        $todayDate = $this->todayDate();
        $sevenDaysAgoDate = $this->thisWeek();
        $fourteenDaysAgoDate = $this->lastWeek();
        $madeThisWeek = 0;
        $madeLastWeek = 0;
        // companiesCreatedLast 7 days
        $madeThisWeek = $this->leadsThisWeek();
        // companies created last 14 days
        $companiesCreatedLastWeek =Company::where('created_at', '<=', $sevenDaysAgoDate)->where('created_at', '>=', $fourteenDaysAgoDate)->get();
        $madeLastWeek = sizeof($companiesCreatedLastWeek);
        //company growth rate
        $companyPercentageChange = 0.0;
        if ($madeThisWeek != 0 && $madeLastWeek == 0) {
            $companyPercentageChange = 100.0;
        }
        if ($madeLastWeek !=0) {
            $companyPercentageChange = $madeThisWeek/$madeLastWeek;
        }
        return $companyPercentageChange;
    }

        public function companiesYTD()
        {
              $todayDate = $this->todayDate();
              $firstDayOfYear = Date('Y-m-d', strtotime('first day of january this year'));
              $companiesCreatedYTD =null;
          if (Auth::user()->admin == true){
              $companiesCreatedYTD =Company::where('created_at', '<=', $todayDate)->where('created_at', '>=', $firstDayOfYear)->get();
          }else{
             $companiesCreatedYTD = Company::whereUserId(Auth::user()->id)->where('created_at', '<=', $todayDate)->where('created_at', '>=', $firstDayOfYear)->get();
          }
          return sizeof($companiesCreatedYTD);
        }
}
