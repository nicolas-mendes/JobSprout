#!/bin/sh
set -e # O script irá parar imediatamente se um comando falhar

# Etapa 1: Limpa o terreno e cria o link simbólico usando o método mais robusto
echo "Creating symbolic link for persistent storage..."
rm -f /app/public/storage
ln -s /var/lib/data/public /app/public/storage
echo "Symbolic link created successfully."

# Etapa 2: Executa o comando de inicialização padrão e completo do Nixpacks que descobrimos
echo "Executing the default Nixpacks start command..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)