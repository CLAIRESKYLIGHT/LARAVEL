#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP and required extensions
apt-get update
apt-get install -y php8.2 php8.2-cli php8.2-common php8.2-curl php8.2-mbstring php8.2-xml php8.2-zip php8.2-mysql

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Set permissions
chmod -R 777 storage bootstrap/cache

# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear 