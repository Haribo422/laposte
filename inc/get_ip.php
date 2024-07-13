<?php
$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
$result  = "Unknown";
if(filter_var($client, FILTER_VALIDATE_IP)){
    $ip = $client;
}
elseif(filter_var($forward, FILTER_VALIDATE_IP)){
    $_SESSION['_ip_'] = $ip = $forward;
}
else{
    $_SESSION['_ip_'] = $ip = $remote;
}
?>
