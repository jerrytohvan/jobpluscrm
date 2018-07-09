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
      return view('dashboard');
  }

}
