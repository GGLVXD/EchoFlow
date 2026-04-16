<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$artist = $_GET['artist'];
$title = $_GET['title'];
require_once __DIR__ . '/../../redis.php';

header("Content-Type: application/json");


$cacheKey = 'lyrics:' . md5($artist . '|' . $title);
try {
	$cached = $redis->get($cacheKey);
	if ($cached !== null) {
		echo $cached;
		exit;
	}
} catch (Exception $e) {
}


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

try {
	$redis->setex($cacheKey, 259200, $data);
} catch (Exception $e) {
}

echo $data;
?>