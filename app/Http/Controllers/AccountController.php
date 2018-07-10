<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;

class AccountController extends Controller
{
  //points to auth::
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
      return view('layouts.dashboard');
  }

  public function index_data_presentation()
  {
      return view('layouts.data_presentation');
  }

  public function index_settings()
  {
      return view('layouts.settings');
  }

}
