<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;
use App\Models\Clients\Company;
use Carbon\Carbon;

class MetricsController extends Controller
{
  // today's date
      public function todayDate(){
      $todayDate = Carbon::now()->format('Y-m-d 00:00:00');
      return $todayDate;
      }
  // 7 days ago date
      public function thisWeek(){
          $todayDate = $this->todayDate();
          $sevenDaysAgoDate = Date($todayDate,strtotime("-7 day"));
          return $sevenDaysAgoDate;
      }
  // 14 days ago date
      public function lastWeek(){
          $todayDate = $this->todayDate();
          $sevenDaysAgoDate = $this->thisWeek();
          $fourteenDaysAgoDate =Date($todayDate,strtotime("-14 day"));
          return $fourteenDaysAgoDate;
      }

    // Metric 1
    //overdue task
      public function tasksOverdue(){
            $now = $this->todayDate();
            $tasksOverdueCounter = 0;
            $overdueTasks = Task::where('date_reminder','<=',$now )->get();
            // count task overdue
              foreach ($overdueTasks as $task){
                         $tasksOverdueCounter++;
              }
            return $tasksOverdueCounter;
      }
      // overdue last week only
      public function overdueTaskThisWeek(){
            $now = $this->todayDate();
            $sevenDaysAgoDate = $this->thisWeek();
            $tasksOverdueCounter= 0;
            $overdueTasksThisWeek = Task::where('date_reminder','<=',$now )->where('date_reminder','>=',$sevenDaysAgoDate )->get();
            // count task overdue
              foreach ($overdueTasksThisWeek as $task){
                         $tasksOverdueCounter++;
              }
            return $tasksOverdueCounter;
      }
      // overdue comparison
      public function overdueComparison(){
        $sevenDaysAgoDate = $this->thisWeek();
        $fourteenDaysAgoDate = $this->lastWeek();
        //overdue this week
        $overdueTasksThisWeek =$this->overdueTaskThisWeek();
        // overdue last week
        $overdueTaskLastWeek = 0;
        $taskOverdueLastWeek = Task::where('date_reminder','<=',$sevenDaysAgoDate )->where('date_reminder','>=',$sevenDaysAgoDate )->get();
        foreach ($taskOverdueLastWeek as $task) {
          $overdueTaskLastWeek++;
        }
        //compare
        $overdueComparison = 0.0;
        if($overdueTasksThisWeek !=0 || $overdueTaskLastWeek != 0){
            $overdueComparison = $overdueTasksThisWeek/$overdueTaskLastWeek;
        }
        return $overdueComparison;
      }

  // METRIC 2
  // task competed  of the last 7 days
  public function taskThisWeek(){
    $completedThisWeek = 0;
    $todayDate = $this->todayDate();
    $sevenDaysAgoDate = $this->thisWeek();
  //  $completedTaskThisWeek = Task::whereStatus(2)->where('updated_at','<=',$todayDate )->where('updated_at','>=',$sevenDaysAgoDate)->get();
    $completedTaskThisWeek = Task::whereStatus(2)->get();
    foreach ($completedTaskThisWeek as $task) {
          $completedThisWeek++;
    }
    return $completedThisWeek;
  }

  // task of last 7 versus last 14
      public function taskCompletedComparison(){
              $todayDate = $this->todayDate();
              $sevenDaysAgoDate = $this->thisWeek();
              $fourteenDaysAgoDate = $this->lastWeek();
              $completedLastWeek = 0;
              $taskPercentageChange = 0.0;
              // tasks in the prev week
              $completedTaskPreviousWeek = Task::whereStatus('2')->where('updated_at','<=',$sevenDaysAgoDate )->where('updated_at','>=',$fourteenDaysAgoDate)->get();
              foreach ($completedTaskPreviousWeek as $task) {
                  $completedlastWeek++;
              }
              //tasks this week counter
              $completedThisWeek = $this->taskThisWeek();
              if($completedLastWeek != 0 || $completedThisWeek != 0){
                  $taskPercentageChange = $completedThisWeek/$completedLastWeek;
              }

              return $taskPercentageChange;
      }


      // Metric 3
      // companies created last 7 days
      public function leadsThisWeek(){
        $todayDate = $this->todayDate();
        $sevenDaysAgoDate = $this->thisWeek();
        $madeThisWeek = 0;
        // companies created last 7 days
        $companiesCreatedPreviousWeek = Company::where('created_at','<=',$todayDate  )->where('created_at','>=',$sevenDaysAgoDate)->get();
        foreach ($companiesCreatedPreviousWeek as $task) {
              $madeThisWeek++;
        }
        return $madeThisWeek;
      }
      // companies compared with last 14 days ratio
      public function newLeadsComparison(){
          $todayDate = $this->todayDate();
          $sevenDaysAgoDate = $this->thisWeek();
          $fourteenDaysAgoDate = $this->lastWeek();
          $madeThisWeek = 0;
          $madeLastWeek = 0;
          // companiesCreatedLast 7 days
          $madeThisWeek = $this->leadsThisWeek();
          // companies created last 14 days
          $companiesCreatedLastWeek =Company::where('created_at','<=',$sevenDaysAgoDate  )->where('created_at','>=',$fourteenDaysAgoDate)->get();
          foreach ($companiesCreatedLastWeek as $task) {
                $madeLastWeek++;
          }
          //company growth rate
            $companyPercentageChange = 0.0;
            if($madeLastWeek !=0 || $madeThisWeek != 0){
                $companyPercentageChange = $madeThisWeek/$madeLastWeek;
            }
            return $companyPercentageChange;
      }
}
