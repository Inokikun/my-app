FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev nodejs npm libpq-dev \
    && docker-php-ext-install pdo_pgsql zip

WORKDIR /var/www

COPY backend/ .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

# RUN php artisan config:cache \
 # && php artisan route:cache \
 # && php artisan view:cache

RUN chmod -R 777 storage bootstrap/cache

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
