FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

USER root

RUN chown -R nginx:nginx /var/www/html

RUN apk add --no-cache \
    icu-dev \
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
    gd \
    intl

COPY --chown=nginx:nginx composer.json composer.lock ./

USER nginx

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

USER root

COPY --chown=nginx:nginx . .

RUN chown -R nginx:nginx storage bootstrap/cache

USER root

RUN mkdir -p /etc/cont-init.d/ && \
    echo '#!/bin/sh' > /etc/cont-init.d/20-laravel-setup.sh && \
    echo 'set -e' >> /etc/cont-init.d/20-laravel-setup.sh && \
    echo 'echo "Running Laravel setup tasks..."' >> /etc/cont-init.d/20-laravel-setup.sh && \
    echo 'php artisan optimize:clear' >> /etc/cont-init.d/20-laravel-setup.sh && \
    echo 'php artisan migrate --force' >> /etc/cont-init.d/20-laravel-setup.sh && \
    echo 'php artisan optimize' >> /etc/cont-init.d/20-laravel-setup.sh && \
    chmod +x /etc/cont-init.d/20-laravel-setup.sh

ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV COMPOSER_ALLOW_SUPERUSER 1