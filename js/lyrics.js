async function getLyrics(artist, title) {
  const url = `https://echoflow.gglvxd.net/api/lyrics/?artist=${artist}&title=${title}`;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    let parsedResult = {"lyrics": result.lyrics.replace(/\r?\n/g, "<br>")};
    console.log(parsedResult);

    setLyrics(parsedResult);
  } catch (error) {
    console.error(error.message);
  }
}

function setLyrics(result){
    document.getElementById("lyrics").innerHTML = `${result["lyrics"]}`;
}