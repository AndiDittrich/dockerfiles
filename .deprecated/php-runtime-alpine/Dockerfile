# base image including system libraries
# ----------------------------------------------------------
FROM alpine:3.8 as base

# install php dependencies
RUN set -xe \
    && apk --update --no-cache add \
        ca-certificates gzip tar \
        libpng libjpeg-turbo libwebp zlib freetype \
        libressl bzip2 libxml2 libcurl icu-libs \
        libpcre32 libbz2 bison re2c 

# install build dependencies and build php
# ----------------------------------------------------------
FROM base as builder

RUN set -xe \
    && apk --update --no-cache add \ 
        coreutils make binutils autoconf gcc g++ file \
        bash \
        libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev freetype-dev \
        libressl-dev bzip2-dev libxml2-dev curl-dev icu-dev \
    && mkdir /root/build

# fetch php
RUN set -xe \
    && cd /root/build \
    && wget http://de2.php.net/distributions/php-7.2.7.tar.bz2 -O php.tar.bz2 \
    && tar xfj php.tar.bz2

# @see https://github.com/docker-library/php/blob/master/7.2/alpine3.7/fpm/Dockerfile
# Apply stack smash protection to functions using local buffers and alloca()
# Make PHP's main executable position-independent (improves ASLR security mechanism, and has no performance impact on x86_64)
# Enable optimization (-O2)
# Enable linker optimization (this sorts the hash buckets to improve cache locality, and is non-default)
# Adds GNU HASH segments to generated executables (this is used if present, and is much faster than sysv hash; in this configuration, sysv hash is also generated)
# https://github.com/docker-library/php/issues/272
ENV PHP_CFLAGS="-fstack-protector-strong -fpic -fpie -O2"
ENV PHP_LDFLAGS="-Wl,-O1 -Wl,--hash-style=both -pie"

# configure
RUN set -xe \
    && export CFLAGS="$PHP_CFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && cd /root/build/php-7.2.7 \
    && ./configure \
        --enable-option-checking=fatal \
        --enable-fpm \
        --enable-bcmath \
        --enable-opcache \
        --enable-pdo \
        --enable-intl \
        --enable-soap \
        --with-xmlrpc \
        --with-mysqli \
        --with-curl \
        --enable-exif \
        --with-libzip \
        --with-bz2 \
        --with-gd \
        --with-freetype-dir=/usr/ \
        --with-jpeg-dir=/usr \
        --with-png-dir=/usr \
        --with-mhash \
        --with-pdo-mysql \
        --with-openssl \
        --enable-mbstring \
        --enable-debug=no \
        --with-config-file-path=/etc/php \
        --enable-calendar \
    && make -j "$(nproc)" \
    && make test


# release - copy prebuild phppackages
# ----------------------------------------------------------


ENTRYPOINT [ "/bin/bash" ]