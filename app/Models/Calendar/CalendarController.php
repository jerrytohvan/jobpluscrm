<?php

namespace App\Models\Calendar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
  public function index(){
    return view('layouts.index_calendar');
  }

}
