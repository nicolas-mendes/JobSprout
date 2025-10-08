#!/bin/sh
set -e

echo "Step 1: Clearing old caches and creating new ones..."

php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Step 2: Fixing storage permissions..."

WEB_USER="www-data"
STORAGE_PATH="/app/storage"

chown -R $WEB_USER:$WEB_USER $STORAGE_PATH

chmod -R 775 $STORAGE_PATH

chmod -R 775 $PERSISTENT_STORAGE_PATH
echo "Permissions fixed."

echo "Step 3: Starting the application..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
