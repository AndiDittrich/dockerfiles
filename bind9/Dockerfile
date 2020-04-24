# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        bind9 \
    && chown runtime:runtime /var/cache/bind

# dns port
EXPOSE 10053/tcp 10053/udp

# config
VOLUME [ "/etc/bind9" ]
VOLUME [ "/var/cache/bind" ]

# user downgrade
USER runtime

# start bind9; no daemonize; ip4 only
ENTRYPOINT [ "/usr/sbin/named", "-4", "-g", "-c" , "/etc/bind9/named.conf" ]
