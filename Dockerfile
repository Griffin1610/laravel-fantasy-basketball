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

# Ensure SQLite databases exist
RUN mkdir -p database && \
    touch database/database.sqlite && \
    touch database/players.sqlite && \
    touch database/auth.sqlite

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear Laravel caches safely
RUN php artisan config:clear || true && \
    php artisan route:clear || true && \
    php artisan view:clear || true

# Remove old builds and node_modules to ensure fresh assets
RUN rm -rf node_modules package-lock.json public/build

# Set environment variables for production
ARG APP_URL=https://laravel-fantasy-basketball.onrender.com
ENV APP_ENV=production
ENV APP_URL=${APP_URL}
ENV VITE_APP_URL=${APP_URL}

# Install Node dependencies & build Vite assets
RUN npm install && npm run build

# Fix permissions for Laravel and public assets
RUN chmod -R 755 storage bootstrap/cache public/build

# Expose port
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
