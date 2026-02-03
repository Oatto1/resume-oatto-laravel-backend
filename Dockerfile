FROM php:8.4-cli

WORKDIR /var/www/html

# install system deps
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zip curl libicu-dev libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd intl zip

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# copy project files first
COPY . .

# install dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# set proper permissions BEFORE changing user
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# change user to www-data
USER www-data

# expose Laravel default port
EXPOSE 10000

# run Laravel
CMD ["php","artisan","serve","--host=0.0.0.0","--port=10000"]
