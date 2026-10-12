#!/bin/sh

set -e

mkdir -p database storage/framework/cache/data storage/framework/sessions storage/framework/views
touch database/database.sqlite

php artisan config:cache
php artisan migrate --force
php artisan db:seed --force

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
