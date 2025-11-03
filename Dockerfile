# Base image: PHP + FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies for Laravel + SQLite + Node
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libsqlite3-dev pkg-config curl \
    nodejs npm \
 && docker-php-ext-install pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Ensure SQLite files exist for build
RUN mkdir -p database && \
    touch database/database.sqlite && \
    touch database/players.sqlite && \
    touch database/auth.sqlite

# Copy Docker-specific .env for build
COPY .env.docker .env

# Install PHP dependencies (package:discover will succeed now)
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies & build Vite assets
RUN npm install
RUN npm run build

# Expose port
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
