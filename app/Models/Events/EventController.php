<?php

namespace App\Models\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Events\EventService;

class EventController extends Controller
{
  public function __construct(EventService $eventSvc)
  {
      $this->svc = $eventSvc;
      // $this->middleware('auth');
  }
  // public function index(){
  //   return view('layouts.index_event');
  // }

  public function update($id){
    return $this->svc->updateEvent($id, request()->all());
  }

  public function create(Event $event){
    return $this->svc->addEvent(request()->all());
  }

}
