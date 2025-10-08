# #!/bin/sh
# set -e

# echo "Step 1: Creating symbolic link for persistent storage..."
# # Garante que qualquer link quebrado ou arquivo existente seja removido antes de criar um novo.
# rm -f /app/public/storage
# ln -s /var/lib/data/public /app/public/storage
# echo "Symbolic link created."

# # --- CORREÇÃO APLICADA AQUI ---
# # O usuário do servidor web (Nginx/PHP-FPM) geralmente é 'www-data' em imagens baseadas em Debian/Ubuntu/Alpine.
# # Não use 'whoami', pois ele retornará 'root', que é o usuário que executa este script,
# # mas não o usuário que executa a aplicação web.
# WEB_USER="www-data"

# echo "Step 2: Fixing permissions for persistent storage at /var/lib/data/public..."

# # Define o proprietário e o grupo da pasta de armazenamento para o usuário do servidor web.
# # O '-R' garante que a mudança seja aplicada recursivamente a todos os arquivos e subdiretórios.
# echo "Changing owner to $WEB_USER:$WEB_USER..."
# chown -R $WEB_USER:$WEB_USER /var/lib/data/public

# # Ajusta as permissões para garantir a segurança e a funcionalidade.
# # Diretorios precisam de permissão de execução (775) para serem acessados.
# echo "Setting directory permissions to 775..."
# find /var/lib/data/public -type d -exec chmod 775 {} \;

# # Arquivos geralmente precisam de permissão de escrita para o dono e o grupo (664).
# echo "Setting file permissions to 664..."
# find /var/lib/data/public -type f -exec chmod 664 {} \;

# echo "Permissions fixed."

# echo "Step 3: Starting the application..."
# # O restante do seu script permanece o mesmo.
# node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
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

echo "Permissions fixed."

# --- ETAPA 3: INICIAR A APLICAÇÃO ---
echo "Step 3: Starting the application..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)