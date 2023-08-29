#!/usr/bin/env bash
docker-compose run php php artisan migrate
docker-compose run php php artisan db:seed
