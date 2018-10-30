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
use App\Models\Tasks\TaskService;

class AccountController extends Controller
{
    //points to auth::
    public function __construct(TaskService $taskSvc)
    {
        $this->svc = $taskSvc;
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        $id = Auth::user()->id;
        $collaboratorsIn = Auth::user()->companies->map(function ($value, $key) {
            return $value->id;
        });

        if (empty(request()->input('dateInserted'))) {
            $fromDate = Carbon::now('Asia/Singapore')->format('Y-m-d 00:00:00');
            $toDate = Carbon::tomorrow('Asia/Singapore')->format('Y-m-d 00:00:00');
            $tasksArray =   $this->svc->topfew(request()->all(), $fromDate, $toDate);
            // dd($toDate);
        } else {
            $fromDate =  request()->input('from');
            $toDate = request()->input('to');
            $tasksArray =   $this->svc->topfew(request()->all(), $fromDate, $toDate);
            // dd($toDate);
        }
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
        $tasksOpen = $tasksArray[0];
        $tasksOnGoing = $tasksArray[1];
        $tasksClosed = $tasksArray[2];

        $message = "";
        $status = 0;
        return view('layouts.dashboard', compact('fromDate', 'toDate', 'tasksOpen', 'tasksOnGoing', 'tasksClosed', 'tasksOverdue', 'leadsComparison', 'taskComparison', 'taskThisWeek', 'leadsThisWeek', 'overdueComparison', 'totalTaskCompletedThisYear', 'companiesYTD', 'announcementMsg', 'message', 'status'));
    }

    public function index_data_presentation()
    {
        return view('layouts.data_presentation');
    }

    public function index_settings()
    {
        return view('layouts.settings');
    }

    //error_log(print_r( $tasks,true));




    // AFTER THIS IS THE METRIC CONTROLLER PLEASE DO NOT DELETE
    // AFTER THIS IS THE METRIC CONTROLLER PLEASE DO NOT DELETE
    // AFTER THIS IS THE METRIC CONTROLLER PLEASE DO NOT DELETE

    // today's date
    public function todayDateEnd()
    {
        $todayDateEnd = Carbon::now('Asia/Singapore')->format('Y-m-d 23:59:59');
        return $todayDateEnd;
    }
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
        $now = $this->todayDate();
        $tasksOverdueCounter = 0;
        $overdueTasks = Task::where('status', '<', 2)->where('date_reminder', '<=', $now)->get();
        // count task overdue
        $tasksOverdueCounter = sizeof($overdueTasks);
        return $tasksOverdueCounter;
    }
    // overdue last week only
    public function overdueTaskThisWeek()
    {
        $now = $this->todayDate();
        $sevenDaysAgoDate = $this->thisWeek();
        $tasksOverdueCounter= 0;
        $overdueTasksThisWeek = Task::where('status', '<', 2)->where('date_reminder', '<=', $now)->where('date_reminder', '>=', $sevenDaysAgoDate)->get();
        // count task overdue
        foreach ($overdueTasksThisWeek as $task) {
            $tasksOverdueCounter++;
        }
        return $tasksOverdueCounter;
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
        $taskOverdueLastWeek = Task::where('status', '<', 2)->where('date_reminder', '<=', $sevenDaysAgoDate)->where('date_reminder', '>=', $fourteenDaysAgoDate)->get();
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
        $completedTaskForYear = Task::whereStatus(2)->where('updated_at', '<=', $todayDate)->where('updated_at', '>=', $firstDayOfYear)->get();
        $counter = sizeof($completedTaskForYear);
        return $counter;
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
        $companiesCreatedYTD =Company::where('created_at', '<=', $todayDate)->where('created_at', '>=', $firstDayOfYear)->get();
        $companiesYTD = sizeof($companiesCreatedYTD);
        return $companiesYTD;
    }
}
