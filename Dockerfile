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

# Ensure SQLite files exist
RUN mkdir -p database && \
    touch database/database.sqlite && \
    touch database/players.sqlite && \
    touch database/auth.sqlite

# Clear old Laravel caches
RUN php artisan config:clear
RUN php artisan view:clear
RUN php artisan route:clear
RUN php artisan cache:clear

# Set APP_URL for Vite build
ARG APP_URL
ENV APP_URL=$APP_URL

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies (production only) & build Vite assets
RUN npm ci --omit=dev
RUN npm run build

# Fix permissions for public/build
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 public/build

# Expose port
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
