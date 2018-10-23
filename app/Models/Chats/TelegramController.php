<?php

namespace App\Models\Chats;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TelegramController extends Controller
{
    // public function index()
    // {
    //     $users = User::where('id', '!=', Auth::id())->get();
    //     return view('layouts.telegram', ['users' => $users]);
    // }

    public function send(Array $array) {

        // $array = array([[2,3,4],[["Task 1,This is Daniel's task 1", "Task 2,This is Daniel's task 2"],["Task 3,This is Jihoon's task 3"],["Task 4,This is Seongwu's task 4"]]]);
        // $array = array([[5,6],[["Task 1,This is my task 1", "Task 2,This is my task 2"], ["Task 1,This is my task 1", "Task 2,This is my task 2"]]]);

        $apiToken = "634750556:AAGSwjVz0FjbzQrwoHNtZTxk18-i5WsJWPI";

        for ($i=0; $i<sizeof($array[0][0]); $i++) {
            $userid = $array[0][0][$i];
            $user_teleid = User::where('id', $userid)->pluck('tele_id')->first();

            $messageArr = $array[0][1][$i];
            $message = "";

            for ($j=0; $j<sizeof($messageArr); $j++) {
                $messageStr = $messageArr[$j];
                
                $index = strrpos($messageStr, ",");
                $messageTask = substr($messageStr, 0, $index);
                $messageDesc = substr($messageStr, $index+1);
                
                if ($j == 0) {
                    $message = $messageTask . "\n" . $messageDesc;
                } else {
                    $message .= "\n\n" . $messageTask . "\n" . $messageDesc;
                }
            }
            $data = [
                'chat_id' => $user_teleid,
                'text' => $message
            ];

            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
        }
    }
}