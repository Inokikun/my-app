#!/bin/sh
set -e

echo "🚀 Starting Laravel (No Nginx)..."

# マイグレーション
php artisan migrate --force

# キャッシュクリア
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# キャッシュ再生成（ここが重要）
php artisan config:cache
php artisan route:cache
php artisan view:cache

# サーバー起動
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
