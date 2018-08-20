<?php

namespace App\Models\Events;

use App\Models\Events\Event;

use Illuminate\Http\Request;


class EventService
{
  /**
   * Checks user existed and creates a new user
   * @param  Array   $array
   * @return Event $company
   * @author jerrytohvan
   */
  public function addEvent($array){
    return Event::create([
      'event_name' => $array->event_name,
        'description' => $array->description,
        'reminder' => $array->reminder,
      'user_id' => $array->user_id
      ]);
  }
  public function getAllEvents(){
    return Events::all()->sortBy('reminder');
  }

public function updateEvent($id,$array){
  $event = Event::find($id);
  foreach ($array as $key => $value) {
     $event->$key = $value;
  }
  $event->save();
  return $event;
}

}
