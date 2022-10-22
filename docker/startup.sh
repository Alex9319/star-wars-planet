#!/usr/bin/env bash

# Limpiamos la cache
php /var/www/startWarsPlanets/bin/console cache:clear

php /var/www/startWarsPlanets/bin/console doctrine:database:create
php /var/www/startWarsPlanets/bin/console make:migration

service apache2 start

# Hacemos una acción infinita para que el POD no muera
touch test
tail -0f test