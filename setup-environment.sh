#!/usr/bin/env bash
docker-compose down
docker-compose build
docker-compose up -d
cp -f .env.dev .env
docker-compose run php composer install
docker-compose run php php artisan migrate
docker-compose run php php artisan db:seed
