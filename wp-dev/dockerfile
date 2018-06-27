FROM php:7.2-cli-alpine AS BASE

# wordpress release
ARG WP_VERSION=4.9.6
ARG WP_CHECKSUM=40616b40d120c97205e5852c03096115c2fca537
ARG WP_ARCHIVE=wordpress-${WP_VERSION}.tar.gz

WORKDIR /srv

# system setup
RUN set -xe \
    && chown www-data:www-data /srv \
    && apk --update --no-cache add \
        ca-certificates \
        bash \
        libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev freetype-dev \
    && docker-php-ext-configure gd                 \
        --with-freetype-dir=/usr/include/       \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install \
        gd \
        mysqli
 
# system user
USER www-data

# download wordpress and verify checksum
RUN set -xe \
    && cd /srv \
    && echo "${WP_CHECKSUM}  ${WP_ARCHIVE}" > /srv/checksum \
    && wget https://wordpress.org/${WP_ARCHIVE} \
    && sha1sum -c checksum \
    && tar -xzf ${WP_ARCHIVE} \
    && mv wordpress public \
    && rm ${WP_ARCHIVE}

# php routing script used by integrated webserver
# http://php.net/manual/en/features.commandline.webserver.php
# override wp-config
COPY fs/ /

# webserver port
EXPOSE 8080/tcp

# run php webserver
ENTRYPOINT [ "/usr/local/bin/php" ]
CMD [ "-S", "0.0.0.0:8080", "-t", "/srv/public", "/srv/router.php" ]