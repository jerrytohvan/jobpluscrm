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
      $completedThisWeek = 0;
      $completedPreviousWeek = 0;
      // companiesCreatedLastSeven
      $completedTasklastWeek = Companies::whereStatus('2')->where('updated_at','<=',date() )->where('updated_at','>=',$sevenDaysAgoDate)->get();
      foreach ($completedTasklastWeek as $task) {
            $completedThisWeek++;
      }
      // companiesCreatedPrevSeven
      $companiesCreatedPrevSeven = Companies::whereStatus('2')->where('updated_at','<=',$sevenDaysAgoDate )->where('updated_at','>=',$fourteenDaysAgoDate)->get();
      foreach ($completedTasklastWeek as $task) {
            $completedThisWeek++;
      }
      //company growth rate
        $companyPercentageChange = 0.0;
        $companyPercentageChange = $completedThisWeek/$completedLastWeek ;
          return view('layouts.dashboard', compact('companyPercentageChange'));
    }
//number of task completed last 7 days compared to the previous 7 days.
    public function taskCompletedComparison(){
            $todayDate = date();
            $sevenDaysAgoDate = strtotime("-7 day", $todayDate);;
            $fourteenDaysAgoDate = strtotime("-14 day", $date);;
            $completedThisWeek = 0;
            $completedPreviousWeek = 0;
            $taskPercentageChange = 0.0;
            $completedTasklastWeek = Task::whereStatus('2')->where('updated_at','<=',date() )->where('updated_at','>=',$sevenDaysAgoDate)->get();
            $completedTaskPreviousWeek = Task::whereStatus('2')->where('updated_at','<=',$sevenDaysAgoDate )->where('updated_at','>=',$fourteenDaysAgoDate)->get();
            foreach ($completedTasklastWeek as $task) {
                  $completedThisWeek++;
            }
            foreach ($completedTaskPreviousWeek as $task) {
                $completedLastWeek++;
            }

            $taskPercentageChange = $completedThisWeek/$completedLastWeek ;
            return view('layouts.dashboard', compact('taskPercentageChange'));
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
