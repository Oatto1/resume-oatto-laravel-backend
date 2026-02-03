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

# ติดตั้ง Filament และ Livewire
RUN composer require filament/filament
RUN composer require livewire/livewire

# เปิด port 8000 ที่ใช้โดย php artisan serve
EXPOSE 8000

# ติดตั้ง Node.js เวอร์ชันที่รองรับ (20.x หรือ 22.x)
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# ติดตั้ง JavaScript dependencies ด้วย npm
RUN npm install

# Build assets ด้วย Vite
RUN npm run build

# สร้าง symbolic link สำหรับการให้บริการไฟล์ใน public/storage
RUN php artisan storage:link

# รันคำสั่ง Filament optimize เพื่อเพิ่มประสิทธิภาพ
RUN php artisan filament:optimize

# เคลียร์ cache ถ้าจำเป็น
RUN php artisan filament:optimize-clear

# เคลียร์ cache ก่อน deploy
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear && \
    php artisan optimize:clear

# รัน migrations และเริ่ม server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
