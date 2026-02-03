# ใช้ PHP 8.4 CLI image
FROM php:8.4-cli

# ติดตั้ง system dependencies
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
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd intl zip

# ติดตั้ง Composer (คัดลอกจาก image ของ Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# กำหนด working directory
WORKDIR /var/www/html

# คัดลอกไฟล์โปรเจคทั้งหมดเข้าใน container
COPY . .

# ติดตั้ง PHP dependencies ด้วย Composer
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# ติดตั้ง Node.js และ npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get update && apt-get install -y nodejs

# ติดตั้ง JavaScript dependencies ด้วย npm
RUN npm install

# Build assets ด้วย Vite
RUN npm run build

# รันคำสั่ง Filament optimize เพื่อเพิ่มประสิทธิภาพ
RUN php artisan filament:optimize

# เคลียร์ cache ถ้าจำเป็น
RUN php artisan filament:optimize-clear

# ตั้งค่า Nginx หรือ Apache ให้รองรับไฟล์ static assets และ route ของ Livewire
COPY ./nginx.conf /etc/nginx/sites-available/default

# เปิด port 80 และ 443 สำหรับ Nginx
EXPOSE 80 443

# รัน migrations และเริ่ม Nginx และ PHP-FPM
CMD service nginx start && php-fpm