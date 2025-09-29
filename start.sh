#!/bin/sh
set -e

echo "Removing old storage link if it exists..."
rm -f public/storage

echo "Linking persistent storage..."
php artisan storage:link

echo "Starting web server..."
heroku-php-nginx -C nginx.conf public/