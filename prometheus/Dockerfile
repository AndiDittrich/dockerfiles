# Stage 1 - BUILD
# -----------------------------------------------------------
FROM busybox as build

# additional binary packages
COPY .packages/ /tmp

# copy additional files
COPY fs/ /tmp/build

# install packages
#  && wget -O /tmp/pkg.tgz https://github.com/prometheus/prometheus/releases/download/v2.17.2/prometheus-2.17.2.linux-amd64.tar.gz \
RUN set -xe \
    && mkdir /tmp/pkg \   
    && tar xfz /tmp/prometheus-2.17.2.linux-amd64.tar.gz -C /tmp/pkg --strip-components=1 \
    && ls -all /tmp/pkg \
    && mkdir -p /tmp/build/bin \
    && mkdir -p /tmp/build/mnt/data \
    && mv /tmp/pkg/prometheus /tmp/build/bin

# Stage 2 - MERGE
# -----------------------------------------------------------
FROM busybox as merge

# copy files
COPY --chown=runtime:runtime --from=build /tmp/build /

# user downgrade
USER runtime

# storage volume
VOLUME [ "/mnt/data" ]

# set entrypoint
ENTRYPOINT [ "/bin/prometheus", "--config.file=/conf/prometheus.yml", "--storage.tsdb.path=/mnt/data", "--log.level=debug"]