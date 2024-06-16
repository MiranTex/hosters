#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

php artisan migrate
php artisan view:clear
php artisan route:clear
php artisan key:generate
php artisan optimize

chmod -R 777 storage
chmod -R 777 database/*.sqlite

if [ ! -f "storage/app/LeaseWeb_servers_filters_assignment.csv" ]; then
    echo "Creating csv file for LeaseWeb_servers_filters_assignment"
    cp data storage/app/LeaseWeb_servers_filters_assignment.csv
else
    echo "csv file exists."
fi

# npm install
php-fpm -D
nginx -g "daemon off;"