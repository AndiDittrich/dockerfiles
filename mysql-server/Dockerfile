# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# install packages libwrap0
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        ca-certificates wget \
        libaio1
    
# add additional files/override existing
COPY fs/ /

# install packages
RUN set -xe \
    && mkdir -p /srv/mysql/data /var/run/mysqld/ /tmp/mysql \
    && chown runtime:runtime /srv/mysql/data /var/run/mysqld/ /tmp/mysql \
    && wget -O /tmp/mysql.tgz https://dev.mysql.com/get/Downloads/MySQL-5.5/mysql-5.5.62-linux-glibc2.12-x86_64.tar.gz \
    && tar xfz /tmp/mysql.tgz -C /srv/mysql --strip-components=1 \
    && rm /tmp/mysql.tgz \
    && rm -rf /srv/mysql/{docs,man,mysql-test,sql-bench,support-files}

# user downgrade
USER runtime

# install initial db
RUN set -xe \
    && /srv/mysql/scripts/mysql_install_db \
        --basedir=/srv/mysql \
        --datadir=/srv/mysql/data

# default working dir
WORKDIR /srv/mysql

# default mysql port
EXPOSE 3306

# start mysql server
ENTRYPOINT [ "/srv/mysql/bin/mysqld" ]
