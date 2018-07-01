FROM andidittrich/debian-raw:9.4

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        util-linux \
        php7.0-fpm php7.0-curl php7.0-gd php7.0-intl php7.0-json \
        php7.0-mbstring php7.0-mysql php7.0-opcache php7.0-xml php7.0-zip \
    && chown www-data:www-data /srv

# php-fpm port
EXPOSE 9000/tcp

# default working dir
WORKDIR /srv

# start php-fpm
ENTRYPOINT [ "/usr/sbin/php-fpm7.0", "--nodaemonize" , "--fpm-config", "/etc/php/php-fpm.ini"]

# config options
CMD 