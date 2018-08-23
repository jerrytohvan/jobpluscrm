<?php

namespace App\Models\Clients;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use App\Models\Employees\Employee;

class ClientController extends Controller
{
    public function __construct(ClientService $clientSvc)
    {
        $this->svc = $clientSvc;
        $this->middleware('auth');
    }
    public function index_account_full_list()
    {
        $accounts = $this->svc->getAllAccount();
        return view('layouts.accounts_fulllist', compact('accounts'));
    }
    public function index_account_new()
    {
        $companies = $this->svc->getAllCompany();
        $message = "";
        $status = "";
        return view('layouts.accounts_new', compact('message', 'status', 'companies'));
    }

    public function index_companies_full_list()
    {
        $array = $this->svc->getAllCompany();
        // $companies = $this->svc->getAllCompany()->map(function ($row) {
        //     return [$row->name, $row->address, $row->email, $row->telephone_no, $row->industry, $row->website, $row->transaction];
        // });
        // $array = json_encode([
        //   "data" => array_values($companies->toArray())
        // ]);
        return view('layouts.companies_fulllist', compact('array'));
    }
    public function index_companies_new()
    {
        $message = "";
        $status = "";
        $companies = $this->svc->getAllCompany();
        return view('layouts.companies_new', compact('message', 'status', 'companies'));
    }
    public function add_new_company(Request $request)
    {
        $message = "Company successfully added!";
        $status = 1;
        $this->validate($request, [
        'company_name' => 'required',
        'address' => 'required',
        'company_email' => 'required',
        'telephone' => 'required'
      ]);
        $company = $this->svc->addCompany($request);
        if ($company == null) {
            $message = "Failed to add company!";
            $status = 0;
        }
        return view('layouts.companies_new', compact('status', 'message'));
    }

    public function add_new_account(Request $request)
    {
        $companies = $this->svc->getAllCompany();
        $message = "Account successfully added!";
        $status = 1;
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'handphone' => 'required',
        'company_id' => 'required'

      ]);
        $account = $this->svc->addAccount($request);
        if ($account == null) {
            $message = "Failed to add account!";
            $status = 0;
        }
        return view('layouts.accounts_new', compact('status', 'message', 'companies'));
    }
    public function showCompany(Company $company)
    {
        dd($company);
        return redirect()->route('companies.fulllist')->with(['message']);
    }

    public function removeCompany($company_id)
    {
        $company = Company::where('id', $company_id)->first();
        $employee = Employee::where('company_id', $company_id);
        $employee ->delete();
        $company->delete();
        return redirect()->route('companies.fulllist')->with(['message']);
    }
}
