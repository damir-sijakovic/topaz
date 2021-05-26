FROM php:8.0.2-apache

MAINTAINER Damir Sijakovic <damir(dot)sijakovic(at)gmail(dot)com>

# Avoid questions during installation
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get install -y libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libzip-dev \
        libfreetype6-dev \
        libxml2-dev \
        libicu-dev \
        wget \
        unzip \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install \
        iconv \
        intl \
        opcache \
        pdo \
        mysqli \
        pdo_mysql \
        mbstring \
        soap \
        gd \
        zip \
        pcntl 

# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Xdebug
#RUN curl -fsSL 'https://xdebug.org/files/xdebug-3.0.3.tgz' -o xdebug.tar.gz \
#    && mkdir -p xdebug \
#    && tar -xf xdebug.tar.gz -C xdebug --strip-components=1 \
#    && rm xdebug.tar.gz \
#    && ( \
#    	cd xdebug \
#    	&& phpize \
#    	&& ./configure --enable-xdebug \
#    	&& make -j$(nproc) \
#    	&& make install \
#    ) \
#    && rm -r xdebug \
#    && docker-php-ext-enable xdebug

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Apache configuration
RUN a2enmod rewrite

# PHP configuration
COPY php.ini /usr/local/etc/php/

VOLUME /var/www/
WORKDIR /var/www/
EXPOSE 80

CMD ["apache2-foreground"]
