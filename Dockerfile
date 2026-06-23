FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    git unzip libzip-dev nodejs npm libpq-dev \
    && docker-php-ext-install pdo_pgsql zip

WORKDIR /var/www

COPY backend/ .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN chmod -R 775 storage bootstrap/cache

# Nginx設定
COPY backend/docker/nginx/default.conf /etc/nginx/sites-available/default

ENV PORT=10000

# 👇 ここ変更
COPY backend/docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
