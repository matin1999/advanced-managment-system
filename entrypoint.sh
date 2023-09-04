#!/bin/bash
php artisan migrate
php artisan route:cache
php artisan swoole:http start
echo "app is running ..."