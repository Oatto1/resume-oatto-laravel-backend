#!/bin/sh

# รอให้ MySQL พร้อม
echo "Waiting for MySQL to be ready..."
until nc -z $DB_HOST $DB_PORT; do
  sleep 1
done

# รันการ migrate
echo "Running migrations..."
php artisan migrate --force

# เริ่ม Laravel
echo "Starting Laravel..."
php artisan serve --host=0.0.0.0 --port=10000