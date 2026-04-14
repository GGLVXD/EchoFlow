<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));
$id = $segments[1] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Search for songs by typing the lyrics you remember with EchoFlow.">
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
            <a href="/" class="title-text">EchoFlow</a>
        </div>
        <div class="header-nav">
            <a href="/" class="header-btn">Search Lyrics by Song</a>
            <a href="/findbylyrics/" class="header-btn">Search Song by Lyrics</a>
        </div>
    </div>
    <main>
        <div class="content">
            <div class="search-bar">
                <form id="findSongForm" class="input-group" action="/api/search/" method="get">
                    <input
                        id="lyricsInput"
                        name="q"
                        type="text"
                        class="form-control"
                        placeholder="Type song lyrics here..."
                        aria-label="Song lyrics"
                        required
                    >
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="category" style="display: none" id="category-container"></div>
    </main>
    <!-- Footer container -->
<div class="footer">
    <p>© 2026 <br> EchoFlow</p>
</div>

</body>
<script src="/js/findsong.js">
    
</script>
</html>
