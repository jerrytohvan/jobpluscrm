<?php

namespace App\Models\Interests;

use Illuminate\Http\Request;
use App\Models\Interests\Interest;

class InterestService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeInterest($array)
  {
      return Interest::Create([
        'interest_name' => $array['interest_name']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateInterest($id, $array)
  {
    $interest = Interest::find($id);
    foreach($array as $key => $value){
      $interest->$key = $value;
    }
      $interest->save();
      return $interest;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyInterest($id)
  {
    Interest::findOrFail($id)->delete();
    return 204;
  }

}
