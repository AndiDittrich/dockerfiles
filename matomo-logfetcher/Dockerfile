# Stage 1 - BUILD
# -----------------------------------------------------------
FROM python2-runtime:latest as build

# copy files
COPY --chown=runtime:runtime fs/ /

# install packages
USER root
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        openssh-client gzip

# user downgrade
USER runtime

# download+extract matomo
RUN set -xe \
    && curl -o /tmp/matomo.tgz -O https://codeload.github.com/AndiDittrich/matomo-log-analytics/tar.gz/master \
    && tar xfz /tmp/matomo.tgz -C /srv/app/matomo --strip-components=1

WORKDIR /srv/app
ENTRYPOINT [ "/bin/bash" ]
