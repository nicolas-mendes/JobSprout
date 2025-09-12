#!/usr/bin/env bash
# Para o script se um comando falhar
set -e

# Gera a chave da aplicação, se não existir
php artisan key:generate --force

# Limpa e cacheia as configurações para otimizar a performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Roda as migrações do banco de dados
php artisan migrate --force