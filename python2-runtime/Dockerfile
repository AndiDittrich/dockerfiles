# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        ca-certificates apt-transport-https curl
    
# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        python2.7 \
    && chmod 0770 /srv \
    && chown -R runtime:runtime /srv \
    && python2.7 --version \
    && ln -s /usr/bin/python2.7 /usr/bin/python 

# default working dir
WORKDIR /srv/app

# user downgrade
USER runtime

# start python, pass args via CMD
ENTRYPOINT [ "/usr/bin/python2.7" ]
