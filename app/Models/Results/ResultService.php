<?php

namespace App\Models\Results;

use Illuminate\Http\Request;
use App\Models\Results\Result;

class ResultService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeResult($array)
  {
      return Result::Create([
        'interest_id' => $array['interest_id'],
        'field_id' => $array['field_id'],
        'candidate_id' => $array['candidate_id'],
        'user_id' => $array['user_id'],
        'project_group_id' => $array['project_group_id']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateResult($id, $array)
  {
    $result = Result::find($id);
    foreach($array as $key => $value){
      $result->$key = $value;
    }
      $result->save();
      return $result;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyResult($id)
  {
    Result::findOrFail($id)->delete();
    return 204;
  }

}
