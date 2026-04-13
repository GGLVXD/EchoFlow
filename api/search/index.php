<?php
$envPath = dirname(__DIR__, 2) . '/.env';
$env = parse_ini_file($envPath, false, INI_SCANNER_RAW);


$apiKey = $env['GENIUS_KEY'];
header("Content-Type: application/json");
//fix later
if(!$_GET['q']){
    echo json_encode(array(error => "please provide a search query using q parameter",));
}

$query=$_GET['q'];  

// https://joshtronic.com/2021/07/18/setting-an-authorization-header-when-using-file-get-contents-with-php/
$options  = ['http' => ['header' => "Authorization: Bearer $apiKey"]];
$context  = stream_context_create($options);
$data = file_get_contents("https://api.genius.com/search?q=$query", false, $context);

if (json_validate($data)){
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$lyrics = json_decode($data, true);
}} else {
    echo "fuckoff";
} 
echo $data;
?>