<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    // public function __construct(EmployeeService $employeeSvc)
    // {
    //     $this->employeeSvc = $employeeSvc;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $employees;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $employee = new Employee;
        $employee->id = $request->id;
        $employee->name = $request->name;
        $employee->title = $request->title;
        $employee->handphone = $request->handphone;
        $employee->email = $request->email;
        $employee->telephone = $request->telephone;
        $employee->company_id = $request->company_id;
        $employee->save();
        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employee= Employee::find($id);
      return $employee;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->title = $request->title;
        $employee->handphone = $request->handphone;
        $employee->email = $request->email;
        $employee->telephone = $request->telephone;
        $employee->company_id = $request->company_id;
        $employee->update();
        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Employee::findOrFail($id)->delete();
        return 204;
    }
}
