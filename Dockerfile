FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets && apk add --no-cache pcre-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis.so
RUN curl -sS https://getcomposer.org/installer​ | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV PROJECT_ROOT /var/www/html/
WORKDIR ${PROJECT_ROOT}
COPY ./code/ ${PROJECT_ROOT}
RUN chmod -R 755 ${PROJECT_ROOT}storage;