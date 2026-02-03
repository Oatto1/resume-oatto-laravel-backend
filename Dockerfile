# ใช้ php 8.4-cli image ที่พร้อมใช้งาน
FROM php:8.4-cli

# กำหนด working directory
WORKDIR /var/www/html

# ติดตั้ง dependencies ที่จำเป็นสำหรับ Laravel และ MySQL
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zip curl libicu-dev libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd intl zip

# ติดตั้ง Composer จาก image ของ Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# คัดลอกไฟล์จากโปรเจคเข้าใน container
COPY . .

# ติดตั้ง dependencies สำหรับ Laravel
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# ทำการ migrate ฐานข้อมูล (โดยใช้ --force สำหรับ production)
RUN php artisan migrate --force

# ตั้งค่า permission ให้กับ directory ที่เกี่ยวข้อง
RUN chmod -R 775 storage bootstrap/cache

# ตั้งค่าผู้ใช้ให้รันคำสั่งเป็น www-data (user ที่ PHP ใช้ใน container)
USER www-data

# เปิด port ที่ใช้ให้พร้อมสำหรับการใช้งาน
EXPOSE 10000

# เรียกใช้งาน Laravel ด้วยคำสั่ง php artisan serve
CMD php artisan serve --host=0.0.0.0 --port=10000