async function getMusicInfo(){
const url = `https://echoflow.gglvxd.net/api/song/?id=${id}`
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    console.log(result);
    changeTitle(result);
  } catch (error) {
    console.error(error.message);
  }
}

function changeTitle(data){
    let title = document.getElementById("title");
    const artistContainer = document.querySelector(".Artist");
    let songTitle = data["response"]["song"]["title"];
    let songAuthor = data["response"]["song"]["primary_artist"]["name"];
    console.log(songAuthor);
    title.innerHTML = `${songAuthor} Lyrics "${songTitle}"`;
    title.style.display = "initial";
    getLyrics(songAuthor, songTitle); // gets author and title for lyrics api

    if (artistContainer) {
      artistContainer.classList.add("loaded");
    }
}

