FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install -j$(nproc) zip pdo pdo_pgsql pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd -m -u 1000 -s /bin/bash www -G www-data

COPY --chown=1000:1000  / /var/www/html
COPY /docker/php/php.ini /usr/local/etc/php/

# Install application dependencies
RUN composer install

USER www

CMD ["php-fpm"]
