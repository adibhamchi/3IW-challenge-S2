FROM php:8.2-apache

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libyaml-dev unzip git

RUN  docker-php-ext-configure gd --with-freetype
RUN  docker-php-ext-install gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN a2enmod ssl


COPY server/adibida.fr_ssl_certificate.cer /etc/ssl/certs/
COPY server/adibida.fr_ssl_certificate_INTERMEDIATE.cer /etc/ssl/certs/
COPY server/adibida.fr_private.key /etc/ssl/private/

# Set working directory
WORKDIR /var/www/html/

RUN pecl install yamL

RUN usermod -u 1000 www-data

COPY /site/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]



