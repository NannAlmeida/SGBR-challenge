FROM php:8.2-fpm-alpine

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk update && apk add \
    build-base \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    oniguruma-dev \
    curl \
    libpq-dev

RUN docker-php-ext-install pdo_pgsql mbstring zip exif pcntl
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --no-scripts --optimize

#COPY ./config/php/local.ini /usr/local/etc/php/conf.d/local.ini

COPY run.sh /tmp

RUN chmod +x /tmp/run.sh

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

USER www

COPY --chown=www:www . /var/www

ENV APP_PORT 9000

EXPOSE 9000
#CMD ["php", "/var/www/artisan", "serve", "--host=0.0.0.0", "--port=9000"]

ENTRYPOINT ["/tmp/run.sh"]
