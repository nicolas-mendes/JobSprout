#!/bin/sh

# Para o script se um comando falhar
set -e

# Roda as migrações do banco de dados
composer install --no-dev
npm install
npm run build
php artisan optimize:clear
php artisan migrate --force

# Executa o comando original para iniciar o servidor web.
# O 'exec "$@"' passa o controle para o próximo processo,
# o que é a maneira correta de iniciar o servidor.
exec "$@"