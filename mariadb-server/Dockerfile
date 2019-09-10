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
    && chown runtime:runtime /var/run/mysqld

# std mysql port
EXPOSE 3306/tcp

# user downgrade
USER runtime

# start mariadb; no daemonize!
ENTRYPOINT [ "/usr/sbin/mysqld" ]
