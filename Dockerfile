FROM php:8.4-fpm

# กำหนด working directory
WORKDIR /var/www/html

# ติดตั้ง dependencies ที่จำเป็น
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zip curl libicu-dev libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd intl zip

# ติดตั้ง Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# คัดลอกไฟล์จากโปรเจคเข้าใน container
COPY . .

# ติดตั้ง dependencies ของ Laravel
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# ตั้งค่าการอนุญาตให้โฟลเดอร์ที่ใช้โดย Laravel
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# คัดลอก entrypoint script ที่จะรัน migrate ก่อนเริ่ม Laravel
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# เปลี่ยนผู้ใช้เป็น www-data
USER www-data

# เปิด port 9000 สำหรับ PHP-FPM
EXPOSE 9000

# รัน entrypoint script ตอนเริ่มต้น container
ENTRYPOINT ["sh", "/usr/local/bin/entrypoint.sh"]

# รัน PHP-FPM
CMD ["php-fpm"]