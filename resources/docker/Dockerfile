# syntax=docker/dockerfile:1
ARG PHP_VERSION=8.5

FROM php:${PHP_VERSION}-cli AS base

ARG PHP_VERSION=8.5
ARG PHALCON_VARIANT=v5
ARG PHALCON_V5_CONSTRAINT="^5.0"
ARG UID=1000
ARG GID=1000
ARG USER=invo
ARG GROUP=invo

# System packages, PHP extensions and an unprivileged user matching the host UID
RUN <<EOT
set -eux
groupadd -g "${GID}" "${GROUP}"
useradd -l -m -u "${UID}" -g "${GID}" -s /bin/bash "${USER}"
apt-get update -y
apt-get install -yq --no-install-recommends \
    curl \
    default-mysql-client \
    git \
    libicu-dev \
    libzip-dev \
    unzip \
    zip
docker-php-ext-install intl pdo_mysql zip
apt-get clean -y
rm -rf /var/lib/apt/lists/*
EOT

# Composer
COPY --from=composer/composer:2 /usr/bin/composer /usr/bin/composer

# Phalcon provider, selected at build time (v5 = C extension via PIE, v6 = composer package).
# PIE (php/pie) replaces pecl; it builds the extension from the Packagist source, so it is not
# bound by pecl's stale release metadata, and it auto-enables the extension.
RUN <<EOT
set -eux
if [ "${PHALCON_VARIANT}" = "v5" ]; then
    apt-get update -y
    apt-get install -yq --no-install-recommends ${PHPIZE_DEPS}
    curl -fsSL https://github.com/php/pie/releases/latest/download/pie.phar -o /usr/local/bin/pie
    chmod +x /usr/local/bin/pie
    pie install --no-interaction phalcon/cphalcon:${PHALCON_V5_CONSTRAINT}
    php -m | grep -i phalcon
    apt-get clean -y
    rm -rf /var/lib/apt/lists/*
fi
EOT

COPY resources/docker/extra.ini /usr/local/etc/php/conf.d/zz-invo.ini
COPY --chown=${UID}:${GID} resources/docker/.bashrc /home/${USER}/.bashrc

# Writable HOME / Composer home for the unprivileged user.
ENV HOME=/home/${USER} \
    COMPOSER_HOME=/home/${USER}/.composer

# Create /app owned by the unprivileged user so `composer install` can write vendor/
RUN install -d -m 0775 -o "${USER}" -g "${GROUP}" /app

WORKDIR /app
COPY --chown=${UID}:${GID} . /app

USER ${USER}

# Install dependencies. phalcon/migrations tracks dev-master, whose master branch
# dropped the ext-phalcon requirement, so a plain install works for both variants.
RUN composer install --prefer-dist --no-interaction --no-progress

EXPOSE 8080

ENTRYPOINT ["bash", "bin/docker-entrypoint.sh"]
# APP_PORT (from .env) lets the user choose the listen port; defaults to 8080.
CMD php -S 0.0.0.0:${APP_PORT:-8080} -t public .htrouter.php
