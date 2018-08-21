<?php

namespace App\Models\Employees;

use Illuminate\Http\Request;
use App\Models\Employees\Employee;

class EmployeeService
{
     /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeEmployee($array)
  {
      return Employee::Create([
        'name' => $array['name'],
        'title' => $array['title'],
        'handphone' => $array['handphone'],
        'email' => $array['email'],
        'telephone' => $array['telephone'],
        'company_id' => $array['company_id']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateEmployee($id, $array)
  {
    $employee = Employee::find($id);
    foreach($array as $key => $value){
      $employee->$key = $value;
    }
      $employee->save();
      return $employee;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyEmployee($id)
  {
    Employee::findOrFail($id)->delete();
    return 204;
  }
}
