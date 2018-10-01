<?php  
//$apiToken = "bot652962825:AAFexYdPOYcTDrwPqfdcmoaa5gMY5glydo8";
$apiToken = "646565944:AAHvKXAgt7fX6Afr1x7tauNIpoVtUUZS2pI";

$data = [
    //'chat_id' => '-1001354646507',
	//'chat_id' => '254696958',
	'chat_id' => '200084753',
    'text' => 'Hello JiaJia!'
];

$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
// Do what you want with result
