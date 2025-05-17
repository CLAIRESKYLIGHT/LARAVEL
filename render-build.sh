#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP and required extensions
apt-get update
apt-get install -y php8.2 php8.2-cli php8.2-common php8.2-curl php8.2-mbstring php8.2-xml php8.2-zip php8.2-mysql

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Install dependencies
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force

# Install Node.js and npm
curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
apt-get install -y nodejs

# Install frontend dependencies and build
npm install
npm run build 