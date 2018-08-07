<?php

namespace App\Models\Employees;

use Illuminate\Http\Request;

class EmployeeService
{
    public function addEmployee($request)
    {
        $employee = new Employee();
        $employee->id = $request.id;
        $employee->name = $request.name;
        $employee->title = $request.handphone;
        $employee->email = $request.email;
        $employee->telephone = $request.telephone;
        $employee->company_id = $request.company_id;
    }
}