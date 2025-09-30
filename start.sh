#!/bin/sh
set -e

echo "Step 1: Creating symbolic link for persistent storage..."
# Garante que qualquer link quebrado ou arquivo existente seja removido antes de criar um novo.
rm -f /app/public/storage
ln -s /var/lib/data/public /app/public/storage
echo "Symbolic link created."

# --- CORREÇÃO APLICADA AQUI ---
# O usuário do servidor web (Nginx/PHP-FPM) geralmente é 'www-data' em imagens baseadas em Debian/Ubuntu/Alpine.
# Não use 'whoami', pois ele retornará 'root', que é o usuário que executa este script,
# mas não o usuário que executa a aplicação web.
WEB_USER="www-data"

echo "Step 2: Fixing permissions for persistent storage at /var/lib/data/public..."

# Define o proprietário e o grupo da pasta de armazenamento para o usuário do servidor web.
# O '-R' garante que a mudança seja aplicada recursivamente a todos os arquivos e subdiretórios.
echo "Changing owner to $WEB_USER:$WEB_USER..."
chown -R $WEB_USER:$WEB_USER /var/lib/data/public

# Ajusta as permissões para garantir a segurança e a funcionalidade.
# Diretorios precisam de permissão de execução (775) para serem acessados.
echo "Setting directory permissions to 775..."
find /var/lib/data/public -type d -exec chmod 775 {} \;

# Arquivos geralmente precisam de permissão de escrita para o dono e o grupo (664).
echo "Setting file permissions to 664..."
find /var/lib/data/public -type f -exec chmod 664 {} \;

echo "Permissions fixed."


echo "Step 3: Starting the application..."
# O restante do seu script permanece o mesmo.
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
