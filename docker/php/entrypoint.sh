#!/bin/sh

# Ждем базу данных
echo "Waiting for database..."
sleep 10  # Просто ждем 10 секунд вместо сложных проверок

# Оптимизация Laravel
# php artisan optimize
# php artisan config:cache
# php artisan route:cache
# php artisan view:cache

# Запускаем миграции (только если их еще нет)
php artisan migrate --force

# Запускаем основной процесс
exec "$@"