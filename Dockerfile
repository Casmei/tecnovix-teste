# Dockerfile

# Escolher uma imagem base PHP-FPM
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto Laravel
COPY . .

# Instalar dependências do Laravel
RUN composer install

# Ajustar permissões
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

# Expor a porta padrão do PHP-FPM
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && php-fpm"]
