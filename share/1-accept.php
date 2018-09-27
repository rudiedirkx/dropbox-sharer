<?php

require '../env.php';

$token = SHAR_TOKEN;
$options = [
	'limit' => 100,
	'actions' => [],
];

// $cmd = "curl -X POST --header 'Authorization: Bearer $token' --header 'Content-Type: application/json' --data '" . json_encode($options) . "' https://api.dropboxapi.com/2/sharing/list_received_files";
$cmd = "curl -X POST --header 'Authorization: Bearer $token' --header 'Content-Type: application/json' --data '" . json_encode($options) . "' https://api.dropboxapi.com/2/sharing/list_mountable_folders";

$json = shell_exec($cmd);
$data = json_decode($json, true);
if (!$data) {
	exit("ERROR: $json");
}

echo '<pre>';
print_r($data);
