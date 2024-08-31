#!/bin/bash

if [ ! -d "/var/www/vendor" ]; then
  composer install --optimize-autoloader
fi

php artisan migrate:fresh --seed #TODO: Revisar

exec "$@"
