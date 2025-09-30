#!/bin/sh
set -e

echo "Step 1: Creating symbolic link for persistent storage..."
rm -f /app/public/storage
ln -s /var/lib/data/public /app/public/storage
echo "Symbolic link created."

CURRENT_USER=$(whoami)
echo "Step 2: Running as user '$CURRENT_USER'. Fixing permissions for /var/lib/data/public..."

chown -R $CURRENT_USER:$CURRENT_USER /var/lib/data/public


echo "Step 3: Starting the application..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
