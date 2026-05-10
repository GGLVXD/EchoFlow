async function getLyrics(artist, title) {
  const url = `/api/lyrics/?artist=${encodeURIComponent(artist)}&title=${encodeURIComponent(title)}`;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    let lyricsText = "No lyrics found";

    if (typeof result?.error === "string" && result.error.toLowerCase() === "no lyrics found") {
      lyricsText = "No lyrics found on lyrics.ovh";
    } else if (typeof result?.lyrics === "string") {
      lyricsText = result.lyrics.replace(/\r?\n/g, "<br>");
    }

    const parsedResult = { lyrics: lyricsText };
    console.log(parsedResult);

    setLyrics(parsedResult);
  } catch (error) {
    console.error(error.message);
  }
}

function setLyrics(result){
    document.getElementById("lyrics").innerHTML = `${result["lyrics"]}`;
    const lyricsContainer = document.querySelector(".lyrics-container");
    if (lyricsContainer) {
      lyricsContainer.classList.add("loaded");
    }
}
