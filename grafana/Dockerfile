# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# additional binary packages
COPY .packages/ /tmp

# copy additional files
COPY fs/ /tmp/build

# install packages
RUN set -xe \
    && mkdir /tmp/pkg \
    && tar xfz /tmp/grafana-6.7.3.linux-amd64.tar.gz -C /tmp/pkg --strip-components=1 \
    && ls -all /tmp/pkg \
    && mkdir -p /tmp/build/bin \
    && mkdir -p /tmp/build/etc/grafana \
    && mkdir -p /tmp/build/usr/share/grafana/conf \
    && mkdir -p /tmp/build/usr/share/grafana/public \
    && mkdir -p /tmp/build/srv/public \
    && mkdir -p /tmp/build/mnt/data/log \
    && chown -R runtime:runtime /tmp/build/mnt/data \
    && cp -RT /tmp/pkg/bin /tmp/build/bin \
    && cp -RT /tmp/pkg/conf /tmp/build/usr/share/grafana/conf \
    && cp -RT /tmp/pkg/public /tmp/build/usr/share/grafana/public \
    && chmod 0755 /tmp/build/bin/*

# Stage 2 - MERGE
# -----------------------------------------------------------
FROM debian-raw:9.9 as merge

# copy files
COPY --from=build /tmp/build /

# user downgrade
USER runtime

# storage volume
VOLUME [ "/mnt/data" ]

# install plugins
RUN set -xe \
    && grafana-cli --pluginsDir /mnt/data/plugins plugins install grafana-piechart-panel \
    && grafana-cli --pluginsDir /mnt/data/plugins plugins install grafana-polystat-panel \
    && grafana-cli --pluginsDir /mnt/data/plugins plugins install grafana-worldmap-panel

# set entrypoint
ENTRYPOINT [ "/bin/grafana-server", "--homepath", "/usr/share/grafana", "--config", "/etc/grafana/grafana.ini", "cfg:default.paths.logs=/mnt/data/log"]
