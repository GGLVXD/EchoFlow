<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$artist = $_GET['artist'];
$title = $_GET['title'];

header("Content-Type: application/json");

$artist = rawurlencode($artist);
$title = rawurlencode($title);
$url = "https://api.lyrics.ovh/v1/{$artist}/{$title}";

$context = stream_context_create([
	'http' => [
		'method' => 'GET',
		'ignore_errors' => true,
		'timeout' => 10,
	],
]);

$data = @file_get_contents($url, false, $context);

echo $data;
?>