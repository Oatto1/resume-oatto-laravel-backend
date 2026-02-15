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

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ติดตั้ง Node.js (ต้องมีตอน runtime ด้วย)
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# กำหนด working directory
WORKDIR /var/www/html

# คัดลอกไฟล์โปรเจค
COPY . .

# ติดตั้ง PHP dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

# ❌ ลบออก (ห้าม require ใน docker เพราะ lockfile พัง + cache เพี้ยน)
# RUN composer require filament/filament
# RUN composer require livewire/livewire

# เปิด port
EXPOSE 8000

# ❌ ห้าม build ตอน image build (Tailwind จะ purge ผิด)
# RUN npm install
# RUN npm run build

# ❌ ห้าม optimize ตอน build
# RUN php artisan storage:link
# RUN php artisan filament:optimize
# RUN php artisan filament:optimize-clear


# ---------- START CONTAINER ----------
# ✔ ย้ายทุกอย่างมาทำตอน container start
CMD php artisan optimize:clear && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan storage:link || true && \
    composer dump-autoload --optimize && \
    npm ci && npm run build && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=8000
