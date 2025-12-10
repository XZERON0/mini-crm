#!/bin/sh

echo "Waiting for database..."
sleep 10

php artisan optimize:clear 
php artisan config:cache 
php artisan route:cache
php artisan view:cache 

# Запускаем миграции
php artisan migrate --force

# Запускаем основной процесс
exec "$@"