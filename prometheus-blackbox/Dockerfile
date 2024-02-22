# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian:latest as build

# install packages
RUN set -xe \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates

# additional binary packages
COPY .packages/ /tmp

# copy additional files
COPY fs/ /tmp/build

# add certificates
# && wget -O /tmp/pkg.tgz https://github.com/prometheus/blackbox_exporter/releases/download/v0.16.0/blackbox_exporter-0.16.0.linux-amd64.tar.gz \
RUN set -xe \
    && mkdir /tmp/pkg \
    && tar xfz /tmp/blackbox_exporter-0.16.0.linux-amd64.tar.gz -C /tmp/pkg --strip-components=1 \
    && ls -all /tmp/pkg \
    && mkdir -p /tmp/build/etc/ssl/certs \
    && mkdir -p /tmp/build/bin \
    && mv /tmp/pkg/blackbox_exporter /tmp/build/bin \
    && cp -R /etc/ssl/certs/* /tmp/build/etc/ssl/certs

# Stage 2 - MERGE
# -----------------------------------------------------------
FROM busybox as merge

# copy files
COPY --chown=runtime:runtime --from=build /tmp/build /

# user downgrade icmp ping not working
# see https://github.com/prometheus/blackbox_exporter/issues/147
#USER runtime

# set entrypoint
# debug "--log.level=debug"
ENTRYPOINT [ "/bin/blackbox_exporter", "--config.file=/conf/blackbox.yml", "--log.level=debug"]