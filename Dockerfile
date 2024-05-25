# Используем официальный образ PHP 8.1 с Apache в качестве базы
FROM php:8.1-apache

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo_pgsql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем необходимые пакеты для работы Symfony
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev

# Устанавливаем расширение для работы с PostgreSQL
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pgsql pdo_pgsql

# Копируем и устанавливаем зависимости Symfony
WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install

# Открываем порт 80 для веб-сервера Apache
EXPOSE 80

# Запускаем Apache при старте контейнера
CMD ["apache2-foreground"]
