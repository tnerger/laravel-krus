# Datei: Dockerfile
FROM php:8.2-fpm

# Installiere Composer und notwendige PHP-Erweiterungen
RUN apt-get update && apt-get install -y unzip zip git \
    && docker-php-ext-install pdo pdo_mysql

# bcmath installieren
RUN docker-php-ext-install bcmath

# intsall PostgreSQL
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Composer hinzufügen
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . /app
# COPY ./laravel-kurs/storage ./app/laravel-kurs/storage
# COPY ./laravel-kurs/vendor ./app/laravel-kurs/vendor