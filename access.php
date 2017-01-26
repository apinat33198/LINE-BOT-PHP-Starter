<?php
$access_token = 'cfU15GwvrYNUOioyXmwhLJwH3ZVY4AXJ/QOA3wUGUQOTA3+c0e8EF8xmpgHfWfDWY+U7OYH617tnEdeeCb1HoBnpiUzaY9chA+RI4R72t1Hdhgfe4Ckn3UNkj7ibJ88R9egyWxj6D9rT8uHSHGdIbAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
