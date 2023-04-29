#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction 
fi

if [ ! -f ".env" ]; then
    echo "creating env file"
    cp .env.local .env
else
    echo "env exists"
fi

php artisan key:generate
php artisan config:cache
php artisan view:clear
php artisan cache:clear
php artisan route:clear

#composer require laravel/ui
#php artisan ui bootstrap
#php artisan ui bootstrap --auth

#php artisan migrate

# npm install --no-progress --no-interaction 

# npm run dev --no-progress --no-interaction 

php artisan serve --port=$PORT
 #--host:0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"