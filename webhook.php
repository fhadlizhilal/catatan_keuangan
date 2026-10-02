<?php
header('Content-Type: application/json; charset=utf-8');

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$device = $data['device'];
$sender = $data['sender'];
$message = $data['message'];
$member= $data['member']; //group member who send the message
$name = $data['name'];
$location = $data['location'];
//data below will only received by device with all feature package
//start
$url =  $data['url'];
$filename =  $data['filename'];
$extension=  $data['extension'];
//end

function sendFonnte($target, $data) {
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.fonnte.com/send",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array(
	    	'target' => $target,
	    	'message' => $data['message'],
	    	'url' => $data['url'],
	    	'filename' => $data['filename'],
	    ),
	  CURLOPT_HTTPHEADER => array(
	    "Authorization: nfXHSdbBRQ4G7ciyR1t5"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}

if ( $message == "test" ) {
	$reply = [
		"message" => "oke berhasil!",
	];

} else {
	$reply = [
		"Sorry, gagal!",
];
}

sendFonnte($sender, $reply);