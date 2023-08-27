FROM php:8.0.30-fpm
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y unzip
RUN docker-php-ext-install \
    exif
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . /app
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /app