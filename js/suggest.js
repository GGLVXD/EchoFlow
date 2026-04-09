async function suggestInput(){

let query = document.getElementById("suggestInput").value;


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
  const url = "https://api.lyrics.ovh/suggest/"+query;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    sendData(result);
  } catch (error) {
    console.error(error.message);
  }
}

function sendData(data){
    let container = document.getElementById("category-container");
    console.log(data);
    container.innerHTML = 
    `
    <div class="song-container">
        <div class="song-title-container">
            <a target="_blank" href="https://selm.gglvxd.net/lyrics/${data["data"][0]["artist"]["name"]}/${data["data"][0]["title"]}">${data["data"][0]["title"]} <i class="fas fa-external-link-alt"></i></a>
        </div>
        <div class="line">
            <div class="image-container">
                <img class="song-image" src="${data["data"][0]["album"]["cover"]}" width="100" height="100">
            </div>
        </div>
    </div>
    `
}