<?php
$url.= $_SERVER['REQUEST_URI'];
$ok=parse_url($url, PHP_URL_PATH);

echo $ok;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Header css -->
    <link rel="stylesheet" href="/css/header.css">
    <!-- global things -->
    <link rel="stylesheet" href="/css/global.css">
    </head>
<body>
    <!-- Header container -->
    <div class="header-container shadow p-3 mb-5 rounded">
        <div class="title-container">
            <h1 class="title-text"> SuperEpisksLyricsMeklētajs </h1>
        </div>
        <div class="pfp">
        <img src="/assets/avatar.png" height="50" width="75">
     </div>
    </div>
</body>
</html>