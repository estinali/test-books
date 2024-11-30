FROM php:8.3-fpm

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql zip

#RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY ./ /var/www/html
#COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install \
    && ./init --env=Production --overwrite=All \
    && php yii migrate --interactive=0

WORKDIR /var/www/html

CMD ["php-fpm"]
