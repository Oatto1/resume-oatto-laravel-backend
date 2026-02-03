FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd intl zip

# Get Composer (install PHP dependencies)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get update && apt-get install -y nodejs

# Install JS dependencies
RUN npm install

# Expose port 80 for Nginx
EXPOSE 80

# Install Nginx
RUN apt-get install -y nginx

# Copy Nginx config (Assuming you have nginx.conf in your project)
COPY nginx.conf /etc/nginx/nginx.conf

# Run migrations and start PHP-FPM with Nginx
CMD php artisan migrate --force && service nginx start && php-fpm
