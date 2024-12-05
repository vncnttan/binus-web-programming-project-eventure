#Dari ko CP
FROM php:8.2-apache

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    curl \
    g++ \
    git \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    libzip-dev \
    libonig-dev \
	libsodium-dev \
    sudo \
    unzip \
    zip \
 && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
                                                           apt-get install -y nodejs && \
                                                           npm install -g npm@latest

RUN apt-get update && apt-get install -y nodejs

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite headers

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN sed -ri -e 's!upload_max_filesize = 2M!upload_max_filesize = 50M!g' $PHP_INI_DIR/php.ini
RUN sed -ri -e 's!post_max_size = 8M!post_max_size = 100M!g' $PHP_INI_DIR/php.ini

RUN docker-php-ext-install \
    bcmath \
    bz2 \
    calendar \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    zip \
	sodium

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN npm install

RUN npm run build

RUN composer update && composer install --no-dev --optimize-autoloader

RUN php artisan key:generate

RUN php artisan storage:link

RUN mkdir -p /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan config:cache && php artisan route:cache && php artisan view:cache
