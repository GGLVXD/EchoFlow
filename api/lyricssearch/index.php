<?php

header("Content-Type: application/json");
//fix later
if(!$_GET['q']){
    echo json_encode(array(error => "please provide a search query using q parameter",));
}

$query=$_GET['q'];  

// https://joshtronic.com/2021/07/18/setting-an-authorization-header-when-using-file-get-contents-with-php/
$data = file_get_contents("https://lrclib.net/api/search?q=$query");

echo $data;
?>