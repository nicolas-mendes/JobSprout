#!/bin/sh
set -e # O script irá parar imediatamente se um comando falhar

# Etapa 1: Cria o link simbólico (como antes)
echo "Step 1: Creating symbolic link for persistent storage..."
rm -f /app/public/storage
ln -s /var/lib/data/public /app/public/storage
echo "Symbolic link created."

# Etapa 2: CORREÇÃO DE PERMISSÕES (A parte crucial)
# Descobre o usuário atual que está executando este script (que será o mesmo do php-fpm)
CURRENT_USER=$(whoami)
echo "Step 2: Running as user '$CURRENT_USER'. Fixing permissions for /var/lib/data/public..."

# Altera o dono do diretório de armazenamento para o usuário da aplicação.
# O -R (recursivo) garante que todos os subdiretórios também sejam afetados.
# O segundo $CURRENT_USER é para o grupo, que geralmente é o mesmo que o usuário.
chown -R $CURRENT_USER:$CURRENT_USER /var/lib/data/public

# Opcional, mas recomendado: Garante permissões de escrita para o dono e o grupo (775).
chmod -R 775 /var/lib/data/public
echo "Permissions fixed."

# Etapa 3: Inicia a aplicação (usando o comando padrão do Nixpacks)
echo "Step 3: Starting the application..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)