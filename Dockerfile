# --- Estágio 1: Instalar dependências do Composer ---
FROM composer:2 as composer_builder
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# --- Estágio 2: Compilar os assets com Node.js ---
FROM node:18-alpine as node_builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Estágio 3: Imagem Final de Produção ---
FROM richarvey/nginx-php-fpm:3.1.6

# Copia as dependências do Composer do primeiro estágio
COPY --from=composer_builder /app/vendor /var/www/html/vendor

# Copia todos os arquivos da aplicação do segundo estágio (que já tem o código fonte)
COPY --from=node_builder /app /var/www/html

# Copia APENAS os assets já compilados para a pasta public
COPY --from=node_builder /app/public/build /var/www/html/public/build

# Configuração da imagem e do Laravel
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Ajusta as permissões para o Laravel funcionar corretamente
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# NÃO é necessário um CMD, a imagem base já tem o /start.sh correto para iniciar o Nginx e o PHP-FPM.

# FROM richarvey/nginx-php-fpm:3.1.6

# COPY . .

# # Image config
# ENV SKIP_COMPOSER 1
# ENV WEBROOT /var/www/html/public
# ENV PHP_ERRORS_STDERR 1
# ENV RUN_SCRIPTS 1
# ENV REAL_IP_HEADER 1

# # Laravel config
# ENV APP_ENV production
# ENV APP_DEBUG false
# ENV LOG_CHANNEL stderr

# # Allow composer to run as root
# ENV COMPOSER_ALLOW_SUPERUSER 1

# CMD ["/start.sh"]