# Use PHP 8.2 with Alpine
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    mysql-client

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd \
    && docker-php-ext-install xml \
    && docker-php-ext-install opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install and build frontend assets
RUN npm install && npm run build

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
