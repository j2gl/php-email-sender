FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

VOLUME ["/var/www/html"]
