# Stage 1 - BUILD
# -----------------------------------------------------------
FROM php-web-runtime:latest as build

# add additional files/override existing
COPY --chown=www-data:www-data fs/ /

# download+extract phpmyadmin
RUN set -xe \
    && curl -o /tmp/pma.tgz -O https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz \
    && tar xfz /tmp/pma.tgz -C /srv/app/public --strip-components=1 \
    && rm -rf /srv/app/public/setup /srv/app/public/examples /srv/app/public/config.sample.inc.php
