<?php
include 'php/fetch.php';

?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Finder by Lyrics - EchoFlow</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/6887/6887372.png">
    <!-- Header css -->
    <link rel="stylesheet" href="css/header.css">
    <!-- pats content -->
    <link rel="stylesheet" href="css/content.css">
    <!-- global things -->
    <link rel="stylesheet" href="css/global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
     <!-- Content container -->
    <div class="content">
        <div class="search-bar">
            <div class="input-group">
                    <input id="suggestInput" type="text" class="form-control" placeholder="Search song..." aria-label="Search" aria-describedby="search-addon">
                    <button onclick="suggestInput()" class="btn btn-outline-secondary" type="button" id="search-addon" alt="search button">
                            Search
                    </button>
            </div>
        </div>
    </div>
        <div class="category" style="display: none" id="category-container">
        <!-- lyrics suggestions (auto replaced by js) -->
        </div>

<div class="Tutorial">
    <div class="tutorial-txt">
<p>Do you have a song stuck in your head? Maybe you only remember a part of the lyrics, like, “I’m looking for a song that goes like this.” This tool finds songs that contain the lyrics you remember!

The “Find Song by Lyrics” (or partial lyrics)  tool can help you figure it out and solve your earworm. It’s simple—no artist name required. Just type the few lyrics you know, and once you’re finished entering them, our tool will help identify potential song matches. Don’t worry, you don’t need perfect lyrics to use this tool.

Our tool uses Google search to show you the most likely options based on the lyrics. You can then select the best match and explore information about the song and artist. It will also provide the option to play the song via YouTube and/or Spotify. You can also click the song title link to go to the lyrics page.

You can also use this tool as a lyrics search engine to find lyrics for any song you want. Just type any artist, song, or lyric phrase.</p>
</div>
</div>

    </div>
    <!-- Footer container -->
    <div class="footer">
        <p>© 2026 <br> EchoFlow</p>
    </div>
    <script src="js/suggest.js"></script>
</body>
</html>
