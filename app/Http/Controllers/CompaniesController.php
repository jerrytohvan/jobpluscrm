<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use App\Models\Clients\CompanyService;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    //
    public function __construct(CompanyService $companySvc)
    {
        $this->svc = $companySvc;
        // $this->middleware('auth');
    }
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
    public function store(Company $company)
    {
        //
        return $this->svc->storeCompany(request()->all());
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
    public function update($id)
    {
        //
        return $this->svc->updateCompany($id, request()->all());
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
        return $this->svc->destroyCompany($id);
    }

}
