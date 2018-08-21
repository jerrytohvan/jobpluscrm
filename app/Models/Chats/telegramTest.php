<?php  
$apiToken = "bot652962825:AAFexYdPOYcTDrwPqfdcmoaa5gMY5glydo8";

$data = [
    'chat_id' => '-1001354646507',
    'text' => 'Hello world!'
];

$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
// Do what you want with result
