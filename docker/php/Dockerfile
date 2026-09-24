FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    nodejs npm \
 && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
