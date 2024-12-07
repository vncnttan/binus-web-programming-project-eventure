# Use the nginx alpine image as the base image
FROM nginx:alpine AS base

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

# Use nginx-alpine as the final stage
FROM nginx:alpine AS final

# Copy the application from the builder stage
COPY --from=builder /var/www/html /var/www/html

# Copy the custom nginx configuration file into the container
COPY phpdocker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Set permissions (optional, adjust as needed)
RUN chmod -R 755 /var/www/html 
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
