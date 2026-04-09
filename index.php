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
    <div class="header-container">
        <div class="title-container">
            <h1 class="title-text">EchoFlow</h1>
        </div>
        <div class="pfp">
         <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/500px-Default_pfp.svg.png" height="50" width="75">
     </div>
    </div>
     <!-- Content container -->
    <div class="content">
        <div class="search-bar">
        <div class="input-group">
                <input id="suggestInput" type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="search-addon">
                <button onclick="suggestInput()" class="btn btn-outline-secondary" type="button" id="search-addon">
                        <i class="fas fa-search"></i>
                </button>
        </div>
    </div>
        <div class="category" " id="category-container">
           <div class="song-container">
                <div class="song-title-container">
                    <a target="_blank" href="https://www.lyrics.com/lyrics/kkk">KKK Lyrics <i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="line">
                    <div class="song-text-container">
                        <p class="song-text">A list of lyrics, artists and songs that contain the term "kkk" - from the Lyrics.com
                        website ... The KKK Took My Baby Away · Ramones · Ramones Mania · 1988. But ...</p>
                        <audio controls>
                            <source src="https://www.w3schools.com/html/tryit.asp?filename=tryhtml5_audio_all" type="audio/mpeg">
</audio>
                    </div>
                    <div class="image-container">
                        <img class="song-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmDH5xDbteImo7QQTXxhHDQmgRpkY1umPYRfDTYKyE2-tpTp0A-Czd7A&s" width="100" height="100">
                    </div>
                </div>
            </div>


        </div>

        <div class="lyrics-text">
            <p class="lyrics-text"><?php echo $lyrics["message"]["lyrics"]; ?></p>
    </div>
    </div>
    <!-- Footer container -->
    <div class="footer">
        <p>© 2026 <br> EchoFlow</p>
</div>
    <script src="js/suggest.js"></script>
</body>
</html>
