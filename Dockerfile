FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

FROM php:8.4-cli-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends libonig-dev libsqlite3-dev libzip-dev unzip \
    && docker-php-ext-install mbstring pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader \
    && mkdir -p database storage/framework/cache/data storage/framework/sessions storage/framework/views \
    && chmod -R 775 database storage bootstrap/cache

EXPOSE 10000

CMD ["sh", "docker/start.sh"]
