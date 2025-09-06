# Dockerfile
# syntax=docker/dockerfile:1.4
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git bash curl libpng-dev libjpeg-turbo-dev freetype-dev \
    oniguruma-dev libxml2-dev zip unzip libzip-dev \
    postgresql-dev icu-dev autoconf g++ make \
    nodejs npm

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_pgsql pgsql bcmath intl gd pcntl opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG UID=1000
ARG GID=1000
RUN addgroup -g ${GID} app && adduser -G app -g app -u ${UID} -D app \
    && chown -R app:app /var/www/html

WORKDIR /var/www/html
USER app

COPY --chown=app:app . .

RUN composer install --no-interaction --prefer-dist \
    && npm ci \
    && npm run build

CMD ["php-fpm"]
