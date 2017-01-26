<?php
$access_token = 'cfU15GwvrYNUOioyXmwhLJwH3ZVY4AXJ/QOA3wUGUQOTA3+c0e8EF8xmpgHfWfDWY+U7OYH617tnEdeeCb1HoBnpiUzaY9chA+RI4R72t1Hdhgfe4Ckn3UNkj7ibJ88R9egyWxj6D9rT8uHSHGdIbAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$text_ex = explode('!', $text);
			if($text_ex[0]== "cal")
			{
				$res = $text_ex[1];
				$messages = [
				'type' => 'text',
				'text' => $res
				];
			}
			else {
				$res = 'Wrong Command';
				$messages = [
				'type' => 'text',
				'text' => $res
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
