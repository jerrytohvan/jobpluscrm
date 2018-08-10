<?php

namespace App\Models\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
  public function index(){
    return view('layouts.index_mail');
  }

}
