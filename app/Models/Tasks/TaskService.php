<?php

namespace App\Models\Tasks;

use Auth;
use App\Models\Users\User;
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
    print(Auth::user()->id);
        return Task::Create([
          'title' => $array['title'],
          'description' => $array['description'],
          'date_reminder' => $array['date_reminder'],
          'user_id' => Auth::user()->id,
          'assigned_to_id' => User::where('email',$array['assigned_to_id'])->first() == "" ? null :User::where('email',$array['assigned_to_id'])->first()->id,
          'type' => $array['type']
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
