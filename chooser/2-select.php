<?php

require '../env.php';

$shared = $_GET['shared'] ?? null;
if ( !$shared ) exit("Need ?shared link");

$path = $_GET['path'] ?? '';

$token = SHAR_TOKEN;
$options = [
	'path' => $path,
	'shared_link' => ['url' => $shared],
];
$cmd = "curl -X POST --header 'Authorization: Bearer $token' --header 'Content-Type: application/json' --data '" . json_encode($options) . "' https://api.dropboxapi.com/2/files/list_folder";
$json = shell_exec($cmd);
$data = json_decode($json, true);
if (!$data) {
	exit("ERROR: $json");
}

function html($string) {
	return htmlspecialchars($string);
}

function htmlurl($string) {
	return html(urlencode($string));
}

?>
<table border="1" cellpadding="10">
	<? foreach ($data['entries'] as $entry): ?>
		<tr>
			<th><?= htmlspecialchars($entry['name']) ?></th>
			<td><a href="./3-download.php?shared=<?= htmlurl($shared) ?>&id=<?= htmlurl($entry['id']) ?>&path=<?= htmlurl($path . '/' . $entry['name']) ?>">SELECT</a></td>
			<td>
				<? if ($entry['.tag'] == 'folder'): ?>
					<a href="?shared=<?= htmlurl($shared) ?>&path=<?= htmlurl($path . '/' . $entry['name']) ?>">Open</a>
				<? endif ?>
			</td>
		</tr>
	<? endforeach ?>
</table>

<details>
	<summary>Response</summary>
	<pre><? print_r($data) ?></pre>
</details>
