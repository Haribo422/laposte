<?php

function toTG($msg, $chat, $token){
// telegram

$encoded = urlencode($msg);
$url = "https://api.telegram.org/bot$token/sendMessage?chat_id=-$chat&text=$encoded";

if(function_exists('file_get_contents')){
	file_get_contents($url);
}else{
$ch = curl_init();

//Set the URL that you want to GET by using the CURLOPT_URL option.
curl_setopt($ch, CURLOPT_URL, $url );

//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//Execute the request.
$data = curl_exec($ch);

//Close the cURL handle.
curl_close($ch);
}
}

?>