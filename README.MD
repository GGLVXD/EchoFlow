# About

EchoFlow is a small PHP lyric search site. It provides a homepage for searching songs by lyrics, a lyrics page, and supporting API routes.

## Features

- Search for songs by lyrics
- View lyrics and song details
- Use simple PHP pages and API endpoints

## Nginx configuration

If you are serving the app with nginx, add this route for the lyrics page:

```nginx
location /lyrics/ {
	try_files $uri $uri/ /lyrics/index.php?$query_string;
}
```

## .env configuration
get your genius api from genius docs at https://docs.genius.com/