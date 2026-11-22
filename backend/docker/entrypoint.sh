#!/bin/sh
set -e

echo "===== Nginx version ====="
nginx -v 2>&1

echo "===== Nginx package version ====="
dpkg-query -W -f='${Package} ${Version}\n' nginx nginx-common

echo "===== OS version ====="
cat /etc/os-release

echo "===== Nginx configuration test ====="
nginx -t

echo "🚀 Starting Laravel..."

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

php artisan migrate --force

php artisan config:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/sites-available/default

php-fpm -D
nginx -g "daemon off;"
