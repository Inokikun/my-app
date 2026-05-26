#!/bin/sh
set -e

echo "🚀 Starting Laravel..."

php artisan config:clear
php artisan cache:clear

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/sites-available/default

php-fpm -D
nginx -g "daemon off;"
