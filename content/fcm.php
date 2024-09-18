<?php
class FCM {
	function __construct() {
	}

	public function send_notification($row = array(), $deviceIds = array()) {
		global $server_url;
		opendb();
		$img = getRecordField($query = "select concat('{$server_url}', logo_imgpath) as logo_imgpath from site_settings where deleted=0");
		
		$serverKey = "AAAAUCgZhvc:APA91bG1wlmHXQO1EsxokAs76tFRaotpG4PurAIK7WNJlRY0K8qtB2Jks9UqTU6dg0PJmbMvh4Ev_nbnQeGzwHq46ltVCu00Sqd649F9LiMaJkDTldpKLzAz66-sGZSq_WVBCjccQej0";
		
		$url = "https://fcm.googleapis.com/fcm/send";
		$title = $row['title'];
		$body = $row['message'];

		$notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1', 'image' => @$img);
		// $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'priority' => 'high', 'data' => array('id' => $row['id']));
		
		$arrayToSend = array('registration_ids' => $deviceIds, 'notification' => $notification, 'priority' => 'high', 'data' => array('id' => $row['id']));
		
		$json = json_encode($arrayToSend);
		$headers = array('Content-Type: application/json', 'Authorization: key=' . $serverKey);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);

		if ($response === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $response;
	}
}
?>