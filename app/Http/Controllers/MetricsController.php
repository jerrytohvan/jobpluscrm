<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;
use Carbon\Carbon;

class MetricsController extends Controller
{
// number of new leads/companies created last 7 days compared to the previous 7 days.
    public function newLeadsComparison(){
      $todayDate = "";
      $sevenDaysAgoDate = "";
      $fourteenDaysAgoDate = "";
      $tasklist = Task.getallTask();
      // companiesCreatedLastSeven
          $companiesCreatedLastSeven = 0;
          $companiesCreatedLastFourteen = 0;
          foreach ($comapny as $companiesList) {
            if($companyCreateDate<=today() && $companyCreateDate>= $seveDaysAgoDate){
              $companiesCreatedLastSeven++;
            }elseif ($companyCreateDate<=today() && $companyCreateDate>= $fourteenDaysAgoDate) {
                $companiesCreatedLastFourteen++;
            }
          }

      // companiesCreatedPrevSeven
          $companiesCreatedPrevSeven = 0;

      //


    }
//number of task completed last 7 days compared to the previous 7 days.
    public function taskCompletedComparison(){
            $todayDate = date();
            $sevenDaysAgoDate = strtotime("-7 day", $todayDate);;
            $fourteenDaysAgoDate = strtotime("-14 day", $date);;
            $completedThisWeek = 0;
            $completedPreviousWeek = 0;
            $percentageChange = 0.0;

            $allTask = Task::all();
            $completedTaskDate = Task::whereStatus('2')->where('updated_at','>=',date() )->get();

            foreach ($allTask as $task) {
              if ($task.endDate()<=today()&&$task.endDate()>= $sevenDaysAgoDAte)
                {
                  $completedThisWeek++;
                }
              if ($task.endDate() <= $sevenDaysAgoDAte &&$task.endDate()>= $fourteenDaysAgoDate)
                {
                  $completedLastWeek++;
                }
            }
            $percentageChange = $completedThisWeek/$completedLastWeek ;
        return $percentageChange;
    }
    // number of tasks that are currently overdue
    public function tasksOverdue(){
      $now = Carbon::now()->format('Y-m-d 00:00:00');
          $tasksOverdueCounter = 0;
          $completedTaskDate = Task::whereStatus('0')->where('date_reminder','>=',$now )->get();
          $test = 0;
          error_log(print_r("hi", true));
          error_log(print_r(sizeof($completedTaskDate), true));

          if(sizeof($completedTaskDate) > 0){
            foreach ($completedTaskDate as $task){
                        $tasksOverdueCounter++;

            }
          }
            return view('layouts.dashboard', compact('test'));
            //return $tasksOverdueCounter;
    }




}
