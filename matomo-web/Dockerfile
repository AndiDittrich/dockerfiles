# Stage 1 - BUILD
# -----------------------------------------------------------
FROM php-web-runtime:latest as build

# add additional files/override existing
COPY --chown=www-data:www-data fs/ /

# download+extract matomo
RUN set -xe \
    && curl -o /tmp/matomo.tgz -O https://builds.piwik.org/matomo-3.9.1.tar.gz \
    && tar xfz /tmp/matomo.tgz -C /srv/app/public --strip-components=1 \
    && curl -o /tmp/geolite2.tgz -O https://geolite.maxmind.com/download/geoip/database/GeoLite2-City.tar.gz \
    && tar xfz /tmp/geolite2.tgz -C /srv/app/public/misc --strip-components=1 \
    && rm -rf /srv/app/public/tests
