<?php


//ALL YOUR IMPORTANT API INFO
$client_id = 'XXXXXXXXXX';
$client_secret = 'XXXXXXXXXX';
$object = 'tag';
$object_id = 'cutebaby';
$aspect = 'media';
$verify_token='';
$callback_url = 'http://yourdomain.com/path/to/callback.php';


//SETTING UP THE CURL SETTINGS...
$attachment =  array(
'client_id' => $client_id,
'client_secret' => $client_secret,
'object' => $object,
'object_id' => $object_id,
'aspect' => $aspect,
'verify_token' => $verify_token,
'callback_url'=>$callback_url
);

//URL TO THE INSTAGRAM API FUNCTION
$url = "https://api.instagram.com/v1/subscriptions/";

$ch = curl_init();

//EXECUTE THE CURL...
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output 
$result = curl_exec($ch);
curl_close ($ch);

//PRINT THE RESULTS OF THE SUBSCRIPTION, IF ALL GOES WELL YOU'LL SEE A 200
print_r($result);


?>