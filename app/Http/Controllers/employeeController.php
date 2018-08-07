<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use Illuminate\Http\Request;

class employeeController extends Controller
{

    // public function __construct(employeeService $employeeSvc)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $employee->company_name = $request->company_name;
        $employee->name = $request->name;
        $employee->handphone = $request->handphone;
        $employee->telephone = $request->telephone;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $employee->company_name = $request->company_name;
        $employee->name = $request->name;
        $employee->handphone = $request->handphone;
        $employee->telephone = $request->telephone;
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
