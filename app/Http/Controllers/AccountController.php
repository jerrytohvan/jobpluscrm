<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
  public function welcome()
  {
      return view('welcome');
  }
    public function index()
    {
        return view('dashboard');
    }

    public function register()
    {
        return view('includes.register');
    }
}
