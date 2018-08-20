<?php

namespace App\Models\Calendar;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Events\Event;
// use App\Models\Events\EventServices;

class CalendarController extends Controller
{
  public function __construct(EventServices $eventSvc)
  {
      $this->svc =$eventSvc;
  }
  public function index(){
    return view('layouts.index_calendar');
  }

  public function add_new_event(Request $request){
    $event = $this->svc->addEvent($request);
    if($event == null){
      $message = "Failed to add company!";
      $status = 0;
    }
    return view('layouts.index_calendar',compact('status', 'message'));
  }

  public function update_event(Request $request){
    $event = $this->svc->updateEvent($id,$request);
  }

}
