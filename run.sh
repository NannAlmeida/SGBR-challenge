#!/bin/sh

cd /var/www
sleep 10
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port=$APP_PORT
