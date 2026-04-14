<?php

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

// https://joshtronic.com/2021/07/18/setting-an-authorization-header-when-using-file-get-contents-with-php/
$url = 'https://lrclib.net/api/search?q=' . rawurlencode($query);
$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'ignore_errors' => true,
        'timeout' => 10,
    ],
]);

$data = @file_get_contents($url, false, $context);

if ($data === false) {
    http_response_code(502);
    echo json_encode(['error' => 'Failed to fetch lyrics search results']);
    exit;
}

json_decode($data, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(502);
    echo json_encode(['error' => 'Upstream lyrics response was not valid JSON']);
    exit;
}

echo $data;
?>