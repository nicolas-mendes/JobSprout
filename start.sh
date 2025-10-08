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

<<<<<<< HEAD
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

=======
# Assumindo que seu volume persistente está montado em /app/storage
# Se for diferente, ajuste este caminho.
PERSISTENT_STORAGE_PATH="/app/storage"
>>>>>>> 5fc7a53140b373383348b6a90c6e8bcd515909e9
WEB_USER="www-data"
# Define o caminho real do armazenamento que precisa de permissões
STORAGE_PATH="/app/storage"

<<<<<<< HEAD
# Garante que o usuário do servidor web ('www-data') seja o dono
# de toda a pasta de armazenamento para poder escrever arquivos, logs, cache, etc.
chown -R $WEB_USER:$WEB_USER $STORAGE_PATH

# Define permissões funcionais e seguras para toda a pasta de armazenamento.
# 775 = Dono e grupo podem ler/escrever/executar, outros podem apenas ler/executar.
chmod -R 775 $STORAGE_PATH
=======
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
>>>>>>> 5fc7a53140b373383348b6a90c6e8bcd515909e9

# Define permissões seguras e funcionais para toda a pasta.
chmod -R 775 $PERSISTENT_STORAGE_PATH
echo "Permissions fixed."

<<<<<<< HEAD
# --- ETAPA 3: INICIAR A APLICAÇÃO ---
echo "Step 3: Starting the application..."
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
=======
echo "Step 4: Starting the application..."
# O restante do seu script permanece o mesmo.
node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf && (php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf)
>>>>>>> 5fc7a53140b373383348b6a90c6e8bcd515909e9
