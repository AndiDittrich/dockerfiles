FROM andidittrich/php-runtime-dev:7.0 AS BASE

# wordpress release
ARG WP_VERSION=5.1.1
ARG WP_CHECKSUM=f1bff89cc360bf5ef7086594e8a9b68b4cbf2192
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
    && echo "${WP_CHECKSUM}  ${WP_ARCHIVE}" > /srv/checksum \
    && wget https://wordpress.org/${WP_ARCHIVE} \
    && sha1sum ${WP_ARCHIVE} \
    && sha1sum -c checksum \
    && tar -xzf ${WP_ARCHIVE} \
    && mv wordpress/* /srv/app \
    && rm ${WP_ARCHIVE}

# override wp-config
COPY --chown=www-data:www-data fs/ /

ENTRYPOINT [ "/bin/bash" ]