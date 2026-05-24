FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    git unzip libzip-dev nodejs npm libpq-dev \
    && docker-php-ext-install pdo_pgsql zip

WORKDIR /var/www

# ここはそのまま維持（重要）
COPY backend/ .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN php artisan config:cache \
  && php artisan route:cache \
  && php artisan view:cache

RUN chmod -R 777 storage bootstrap/cache

# Nginx設定
COPY backend/docker/nginx/default.conf /etc/nginx/sites-available/default

# Render対応
ENV PORT=10000

CMD php artisan migrate --force && \
    php-fpm -D && \
    sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/sites-available/default && \
    nginx -g "daemon off;"
