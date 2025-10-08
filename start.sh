#!/bin/sh
set -e

# --- ETAPA 1: PREPARAR O LARAVEL ---
echo "Step 1: Caching configuration and creating storage link..."

# Opcional, mas recomendado para produção.
php artisan config:cache
php artisan route:cache

# Cria o link simbólico da maneira correta do Laravel.
# O '--force' recria o link se ele já existir, substituindo 'rm' e 'ln'.
php artisan storage:link --force

# --- ETAPA 2: CORRIGIR PERMISSÕES (ESSENCIAL) ---
echo "Step 2: Fixing storage permissions..."

WEB_USER="www-data"
# Define o caminho real do armazenamento que precisa de permissões
STORAGE_PATH="/app/storage"

# Garante que o usuário do servidor web ('www-data') seja o dono
# de toda a pasta de armazenamento para poder escrever arquivos, logs, cache, etc.
chown -R $WEB_USER:$WEB_USER $STORAGE_PATH

# Define permissões funcionais e seguras para toda a pasta de armazenamento.
# 775 = Dono e grupo podem ler/escrever/executar, outros podem apenas ler/executar.
chmod -R 775 $STORAGE_PATH

# Define permissões seguras e funcionais para toda a pasta.
chmod -R 775 $PERSISTENT_STORAGE_PATH
echo "Permissions fixed."

# --- ETAPA 3: INICIAR A APLICAÇÃO ---
echo "Step 3: Starting the application..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
