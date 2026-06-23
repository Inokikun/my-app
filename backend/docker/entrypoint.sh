#!/bin/sh

echo "🚀 Starting Laravel..."

# キャッシュクリア（安全）
php artisan config:clear
php artisan cache:clear

# マイグレーション
php artisan migrate --force

# キャッシュ生成（ここが重要）
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Nginxポート変更
sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/sites-available/default

# 起動
php-fpm -D
nginx -g "daemon off;"
