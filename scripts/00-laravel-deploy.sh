#!/usr/bin/env bash
set -e

echo "=== Desplegando Laravel en Render ==="

# Permisos para storage, bootstrap/cache y database
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Si se usa SQLite y no existe el archivo, crearlo
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        echo "Creando base de datos SQLite..."
        touch /var/www/html/database/database.sqlite
        chmod 777 /var/www/html/database/database.sqlite
    fi
fi

echo "Optimizando dependencias Composer..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Limpiando y cacheando configuración..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Ejecutando migraciones de base de datos..."
php artisan migrate --force

# Poblar con los datos iniciales si la tabla de proformas está vacía
echo "Verificando datos iniciales..."
php artisan db:seed --class=ImportFromSqlSeeder --force

echo "=== Despliegue completado con éxito ==="
