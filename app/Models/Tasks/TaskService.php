<?php

namespace App\Models\Tasks;

use Illuminate\Http\Request;
use App\Models\Tasks\Task;

class TaskService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeTask($array)
  {
      return Task::Create([
        'title' => $array['title'],
        'description' => $array['description'],
        'date_reminder' => $array['date_reminder'],
        'reminder_type' => $array['reminder_type'],
        'date_completed' => $array['date_completed'],
        'company_id' => $array['company_id'],
        'employee_id' => $array['employee_id'],
        'assigned_to_id' => $array['assigned_to_id']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateTask($id, $array)
  {
    $task = Task::find($id);
    foreach($array as $key => $value){
      $task->$key = $value;
    }
      $task->save();
      return $task;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyTask($id)
  {
    Task::findOrFail($id)->delete();
    return 204;
  }

}
