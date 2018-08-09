<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $companies;
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
        $company = new Company;
        $company->id = $request->id;
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->telephone_no = $request->telephone_no;
        $company->fax_no = $request->fax_no;
        $company->website = $request->website;
        $company->no_employees = $request->no_employees;
        $company->industry = $request->industry;
        $company->lead_source = $request->lead_source;
        $company->transaction = $request->transaction;
        $company->description = $request->description;
        $company->save();
        return $company;
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
        $company = Company::find($id);
        return $company;

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
        $company = Company::find($id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->telephone_no = $request->telephone_no;
        $company->fax_no = $request->fax_no;
        $company->website = $request->website;
        $company->no_employees = $request->no_employees;
        $company->industry = $request->industry;
        $company->lead_source = $request->lead_source;
        $company->transaction = $request->transaction;
        $company->description = $request->description;
        $company->update();
        return $company;
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
        Company::findOrFail($id)->delete();
        return 204;
    }

}
