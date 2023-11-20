FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev libmemcached-dev nano build-essential cron

RUN docker-php-ext-install -j$(nproc) pdo_mysql zip exif pcntl gd
RUN docker-php-ext-install mysqli

RUN apt-get install -y --no-install-recommends libssl-dev
RUN apt-get install zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY cron/laravel-cron /etc/cron.d/laravel_cron
RUN chmod 0644 /etc/cron.d/laravel_cron \
    && crontab /etc/cron.d/laravel_cron \
    && touch /var/log/cron.log

CMD ["php-fpm"]
