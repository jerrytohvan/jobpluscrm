<?php

namespace App\Models\Clients;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
  //points to auth::
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index_client_full_list()
  {
      return view('layouts.clients_fulllist');
  }
  public function index_client_new()
  {
      return view('layouts.clients_new');
  }

  public function index_companies_full_list()
  {
      return view('layouts.companies_fulllist');
  }
  public function index_companies_new()
  {
      return view('layouts.companies_new');
  }


}
