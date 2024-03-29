# Stage 1 - BUILD
# -----------------------------------------------------------
FROM localhost/debian-raw:12.1 as build

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        lighttpd lighttpd-mod-deflate spawn-fcgi curl \
        util-linux ca-certificates \
        php8.2-cgi php8.2-curl php8.2-gd php8.2-intl \
        php8.2-mbstring php8.2-mysql php8.2-opcache php8.2-xml php8.2-zip \
    && rm -rf /etc/php/8.2 \
    && mkdir -p /etc/php/8.2/cli/conf.d \
    && mkdir -p /etc/php/8.2/cgi/conf.d \
    && ln -s /etc/php/php.production.ini /etc/php/8.2/cgi/php.ini \
    && ln -s /etc/php/php.production.ini /etc/php/8.2/cli/php.ini \
    && ln -s /etc/php/php.cli.ini /etc/php/8.2/cli/conf.d/cli.ini \
    && chmod 0770 /srv \
    && chown -R www-data:www-data /srv

# alt www port
EXPOSE 8080/tcp

# default working dir
WORKDIR /srv/app

# user downgrade
USER www-data

# start lighttpd; no daemonize!
ENTRYPOINT [ "/usr/sbin/lighttpd", "-D" , "-f", "/etc/lighttpd/lighttpd.conf" ]
