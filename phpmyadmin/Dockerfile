# Stage 1 - BUILD
# -----------------------------------------------------------
FROM php-web-runtime:latest as build

# add additional files/override existing
COPY --chown=www-data:www-data fs/ /

# download+extract phpmyadmin
RUN set -xe \
    && curl -o /tmp/pma.tgz -O https://files.phpmyadmin.net/phpMyAdmin/4.8.5/phpMyAdmin-4.8.5-english.tar.gz \
    && tar xfz /tmp/pma.tgz -C /srv/app/public --strip-components=1 \
    && rm -rf /srv/app/public/setup /srv/app/public/examples /srv/app/public/config.sample.inc.php
