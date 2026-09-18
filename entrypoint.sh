#!/bin/sh
set -e

echo "⏳ Waiting for database..."
# DB_HOST と DB_PORT が利用可能になるまで 1秒ごとにチェック
# nc (netcat) を使って接続を確認します
until nc -z -v -w3 "$DB_HOST" "${DB_PORT:-5432}"; do
  echo "Database is unavailable - waiting..."
  sleep 1
done

echo "🚀 Starting Laravel (No Nginx)..."

# キャッシュクリア
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# マイグレーション
php artisan migrate --force

# キャッシュ再生成（ここが重要）
php artisan config:cache
php artisan route:cache
php artisan view:cache

# サーバー起動
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
