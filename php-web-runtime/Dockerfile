# Stage 1 - BUILD
# -----------------------------------------------------------
FROM localhost/debian-raw as build

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
        php7.4-cgi php7.4-curl php7.4-gd php7.4-intl php7.4-json \
        php7.4-mbstring php7.4-mysql php7.4-opcache php7.4-xml php7.4-zip \
    && rm -rf /etc/php/7.4 \
    && mkdir -p /etc/php/7.4/cli/conf.d \
    && mkdir -p /etc/php/7.4/cgi/conf.d \
    && ln -s /etc/php/php.production.ini /etc/php/7.4/cgi/php.ini \
    && ln -s /etc/php/php.production.ini /etc/php/7.4/cli/php.ini \
    && ln -s /etc/php/php.cli.ini /etc/php/7.4/cli/conf.d/cli.ini \
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
