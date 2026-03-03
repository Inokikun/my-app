FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev nodejs npm \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

CMD php artisan serve --host=0.0.0.0 --port=8000
