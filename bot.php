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
			if($text_ex[0] == "cal" || $text_ex[0] == "Cal" )
			{
				$x = $text_ex[1];
				$res = eval('return '.$x.';');
				
				$messages = [
				'type' => 'text',
				'text' => $res
				];
			}
			if($text_ex[0] == "gacha" || $text_ex[0] == "Gacha"){
for($i=0; $i<=1;$i++){
$gacha_list = array(
    	'1' => array( 'name' => 'Artoria Pendragon [SSR]', 'rate' => 1 )
   	,'2' => array( 'name' => 'Artoria Pendragon (Alter) [SR]', 'rate' => 3 )
   	,'3' => array( 'name' => 'Nero Claudius [SR]', 'rate' => 3 )
   	,'4' => array( 'name' => 'Siegfried [SR]', 'rate' => 3 )
	,'5' => array( 'name' => 'Julius Caesar [R]', 'rate' => 40 )
	,'6' => array( 'name' => 'Attila [SSR]', 'rate' => 1 )
	,'7' => array( 'name' => 'Gilles de Rais (Saber) [R]', 'rate' => 40 )
	,'8' => array( 'name' => 'Le Chevalier dEon [SR]', 'rate' => 3 )
	,'9' => array( 'name' => 'Okita Souji [SSR Limited]', 'rate' => 0.1 )
	,'10' => array( 'name' => 'Fergus Mac Roich [R]', 'rate' => 40 )
	,'11' => array( 'name' => 'Mordred [SSR]', 'rate' => 1 )
	,'12' => array( 'name' => 'Nero Claudius (Bride) [SSR Limited]', 'rate' => 0.1 )
	,'13' => array( 'name' => 'Ryougi Shiki (Saber) [SSR Limited]', 'rate' => 0.1 )
	,'14' => array( 'name' => 'Rama [SR]', 'rate' => 3 )
	,'15' => array( 'name' => 'Lancelot (Saber) [SR]', 'rate' => 3 )
	,'16' => array( 'name' => 'Gawain [SR]', 'rate' => 3 )
	,'17' => array( 'name' => 'Bedivere [R]', 'rate' => 40 )
	,'18' => array( 'name' => 'Miyamoto Musashi [SSR Limited]', 'rate' => 0.1 )
	
	
);
$total_rate = 0;
foreach ( $gacha_list as $id => $v ) {
    if ( is_int($v['rate']) && $v['rate'] > 0 ) {
        $total_rate += $v['rate'];
        $list[$id]['range_end'] = $total_rate;
    }
}
$index = mt_rand( 1, $total_rate );
foreach ( $list as $id => $v ) {
    if ( $index <= $v['range_end'] ) {
        $hit_id    = $id;
        break;
    }
}
	$res= sprintf( 'Get ID: %s - Name: %s', $hit_id, $gacha_list[$hit_id]['name'] );

}

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
