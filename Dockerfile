FROM ubuntu:latest

# экранировать переводы строк надо
RUN apt update && \
    apt install -y nginx curl php && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install # Что инстал та? Нет composer.json

COPY ./hosts/my-application.local.conf /etc/nginx/sites-enabled/my-application.local.conf

WORKDIR /var/www/my-application.local
VOLUME /var/www/my-application.local

# бесполезная директива
EXPOSE 80

CMD [ "nginx", "-g", "daemon off;"]