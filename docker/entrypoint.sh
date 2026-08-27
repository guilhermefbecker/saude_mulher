#!/bin/bash
set -e

echo "Aguardando MySQL ficar disponível..."
until php -r "new PDO('mysql:host=$DB_HOST;port=$DB_PORT', '$DB_USERNAME', '$DB_PASSWORD');" 2>/dev/null; do
  sleep 2
done
echo "MySQL disponível!"

if [ -z "$(grep '^APP_KEY=.' .env 2>/dev/null)" ]; then
  php artisan key:generate
fi

php artisan storage:link || true

# Só popula o banco se ele ainda estiver vazio (evita duplicar dados a cada restart)
TABLE_COUNT=$(php artisan tinker --execute="echo count(\DB::select('SHOW TABLES'));" 2>/dev/null | tail -n 1)

php artisan migrate --force

if [ "$TABLE_COUNT" = "0" ]; then
  echo "Banco vazio, rodando seeders..."
  php artisan db:seed --force
else
  echo "Banco já populado, pulando seeders."
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
