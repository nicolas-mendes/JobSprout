#!/bin/sh
set -e

# Assumindo que seu volume persistente está montado em /app/storage
# Se for diferente, ajuste este caminho.
PERSISTENT_STORAGE_PATH="/app/storage"
WEB_USER="www-data"

echo "Step 1: Optimizing Laravel..."
# Limpa caches antigos e cria novos para garantir que a nova config de filesystem seja lida.
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Step 2: Linking storage..."
# Força a criação do link simbólico padrão do Laravel.
# Ele cria /app/public/storage -> /app/storage/app/public
php artisan storage:link --force
echo "Symbolic link created."

echo "Step 3: Fixing permissions for persistent storage at $PERSISTENT_STORAGE_PATH..."
# Garante que o diretório onde as logos serão salvas exista.
mkdir -p $PERSISTENT_STORAGE_PATH/app/public/logos

# Define o dono de TODA a pasta de armazenamento para o usuário do servidor web.
chown -R $WEB_USER:$WEB_USER $PERSISTENT_STORAGE_PATH

# Define permissões seguras e funcionais para toda a pasta.
chmod -R 775 $PERSISTENT_STORAGE_PATH
echo "Permissions fixed."

echo "Step 4: Starting the application..."
# O restante do seu script permanece o mesmo.
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
