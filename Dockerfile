# syntax=docker/dockerfile:1

# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Set up the document root and enable mod_rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# 4. Set working directory
WORKDIR /var/www/html

# 5. Copy and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --no-autoloader

# 6. Copy and install Node.js dependencies
COPY package.json package-lock.json ./
RUN npm install

# 7. Copy the rest of the application
COPY . .

# 8. Build frontend assets
RUN npm run build

# 9. Generate autoloader and link storage
RUN composer dump-autoload --optimize
RUN php artisan storage:link

# 10. Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Expose port 80 and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
