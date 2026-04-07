<?php
$data = file_get_contents("https://api.popcat.xyz/v2/lyrics?song=aaa");
$lyrics = json_decode($data, true);
?>