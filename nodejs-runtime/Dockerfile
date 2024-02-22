# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw as build
 
# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        nodejs yarn \
    && chmod 0770 /srv \
    && chown -R runtime:runtime /srv \
    && yarn --version \
    && nodejs --version

# default working dir
WORKDIR /srv/app

# user downgrade
USER runtime

# start nodejs
ENTRYPOINT [ "/usr/bin/nodejs" ]
