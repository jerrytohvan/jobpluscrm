<?php

namespace App\Models\Resumes;

use Illuminate\Http\Request;
use App\Models\Resumes\Resume;

class ResumeService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeResume($array)
  {
      return Resume::Create([
        'filename' => $array['filename'],
        'candidate_id' => $array['candidate_id'],
        'extension' => $array['extension']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateResume($id, $array)
  {
    $resume = Resume::find($id);
    foreach($array as $key => $value){
      $resume->$key = $value;
    }
      $resume->save();
      return $resume;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyResume($id)
  {
    Resume::findOrFail($id)->delete();
    return 204;
  }

}
