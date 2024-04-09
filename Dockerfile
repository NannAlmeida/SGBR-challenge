FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --no-scripts --optimize

EXPOSE 8000
CMD ["php-fpm"]