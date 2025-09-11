#!/bin/sh

# Inicia o PHP-FPM em background
php-fpm &

# Inicia o Nginx em foreground
nginx -g "daemon off;"