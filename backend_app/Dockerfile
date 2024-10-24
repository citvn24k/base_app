FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    supervisor

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd bcmath

RUN mkdir -p /run/nginx

WORKDIR /var/www
COPY . .

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY config/nginx.conf /etc/nginx/nginx.conf

COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80 9000

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
