<?php

namespace App\Models\Chats;

use App\Models\Users\User;
use App\Models\Clients\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TelegramService
{
    public function send($array) {
        $apiToken = "634750556:AAGSwjVz0FjbzQrwoHNtZTxk18-i5WsJWPI";

        $companyArr = array();
        $companies = Company::all();
        foreach ($companies as $company) {
            $id = $company['id'];
            $name = $company['name'];
            $companyArr[$id] = $name;
        }

        $userids = $array[0];
        for ($i=0; $i<sizeof($userids); $i++) {
            $userid = $userids[$i];
            $user_teleid = User::where('id', $userid)->pluck('tele_id')->first();

            $messageArr = $array[1][$i];
            $message = "Task(s) to be done:\n\n";

            for ($j=0; $j<sizeof($messageArr); $j++) {
                $messageStr = $messageArr[$j];

                $index = strrpos($messageStr, ",");
                $companyId = substr($messageStr, 0, $index);
                $companyName = $companyArr[$companyId];
                $messageDesc = substr($messageStr, $index+1);

                if ($j == 0) {
                    $message .= "" .$companyName . ":\n" . $messageDesc;
                } else {
                    $message .= "\n\n" .$companyName . ":\n" . $messageDesc;
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
