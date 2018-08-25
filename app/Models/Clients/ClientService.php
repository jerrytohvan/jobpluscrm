<?php

namespace App\Models\Clients;

use App\Models\Clients\Company;
use App\Models\Employees\Employee;

use Illuminate\Http\Request;

class ClientService
{
    /**
     * Checks user existed and creates a new user
     * @param  Array   $array
     * @return Company $company
     * @author jerrytohvan
     */
    public function addCompany($array)
    {
        return Company::create([
      'name' => $array->company_name,
        'address' => $array->address,
        'email' => $array->company_email,
      'telephone_no' => $array->telephone,
      'fax_no' => $array->fax,
      'website' => $array->website,
      'no_employees' => $array->no_employees == "" ? null :$array->no_employees ,
      'industry' => $array->industry,
      'lead_source' => $array->lead_source,
      'description' => $array->description
      ]);
    }
    public function getAllCompany()
    {
        return Company::all()->sortBy('name');
    }


    /**
     * Checks user existed and creates a new user
     * @param  Array   $array
     * @return Company $company
     * @author jerrytohvan
     */
    public function addAccount($array)
    {
        return Employee::create([
      'name' => $array->name,
      'email' => $array->email,
      'title' => $array->title,
      'handphone' => $array->handphone,
      'telephone' => $array->telephone,
      'company_id' => $array->company_id
      ]);
    }

    public function getAllAccount()
    {
        $employee = Employee::all();
        return $employee;
    }

    public function updateCompanyProfile(Company $company, $array)
    {
        // return  $company->update([
        //   'name' => $array->name,
        //   'email' => $array->email,
        //   'website' => $array->website,
        //   'industry' => $array->industry,
        //   'telephone_no' => $array->telephone_no,
        //   'fax_no' => $array->fax_no,
        //   'description' => $array->description,
        //   'no_employees' => $array->no_employees,
        //   'lead_source' => $array->lead_source,
        //
        //   ]);
        foreach ($array as $key => $value) {
            $company->$key = $value;
        }
        //THIS IS THE PROBLEM
        $company->save();

        return $company;
    }
}
