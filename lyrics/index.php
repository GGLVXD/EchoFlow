<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));
$id = $segments[1] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Finder by Lyrics - EchoFlow</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Header css -->
    <link rel="stylesheet" href="/css/header.css">
    <!-- global things -->
    <link rel="stylesheet" href="/css/global.css">
    <!-- content css -->
     <link rel="stylesheet" href="/css/content.css">
    </head>
<body>
    <!-- Header container -->
    <div class="header-container shadow p-3 mb-5 rounded">
        <div class="title-container">
            <h1 class="title-text">EchoFlow</h1>
        </div>
        <div class="pfp">
        <img src="/assets/avatar.png" alt="avatar" height="50" width="75">
     </div>
    </div>
        <div class="Artist">
            <h1 id="title" style="display:none">Ella Langley Lyrics "Dandelion"</h1>
    </div>
<div class="Video">
   <iframe width="560" height="315" src="https://www.youtube.com/embed/sf6eRmInk1s?si=fhtQ9mBXLZzLMKCl" 
    title="YouTube video player" 
    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</iframe>
</div>
<div class="lyricstyt">
<p id="lyrics"></p>
</div>


</body>
<script src="/js/lyrics.js"></script>
<script>
    //getLyrics();
</script>
<script>
    const id = <?php echo json_encode($id); ?>;
</script>
<script src="/js/song.js"></script>
<script>
    getMusicInfo();
</script>
</html>
