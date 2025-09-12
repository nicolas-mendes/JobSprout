#!/usr/bin/env bash
# Para o script se um comando falhar
set -e

# Copia o .env.example para criar um .env.
# Agora o comando key:generate terá um arquivo para modificar.
cp .env.example .env

# Roda os comandos do artisan
php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force