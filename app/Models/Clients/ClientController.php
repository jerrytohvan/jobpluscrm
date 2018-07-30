<?php

namespace App\Models\Clients;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
  public function __construct(ClientService $clientSvc)
  {
      $this->svc = $clientSvc;
      $this->middleware('auth');
  }
  public function index_client_full_list()
  {
      return view('layouts.accounts_fulllist');
  }
  public function index_client_new()
  {
      return view('layouts.accounts_new');
  }

  public function index_companies_full_list()
  {
      return view('layouts.companies_fulllist');
  }
  public function index_companies_new()
  {
    $message = "";
    $status = "";
      return view('layouts.companies_new', compact('message', 'status'));
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


}
