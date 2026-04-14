async function getMusicInfo(){
const url = `/api/song/?id=${encodeURIComponent(id)}`
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    console.log(result);
    changeTitle(result);
    updateVideo(result);
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

function updateVideo(data) {
    const videoContainer = document.querySelector(".Video");
    const videoFrame = videoContainer ? videoContainer.querySelector("iframe") : null;

    if (!videoContainer || !videoFrame) {
      return;
    }

    const mediaList = data?.response?.song?.media || [];
    const youtubeMedia = mediaList.find((item) => item.provider === "youtube" && item.url);

    if (!youtubeMedia) {
      videoContainer.style.display = "none";
      return;
    }

    const videoId = getYouTubeVideoId(youtubeMedia.url);
    if (!videoId) {
      videoContainer.style.display = "none";
      return;
    }

    videoFrame.src = `https://www.youtube.com/embed/${videoId}`;
    videoContainer.style.display = "block";
}

function getYouTubeVideoId(url) {
    try {
      const parsed = new URL(url);

      if (parsed.hostname.includes("youtu.be")) {
        return parsed.pathname.replace("/", "") || null;
      }

      if (parsed.searchParams.get("v")) {
        return parsed.searchParams.get("v");
      }

      const parts = parsed.pathname.split("/").filter(Boolean);
      const embedIndex = parts.indexOf("embed");
      if (embedIndex !== -1 && parts[embedIndex + 1]) {
        return parts[embedIndex + 1];
      }

      const shortsIndex = parts.indexOf("shorts");
      if (shortsIndex !== -1 && parts[shortsIndex + 1]) {
        return parts[shortsIndex + 1];
      }

      return null;
    } catch (e) {
      return null;
    }
}

