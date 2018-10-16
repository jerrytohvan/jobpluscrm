<?php

namespace App\Models\Chats;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TelegramService
{
    public function send($array) {
        $apiToken = "634750556:AAGSwjVz0FjbzQrwoHNtZTxk18-i5WsJWPI";

        $userids = $array[0];
        error_log(print_r(sizeof($userids), true));
        for ($i=0; $i<sizeof($userids); $i++) {
            error_log(print_r(sizeof($userids), true));
            $userid = $userids[$i];
            $user_teleid = User::where('id', $userid)->pluck('tele_id')->first();
            if($user_teleid != null){
                $messageArr = $array[1][$i];
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
}
