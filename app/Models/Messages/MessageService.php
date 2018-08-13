<?php

namespace App\Models\Messages;

use Illuminate\Http\Request;
use App\Models\Messages\Message;

class MessageService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeMessage($array)
  {
      return Message::Create([
        'message_content' => $array['message_content'],
        'sender_id' => $array['sender_id'],
        'receiver_id' => $array['receiver_id'],
        'broadcast' => $array['broadcast']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateMessage($id, $array)
  {
    $message = Message::find($id);
    foreach($array as $key => $value){
      $message->$key = $value;
    }
      $message->save();
      return $message;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyMessage($id)
  {
    Message::findOrFail($id)->delete();
    return 204;
  }

}
