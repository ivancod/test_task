FROM php:8.1-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# Setup shell as default command terminal
RUN ln -sf /bin/bash /bin/sh

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#set work dirdcoty
WORKDIR /usr/share/nginx/html