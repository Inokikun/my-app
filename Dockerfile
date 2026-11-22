# Node.jsのビルド用
FROM node:24.22.1-bookworm-slim AS node-builder

WORKDIR /app

COPY backend/package*.json ./

RUN npm install -g npm@12.2.1 \
    && node -v \
    && npm -v

COPY backend/ .

RUN npm install && npm run build


# PHP + Nginx
FROM php:8.4.27-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql zip

WORKDIR /var/www

COPY backend/ .

# Composer 2.10.3を使用
COPY --from=composer:2.10.3 /usr/bin/composer /usr/bin/composer

RUN php -v \
    && composer --version

RUN composer install --no-dev --optimize-autoloader

# Node.js側で作ったビルド済みファイルをコピー
COPY --from=node-builder /app/public/build ./public/build

RUN chmod -R 775 storage bootstrap/cache

# Nginx設定
COPY backend/docker/nginx/default.conf /etc/nginx/sites-available/default

ENV PORT=10000

# entrypoint
COPY backend/docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
