#!/bin/bash
composer install
vendor/bin/phpunit --bootstrap vendor/autoload.php Tests
