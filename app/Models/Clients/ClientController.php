<?php

namespace App\Models\Clients;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\Company;

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
      return view('layouts.accounts_fulllist',compact('accounts'));
  }
  public function index_account_new()
  {
    $companies = $this->svc->getAllCompany();
      $message = "";
      $status = "";
      return view('layouts.accounts_new', compact('message', 'status','companies'));
  }

  public function index_companies_full_list()
  {
    $companies = $this->svc->getAllCompany();
      return view('layouts.companies_fulllist', compact('companies'));
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
      if($company == null){
        $message = "Failed to add company!";
        $status = 0;
      }
      return view('layouts.companies_new',compact('status', 'message'));
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
      if($account == null){
        $message = "Failed to add account!";
        $status = 0;
      }
      return view('layouts.accounts_new',compact('status', 'message','companies'));
  }


}
