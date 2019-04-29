FROM php-web-runtime AS BASE

# wordpress release
ARG WP_VERSION=5.2-RC1
ARG WP_CHECKSUM=eff51436e750e607de7853fb6307b24dfe8782da
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
    && sha1sum /tmp/wp.tgz \
    && sha1sum -c checksum \
    && tar xfz /tmp/wp.tgz -C /srv/app/public --strip-components=1

# override wp-config
COPY --chown=www-data:www-data fs/ /