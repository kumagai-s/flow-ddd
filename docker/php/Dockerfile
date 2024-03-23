FROM php:8.3-apache

COPY --from=composer /usr/bin/composer /usr/bin/composer

# sudoコマンドはflowのcore:setfilepermissionsコマンドの実行で必要
RUN apt-get update \
    && apt-get install -y sudo vim zlib1g-dev libzip-dev \
    && pecl install xdebug \
    && docker-php-ext-install zip pdo_mysql \
    && docker-php-ext-enable xdebug

COPY docker/php/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN sudo a2enmod rewrite
