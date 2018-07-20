<?php

namespace App\Models\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
  public function index(){
    return view('layouts.index_event');
  }

}
