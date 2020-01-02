FROM 690698528555.dkr.ecr.us-east-1.amazonaws.com/php:7.3-apache-stretch

MAINTAINER Nubity development team <dev@nubity.com>

ARG DEBIAN_FRONTEND=noninteractive

ENV APACHE_DOCUMENT_ROOT /var/www/html/ndd/web

ADD https://download.immun.io/internal/php/3.3.1/immunio-x86_64-Linux-gnu-3.3.1-20180731.so /tmp/

RUN mv /tmp/immunio-x86_64-Linux-gnu-3.3.1-20180731.so $(php -r "echo ini_get('extension_dir');")/immunio.so

# Use the default development configuration
COPY .docker/php/php.ini $PHP_INI_DIR/
COPY .docker/php/conf.d/session.ini .docker/php/conf.d/immunio.ini $PHP_INI_DIR/conf.d/

# system dependencies
RUN apt-get update \
    && apt-get install -qq --yes --no-install-recommends \
    apt-utils \
    ca-certificates \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxpm-dev \
    libwebp-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    file \
    g++ \
    make \
    uuid-runtime \
    git \
    zip \
    unzip \
    && apt-get autoremove \
    && apt-get clean \
    && apt-get autoclean

# configure gd extension
RUN docker-php-ext-configure gd \
    --with-gd \
    --with-webp-dir \
    --with-xpm-dir \
    --with-png-dir \
    --with-zlib-dir \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/

# php extensions
RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    opcache \
    zip

RUN pecl install redis &&\
    docker-php-ext-enable redis

# copy project files to webserver document root
COPY . /var/www/html/ndd

# change permissions and owner for the default drupal site
RUN chmod ug=rwx,o=rx ${APACHE_DOCUMENT_ROOT}/sites/default \
    && chown -R www-data:www-data ${APACHE_DOCUMENT_ROOT}

# oauth encryption keys
RUN mkdir -p /var/www/html/ndd/oauth \
    && openssl genrsa -out /var/www/html/ndd/oauth/private.key 2048 \
    && openssl rsa -in /var/www/html/ndd/oauth/private.key -pubout > /var/www/html/ndd/oauth/public.key \
    && chmod u=rw,g=r,o-rwx /var/www/html/ndd/oauth/private.key /var/www/html/ndd/oauth/public.key \
    && chown :www-data /var/www/html/ndd/oauth/public.key /var/www/html/ndd/oauth/private.key

# configure apache virtual host
COPY .docker/http/conf/000-default.conf /etc/apache2/sites-available/
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# enable apache modules and
# test apache configuration
RUN a2enmod rewrite \
    && apache2ctl configtest

# expose http and https ports
EXPOSE 80

# command
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
