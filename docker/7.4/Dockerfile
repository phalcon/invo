FROM composer:latest as composer
FROM php:7.4-cli

LABEL vendor="Phalcon" \
      maintainer="Phalcon Team <team@phalcon.io>" \
      description="The PHP image to test Invo example concepts"

ENV PHALCON_VERSION="5.0.0RC4" \
    PHP_VERSION="7.4"

ADD ./extra.ini /usr/local/etc/php/conf.d/
ADD . /code

WORKDIR /code

# Update
RUN apt update -y && \
    apt install -y \
        apt-utils \
        gettext \
        git \
        libzip-dev \
        nano \
        sudo \
        wget \
        zip

# PECL Packages
RUN pecl install phalcon-${PHALCON_VERSION}  \
      xdebug

# Install PHP extensions
RUN docker-php-ext-install \
      gettext \
      pdo_mysql \
      zip

# Install PHP extensions
RUN docker-php-ext-enable \
      opcache \
      phalcon \
      xdebug

# Cleanup
RUN apt autoremove -y \
    && apt autoclean -y \
    && apt clean -y \
    && rm -rf /tmp/* /var/tmp/* \
    && find /var/cache/apt/archives /var/lib/apt/lists /var/cache \
       -not -name lock \
       -type f \
       -delete \
    && find /var/log -type f | while read f; do echo -n '' > ${f}; done

RUN php -m | grep -i "opcache\|mysql\|phalcon\||pdo\|mbstring"
#    && mv /code/.env.example /code/.env

# Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
# Bash script with helper aliases
COPY ./.bashrc /root/.bashrc
COPY ./.bashrc /home/phalcon/.bashrc

EXPOSE 80

# docker run -p 80:80 phalconphp/vokuro:4.1.2
CMD ["php", "-S", "0.0.0.0:80", "-t", "public/", ".htrouter.php"]
