FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

USER root

RUN apk add --no-cache \
    postgresql-dev \
    gd-dev \
    oniguruma-dev \
    zip \
    unzip \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    bcmath \
    mbstring \
    pcntl \
    gd

COPY --chown=nginx:nginx composer.json composer.lock ./

USER nginx

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

USER root

COPY --chown=nginx:nginx . .

RUN chown -R nginx:nginx storage bootstrap/cache

USER nginx

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

USER root

RUN echo '#!/bin/sh' > /etc/cont-init.d/20-laravel-migrate.sh && \
    echo 'set -e' >> /etc/cont-init.d/20-laravel-migrate.sh && \
    echo 'echo "Running database migrations..."' >> /etc/cont-init.d/20-laravel-migrate.sh && \
    echo 'php artisan migrate --force' >> /etc/cont-init.d/20-laravel-migrate.sh && \
    chmod +x /etc/cont-init.d/20-laravel-migrate.sh

ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV COMPOSER_ALLOW_SUPERUSER 1