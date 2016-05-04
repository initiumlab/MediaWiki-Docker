FROM php:5.6.21-apache

# We use docker-php-ext-install to enable PHP modules,
# @see https://github.com/docker-library/php/blob/master/docker-php-ext-install
# Uses phpize underneath instead of perl.
RUN set -x; \
    apt-get update \
    && apt-get install -y --no-install-recommends \
        g++ \
        libicu52 \
        libicu-dev \
        libzip-dev \
        imagemagick \
    && ln -fs /usr/lib/x86_64-linux-gnu/libzip.so /usr/lib/ \
    && docker-php-ext-install intl mysqli zip mbstring opcache fileinfo \
    && apt-get purge -y --auto-remove g++ libicu-dev libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY mediawiki/core /var/www/html/w/

# install Composer in /usr/bin directory
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
# install MediaWiki dependencies
RUN cd /var/www/html/w && composer install --no-dev

COPY mediawiki/extensions /var/www/html/w/extensions
COPY mediawiki/skins /var/www/html/w/skins

# Some extensions require additional setup
RUN cd /var/www/html/w/extensions/SyntaxHighlight_GeSHi && composer install --no-dev

COPY docker/mediawiki/LocalSettings.php /var/www/html/w/LocalSettings.php
COPY docker/mediawiki/php.ini /usr/local/etc/php/conf.d/mediawiki.ini

COPY docker/mediawiki/apache.conf /etc/apache2/mediawiki.conf
RUN echo "Include /etc/apache2/mediawiki.conf" >> /etc/apache2/apache2.conf

# cache folder should be writable for www-data user
RUN chown -R www-data:www-data /var/www/html/w/cache

# upload directory should be writable by the www-data user
VOLUME /var/www/html/w/images
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html/w/images

CMD ["apache2-foreground"]