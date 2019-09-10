# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# install packages
RUN set -xe \
    && apt-get update \
    && rm /etc/cron.daily/* \
    && rm -rf /etc/cron.d \
    && apt-clean-install \ 
        anacron \
    && mkdir /srv/spool \
    && chown runtime:runtime /srv/spool

# add additional files/override existing
COPY fs/ /

# start anacron within infinite loop; don't fork; Serialize execution of jobs
ENTRYPOINT [ "/usr/bin/anacrond" ]