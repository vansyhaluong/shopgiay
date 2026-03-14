FROM php:8.2-apache

RUN docker-php-ext-install mysqli

COPY ./public /var/www/html/

RUN chmod -R 755 /var/www/html

EXPOSE 80