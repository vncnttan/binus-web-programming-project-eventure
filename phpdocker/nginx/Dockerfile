# Install PHP, Composer, and required build tools
FROM php:8.2-fpm-alpine AS builder

# Install dependencies required for PHP and Composer
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    curl \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    && docker-php-ext-install \
    zip \
    intl


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application source code into the container
COPY . .

# Run composer install
RUN composer install --no-dev --optimize-autoloader

# Generate autoloader and clear/cache Laravel configurations
RUN composer dump-autoload --no-dev --optimize \
    && php artisan config:clear \
    && php artisan view:clear \
    && php artisan route:clear \
    && php artisan optimize

# Use nginx-alpine as the final stage
FROM nginx:alpine AS final

WORKDIR /var/www/html

# Copy the application from the builder stage
COPY --from=builder /var/www/html /var/www/html

# Copy the custom nginx configuration file into the container
COPY phpdocker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Set permissions (optional, adjust as needed)
RUN chmod -R 755 /var/www/html

RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Expose port 80
EXPOSE 80

# Default command
CMD ["nginx", "-g", "daemon off;"]
