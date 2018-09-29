<?php

require '../env.php';

$shared = $_GET['shared'] ?? null;
if ( !$shared ) exit("Need ?shared link");

// $id = $_GET['id'] ?? null;
// if (!$id) exit("Need ?id");

$path = $_GET['path'] ?? null;
if (!$path) exit("Need ?path");

// echo $shared;

$token = SHAR_TOKEN;
$options = [
	'url' => $shared,
	'path' => $path,
];

// $cmd = "curl -X POST --header 'Authorization: Bearer $token' --header 'Content-Type: application/json' --data '" . json_encode($options) . "' https://api.dropboxapi.com/2/sharing/get_shared_link_metadata";
// echo "$cmd\n";
// $data = shell_exec($cmd);
// echo $data;

$cmd = "curl -X POST --header 'Authorization: Bearer $token' --header 'Dropbox-API-Arg: " . json_encode($options) . "' https://content.dropboxapi.com/2/sharing/get_shared_link_file";
// echo "$cmd\n";
$data = shell_exec($cmd);

header('Content-disposition: attachment; filename="' . urlencode(basename($path)) . '"');
echo $data;
