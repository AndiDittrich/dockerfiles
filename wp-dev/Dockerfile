FROM andidittrich/php-runtime-dev:7.0 AS BASE

# wordpress release
ARG WP_VERSION=4.9.8
ARG WP_CHECKSUM=0945bab959cba127531dceb2c4fed81770812b4f
ARG WP_ARCHIVE=wordpress-${WP_VERSION}.tar.gz

# install packages as root
USER root

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        wget

# user downgrade
USER www-data

# download wordpress and verify checksum
RUN set -xe \
    && cd /srv \
    && echo "${WP_CHECKSUM}  ${WP_ARCHIVE}" > /srv/checksum \
    && wget https://wordpress.org/${WP_ARCHIVE} \
    && sha1sum ${WP_ARCHIVE} \
    && sha1sum -c checksum \
    && tar -xzf ${WP_ARCHIVE} \
    && mv wordpress/* /srv/app \
    && rm ${WP_ARCHIVE}

# override wp-config
COPY --chown=www-data:www-data fs/ /