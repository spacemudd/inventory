FROM php:7.2-fpm

RUN apt-get update || apt-get update

RUN apt-get update && \
    apt-get install -y \
    mysql-client \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libbz2-dev \
    libxml2-dev \
    && pecl channel-update pecl.php.net \
    && pecl install apcu \
    && pecl install redis

RUN apt-get update

RUN docker-php-ext-install \
    zip \
    bz2 \
    mbstring \
    pdo \
    pcntl \
    intl
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install \
    gd \
    pdo_mysql \
    xmlrpc
RUN docker-php-ext-enable \
    redis

# Memory Limit
RUN echo "memory_limit=2048M" > $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "max_execution_time=900" >> $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "extension=apcu.so" > $PHP_INI_DIR/conf.d/apcu.ini
RUN echo "post_max_size=20M" >> $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "upload_max_filesize=20M" >> $PHP_INI_DIR/conf.d/memory-limit.ini

# Time Zone
RUN echo "date.timezone=${PHP_TIMEZONE:-UTC}" > $PHP_INI_DIR/conf.d/date_timezone.ini

# Display errors in stderr
RUN echo "display_errors=stderr" > $PHP_INI_DIR/conf.d/display-errors.ini

# Disable PathInfo
RUN echo "cgi.fix_pathinfo=0" > $PHP_INI_DIR/conf.d/path-info.ini

# Disable expose PHP
RUN echo "expose_php=0" > $PHP_INI_DIR/conf.d/path-info.ini

# Opcache module
# https://laravel-news.com/php-opcache-docker
RUN echo "opcache.enable=1" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.revalidate_freq=0" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.validate_timestamps=${PHP_OPCACHE_VALIDATE_TIMESTAMPS}" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.max_accelerated_files=${PHP_OPCACHE_MAX_ACCELERATED_FILES}" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.memory_consumption=${PHP_OPCACHE_MEMORY_CONSUMPTION}" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.max_wasted_percentage=${PHP_OPCACHE_MAX_WASTED_PERCENTAGE}" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.interned_strings_buffer=16" $PHP_INI_DIR/conf.d/opcache.ini
RUN echo "opcache.fast_shutdown=1" $PHP_INI_DIR/conf.d/opcache.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
COPY . /var/www

RUN mkdir -p /var/www/storage/logs
RUN touch /var/www/storage/logs/laravel.log

RUN apt-get install -y git
#RUN composer install
#RUN composer install --no-dev

#RUN php artisan cache:clear
#RUN php artisan view:clear
#RUN php artisan route:cache

RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www/storage

CMD ["/bin/sh", "-c", "php-fpm -D | tail -f storage/logs/laravel.log"]
