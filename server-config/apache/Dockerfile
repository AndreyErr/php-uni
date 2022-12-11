FROM php:8.0-apache
RUN apt-get update && docker-php-ext-install mysqli
RUN apt-get -y install libaprutil1-dbd-mysql && a2enmod authn_dbd

# Активация возможности перезаписи в .htaccess
RUN a2enmod rewrite

# Redis для сессий
RUN pecl install redis
RUN docker-php-ext-enable redis