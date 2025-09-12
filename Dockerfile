# Usa uma imagem base oficial e mais moderna do PHP com FPM e Alpine Linux
FROM richarvey/nginx-php-fpm:3.1.6

# Instala dependências do sistema e do PHP em uma única camada
RUN apk add --no-cache \
        bash \
        icu-dev \
        libzip-dev \
        libpng-dev \
        postgresql-dev \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        bcmath \
        intl \
        zip \
        gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia apenas os arquivos do composer primeiro para aproveitar o cache do Docker
COPY composer.json composer.lock ./

# Instala dependências sem scripts e otimiza o autoloader
# --no-scripts evita que o artisan tente se conectar ao DB durante o build
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Dá permissão de execução ao script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copia o restante do código da aplicação
COPY . .

# Ajusta permissões para os diretórios que o Laravel precisa escrever
RUN chown -R www-data:www-data storage bootstrap/cache

# Expõe a porta do PHP-FPM
EXPOSE 9001

# O comando para iniciar o PHP-FPM é herdado da imagem base `php:8.2-fpm-alpine`
# Não precisamos de um CMD ou ENTRYPOINT customizado aqui.