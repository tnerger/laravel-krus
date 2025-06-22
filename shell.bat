@echo off
docker run -it --rm -v "$(pwd)":/app -w /app mein-php-container bash

docker compose exec app bash