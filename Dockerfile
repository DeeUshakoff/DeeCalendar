FROM php:8.1-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install --no-scripts

EXPOSE 8000
CMD php bin/console server:run 0.0.0.0:8000