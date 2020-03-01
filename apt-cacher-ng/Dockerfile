# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        apt-cacher-ng \
    && chown runtime:runtime /var/cache/apt-cacher-ng

# proxy port
EXPOSE 3142/tcp

# user downgrade
USER runtime

# start apt-cacher; no daemonize!
ENTRYPOINT [ "/usr/sbin/apt-cacher-ng", "-c" , "/etc/apt-cacher" ]
