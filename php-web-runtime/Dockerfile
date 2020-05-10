# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:10.3 as build

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        lighttpd spawn-fcgi curl \
        util-linux ca-certificates \
        php7.3-cgi php7.3-curl php7.3-gd php7.3-intl php7.3-json \
        php7.3-mbstring php7.3-mysql php7.3-opcache php7.3-xml php7.3-zip \
    && rm -rf /etc/php/7.3 \
    && mkdir -p /etc/php/7.3/cli/conf.d \
    && mkdir -p /etc/php/7.3/cgi/conf.d \
    && ln -s /etc/php/php.production.ini /etc/php/7.3/cgi/php.ini \
    && ln -s /etc/php/php.production.ini /etc/php/7.3/cli/php.ini \
    && ln -s /etc/php/php.cli.ini /etc/php/7.3/cli/conf.d/cli.ini \
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
