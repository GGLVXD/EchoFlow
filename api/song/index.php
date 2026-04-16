<?php
$envPath = dirname(__DIR__, 2) . '/.env';
$env = parse_ini_file($envPath, false, INI_SCANNER_RAW);
require_once __DIR__ . '/../../redis.php';


$apiKey = $env['GENIUS_KEY'];
header("Content-Type: application/json");

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if ($id === '') {
	http_response_code(400);
	echo json_encode([
		'error' => 'missing parameters: id',
	]);
	exit;
}


$cacheKey = 'song:' . $id;
try {
	$cached = $redis->get($cacheKey);
	if ($cached !== null) {
		echo $cached;
		exit;
	}
} catch (Exception $e) {
}

$options  = ['http' => ['header' => "Authorization: Bearer $apiKey"]];
$context  = stream_context_create($options);
$data = file_get_contents("https://api.genius.com/songs/$id", false, $context);

try {
	$redis->setex($cacheKey, 259200, $data);
} catch (Exception $e) {
}


echo $data;
?>