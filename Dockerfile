FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev nodejs npm libpq-dev \
    && docker-php-ext-install pdo_pgsql zip

WORKDIR /var/www

COPY backend/ .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

# キャッシュはbuildでやらない
RUN chmod -R 775 storage bootstrap/cache

# entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
