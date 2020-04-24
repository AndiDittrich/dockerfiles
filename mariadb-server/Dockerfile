# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \
        bsdutils mariadb-server \
    && rm -rf /etc/mysql \
    && chown -R runtime:runtime /var/lib/mysql \
    && mkdir /var/run/mysqld/ \
    && chown runtime:runtime /var/run/mysqld \
    && /usr/sbin/mysqld-initial

# std mysql port
EXPOSE 3306/tcp

# std storage path
VOLUME [ "/var/lib/mysql" ]

# user downgrade
USER runtime

# start mariadb
ENTRYPOINT [ "/usr/sbin/mysqld" , "--defaults-file=/etc/mariadb.conf"]
