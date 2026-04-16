<?php
$envPath = dirname(__DIR__, 2) . '/.env';
$env = parse_ini_file($envPath, false, INI_SCANNER_RAW);
require_once __DIR__ . '/../../redis.php';

$redis = getRedisClient();

$apiKey = $env['GENIUS_KEY'] ?? '';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$query = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
if ($query === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Please provide a search query using q parameter']);
    exit;
}

if ($apiKey === '') {
    http_response_code(500);
    echo json_encode(['error' => 'Server is missing API key configuration']);
    exit;
}

$cacheKey = 'search:' . md5($query);
try {
    $cached = $redis->get($cacheKey);
    if ($cached !== null) {
        echo $cached;
        exit;
    }
} catch (Exception $e) {
}

// https://joshtronic.com/2021/07/18/setting-an-authorization-header-when-using-file-get-contents-with-php/
$url = 'https://api.genius.com/search?q=' . rawurlencode($query);
$options  = [
    'http' => [
        'header' => "Authorization: Bearer $apiKey",
        'ignore_errors' => true,
        'timeout' => 10,
    ],
];
$context  = stream_context_create($options);
$data = @file_get_contents($url, false, $context);

if ($data === false) {
    http_response_code(502);
    echo json_encode(['error' => 'Failed to fetch search results from Genius']);
    exit;
}

json_decode($data, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(502);
    echo json_encode(['error' => 'Upstream response was not valid JSON']);
    exit;
}

try {
    $redis->setex($cacheKey, 259200, $data); // 3 days
} catch (Exception $e) {
}

echo $data;
?>