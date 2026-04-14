const form = document.getElementById("findSongForm");
const input = document.getElementById("lyricsInput");
const container = document.getElementById("category-container");

if (form && input && container) {
	form.addEventListener("submit", async (event) => {
		event.preventDefault();

		const query = input.value.trim();
		if (!query) {
			return;
		}

		await searchSongs(query);
	});
}

async function searchSongs(query) {
	try {
		const [searchResponse, lyricsResponse] = await Promise.all([
			fetch(`/api/search/?q=${encodeURIComponent(query)}`),
			fetch(`/api/lyricssearch/?q=${encodeURIComponent(query)}`),
		]);

		if (!searchResponse.ok) {
			throw new Error(`Request failed: ${searchResponse.status}`);
		}

		const data = await searchResponse.json();
		const lyricsMatches = lyricsResponse.ok ? await lyricsResponse.json() : [];
		renderResults(data, query, lyricsMatches);
	} catch (error) {
		renderError(error.message);
	}
}

function renderResults(data, query, lyricsMatches) {
	container.style.display = "grid";
	container.innerHTML = "";

	const hits = data?.response?.hits || [];
	if (hits.length === 0) {
		renderError("No songs found for that lyrics search.");
		return;
	}

	for (const hit of hits) {
		const song = hit.result;
		const songId = song?.id;
		const title = song?.title || "Unknown title";
		const artist = song?.primary_artist?.name || song?.artist_names || "Unknown artist";
		const image = song?.song_art_image_url || "";
		const lyricSnippet = findMatchingLyricSnippet(song, query, lyricsMatches);

		const card = document.createElement("div");
		card.className = "song-container";

		card.innerHTML = `
			<div class="song-text-container">
				<div class="song-title-container">
					<a href="/lyrics/${songId}">${escapeHtml(title)}</a>
				</div>
				<div class="song-author-container">
					<p class="song-author">${escapeHtml(lyricSnippet || artist)}</p>
				</div>
			</div>
			<div class="image-container">
				<img class="song-image" src="${image}" alt="${escapeHtml(title)} cover" width="100" height="100">
			</div>
		`;

		container.appendChild(card);
	}
}

function findMatchingLyricSnippet(song, query, lyricsMatches) {
	if (!Array.isArray(lyricsMatches) || lyricsMatches.length === 0) {
		return "";
	}

	const songTitle = normalizeText(song?.title || "");
	const songArtist = normalizeText(song?.primary_artist?.name || song?.artist_names || "");

	let bestMatch = null;
	for (const item of lyricsMatches) {
		const itemTitle = normalizeText(item?.trackName || item?.name || "");
		const itemArtist = normalizeText(item?.artistName || "");
		const titleMatches = itemTitle && (itemTitle.includes(songTitle) || songTitle.includes(itemTitle));
		const artistMatches = itemArtist && (itemArtist.includes(songArtist) || songArtist.includes(itemArtist));

		if (titleMatches && artistMatches) {
			bestMatch = item;
			break;
		}
		if (titleMatches && !bestMatch) {
			bestMatch = item;
		}
	}

	if (!bestMatch) {
		bestMatch = lyricsMatches[0];
	}

	return buildLyricSnippet(bestMatch?.plainLyrics || bestMatch?.syncedLyrics || "", query);
}

function buildLyricSnippet(lyricsText, query) {
	const text = String(lyricsText || "").replace(/\s+/g, " ").trim();
	if (!text) {
		return "";
	}

	const loweredText = text.toLowerCase();
	const loweredQuery = String(query || "").trim().toLowerCase();
	const index = loweredQuery ? loweredText.indexOf(loweredQuery) : -1;

	if (index === -1) {
		return text.length > 120 ? `${text.slice(0, 120)}...` : text;
	}

	const start = Math.max(0, index - 45);
	const end = Math.min(text.length, index + loweredQuery.length + 45);
	let snippet = text.slice(start, end).trim();

	if (start > 0) {
		snippet = `...${snippet}`;
	}
	if (end < text.length) {
		snippet = `${snippet}...`;
	}

	return snippet;
}

function normalizeText(value) {
	return String(value || "")
		.toLowerCase()
		.normalize("NFD")
		.replace(/[\u0300-\u036f]/g, "")
		.replace(/[^a-z0-9\s]/g, " ")
		.replace(/\s+/g, " ")
		.trim();
}

function renderError(message) {
	container.style.display = "grid";
	container.innerHTML = "";

	const errorCard = document.createElement("div");
	errorCard.className = "song-container";
	errorCard.textContent = message;
	container.appendChild(errorCard);
}

function escapeHtml(value) {
	return String(value)
		.replaceAll("&", "&amp;")
		.replaceAll("<", "&lt;")
		.replaceAll(">", "&gt;")
		.replaceAll('"', "&quot;")
		.replaceAll("'", "&#039;");
}
