# Stage 1 - BUILD
# -----------------------------------------------------------
FROM andidittrich/debian-raw:9.5 as build

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        util-linux ca-certificates \
        php7.0-fpm php7.0-curl php7.0-gd php7.0-intl php7.0-json \
        php7.0-mbstring php7.0-mysql php7.0-opcache php7.0-xml php7.0-zip \
    && rm -rf /etc/php/7.0 \
    && mkdir -p /etc/php/7.0/cli/conf.d \
    && ln -s /etc/php/php.production.ini /etc/php/7.0/cli/php.ini \
    && ln -s /etc/php/php.cli.ini /etc/php/7.0/cli/conf.d/cli.ini \
    && chmod 0770 /srv \
    && chown -R www-data:www-data /srv

# php-fpm port
EXPOSE 9000/tcp

# default working dir
WORKDIR /srv

# user downgrade
USER www-data

# start php-fpm
ENTRYPOINT [ "/usr/sbin/php-fpm7.0", "--nodaemonize" , "--fpm-config", "/etc/php/php-fpm.ini", "--php-ini", "/etc/php/php.production.ini"]
