# Stage 1: Instala as dependências do Composer
FROM composer:2 as vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist --optimize-autoloader --no-dev

# Stage 2: Compila os assets de front-end
FROM node:18 as frontend

WORKDIR /app
COPY --from=vendor /app/vendor/ /app/vendor/
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 3: A imagem final de produção
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Instala extensões PHP essenciais para o Laravel
RUN apk add --no-cache \
      bash \
      nginx \
      supervisor \
      libzip-dev \
      zip \
      libpng-dev \
      jpeg-dev \
      freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
      gd \
      zip \
      pdo pdo_mysql

# Copia os arquivos da aplicação e as dependências já instaladas
COPY --from=vendor /app/vendor /var/www/html/vendor
COPY --from=frontend /app/public /var/www/html/public
COPY . /var/www/html

# Copia a configuração do Nginx e o script de inicialização
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN php artisan migrate --seed --force

# Define as permissões corretas
RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]