
let cache =0;


async function suggestInput(){

let query = document.getElementById("suggestInput").value;
let input = document.getElementById("suggestInput");


if(query==""){
    alert("lūdzu ievadi kautko");
    container.styles.display === "none";
}

let container = document.getElementById("category-container");
  if (container.style.display === "none") {
    container.style.display = "block";
  }

  getData()
}

// https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
async function getData() {
let query = document.getElementById("suggestInput").value;
  const url = "/api/search/?q=" + encodeURIComponent(query);
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    console.log(result);
    sendData(result);
  } catch (error) {
    console.error(error.message);
  }
}

function sendData(data){
  let query = document.getElementById("suggestInput").value;
    if(cache == 0){ // no cache
      createElements(data);
    } else {
      nukeData()
      console.log(query)
      createElements(data);
    }
}

function createElements(data) {
    let container = document.getElementById("category-container");
  for(let i = 0;i < data.response.hits.length;i++){
      let newdiv = document.createElement("div");
      cache = cache+1;
      // give id to element
      newdiv.setAttribute('id', i);
      newdiv.innerHTML =
      `
            <div class="song-container">
          <div class="song-text-container">
            <div class="song-title-container">
              <a target="_blank" href="/lyrics/${data["response"]["hits"][i]["result"]["id"]}">${data["response"]["hits"][i]["result"]["title"]}<i class="fas fa-external-link-alt"></i></a>
            </div>
                      <div class="song-author-container">
                          <p class="song-author">
                              <a>${data["response"]["hits"][i]["result"]["primary_artist"]["name"]}</a>
                          </p>
                      </div>
          </div>
          <div class="image-container">
            <img class="song-image" src="${data["response"]["hits"][i]["result"]["song_art_image_url"]}" width="100" height="100">
                  </div>
              </div>
      `
      container.appendChild(newdiv);
}}

function nukeData(){
  for(let i=0;i<cache;i++){
    let getelement = document.getElementById(i);
    getelement.remove();
    console.log("nuked "+i);
  }
  cache=0;
}

document.getElementById("suggestInput").addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    suggestInput();
  }
});