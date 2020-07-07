FROM php-web-runtime AS BASE

# wordpress release
ARG WP_VERSION=5.4.2
#ARG WP_CHECKSUM=fded476f112dbab14e3b5acddd2bcfa550e7b01b
ARG WP_ARCHIVE=wordpress-${WP_VERSION}.tar.gz
ARG WP_CLI_URL=https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

# install packages as root
USER root

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        wget less \ 
    && wget ${WP_CLI_URL} -O /usr/bin/wp-cli \
    && chmod +x /usr/bin/wp-cli

# user downgrade
USER www-data

# download wordpress and verify checksum
RUN set -xe \
    && cd /srv \
    && echo "${WP_CHECKSUM} /tmp/wp.tgz" > /srv/checksum \
    && wget -O /tmp/wp.tgz https://wordpress.org/${WP_ARCHIVE} \
    && tar xfz /tmp/wp.tgz -C /srv/app/public --strip-components=1

# override wp-config
COPY --chown=www-data:www-data fs/ /
#    && sha1sum /tmp/wp.tgz \
#    && sha1sum -c checksum \

# data volumes
VOLUME [ "/srv/app/public/wp-content" ]