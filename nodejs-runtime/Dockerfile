# Stage 1 - BUILD
# -----------------------------------------------------------
FROM andidittrich/debian-raw:9.8 as build

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        ca-certificates apt-transport-https
    
# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        nodejs yarn \
    && chmod 0770 /srv \
    && chown -R www-data:www-data /srv \
    && yarn --version \
    && nodejs --version

# default working dir
WORKDIR /srv/app

# user downgrade
USER www-data

# start nodejs
ENTRYPOINT [ "/usr/bin/nodejs" ]
