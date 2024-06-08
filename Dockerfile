# Use the official PHP image with Apache
FROM php:8.2-apache
# Set COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_ALLOW_SUPERUSER 1
# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Ensure the proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . .

# Install Laravel dependencies
#RUN composer install
# Copy .env.example to .env
RUN cp .env.example .env
# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel application key
RUN php artisan key:generate
RUN touch database/database.sqlite
RUN php artisan migrate
# Expose port 80
EXPOSE 80

# Run Laravel
CMD ["apache2-foreground"]