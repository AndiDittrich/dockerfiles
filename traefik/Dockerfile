# Stage 1 - BUILD
# -----------------------------------------------------------
FROM busybox as build

# copy additional files
COPY fs/ /tmp/build

# install packages
RUN set -xe \
    && chown -R runtime:runtime /tmp/build/etc/traefik \
    && mkdir /tmp/traefik \
    && wget -O /tmp/traefik.tgz https://github.com/containous/traefik/releases/download/v2.0.2/traefik_v2.0.2_linux_amd64.tar.gz \
    && tar xfz /tmp/traefik.tgz -C /tmp/traefik \
    && mkdir -p /tmp/build/bin \
    && mv /tmp/traefik/* /tmp/build/bin \
    && ls -all /tmp/build

# Stage 2 - MERGE
# -----------------------------------------------------------
FROM busybox as merge

# copy files
COPY --from=build /tmp/build /

# user downgrade
USER runtime

# set entrypoint
ENTRYPOINT [ "/bin/traefik" ]