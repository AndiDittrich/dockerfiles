# Stage 0 - ROOTFS
# -----------------------------------------------------------

# debian base system is required to build the rootfs via multistrap
FROM debian:12 as rootfs

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive
ENV DEBCONF_NONINTERACTIVE_SEEN=true
ENV LC_ALL=C LANGUAGE=C LANG=C
ENV USER=debian-boostrap

# Add build dependencies
RUN set -xe \
    && apt-get update \
    && apt-get install -y \
        util-linux build-essential debian-archive-keyring

# add utils
RUN set -xe \        
    && apt-get install -y \
       multistrap \
    && mkdir -p /tmp/rootfs/etc/apt/trusted.gpg.d

COPY fs/etc/apt/trusted.gpg.d /tmp/rootfs/etc/apt/trusted.gpg.d

# copy mutlistrap config
COPY multistrap/ /etc/multistrap

# Run multistrap build
RUN set -xe \
    && cat /etc/multistrap/multistrap.ini \
    && multistrap \
        -a amd64 \
        -d /tmp/rootfs \
        -f /etc/multistrap/multistrap.ini \
    && du -sh /tmp/rootfs

# Stage 1 - POSTBUILD env (debian)
# -----------------------------------------------------------
FROM scratch as postbuild

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# expand rootfs created via debootstrap
COPY --from=rootfs /tmp/rootfs /

# add additional files/override existing
COPY fs/ /

# required packages are set to HOLD
RUN set -xe \
    && apt-mark hold apt adduser passwd

# remove unnecessary files
RUN set -xe \
    && rm -rf \
        /lib/lsb \
        /etc/systemd \
        /var/log/* \
        /var/lib/apt/lists/* \
        /var/cache/debconf/* \
        /var/cache/apt/* \
        /usr/share/man/* \
        /usr/share/info/* \
        /usr/share/locale/* \
        /usr/share/docs/*

# create dummy directory structures (may required by additional packages!)
RUN set -xe \
    && mkdir -p /usr/share/man/man{1,2,3,4,5,6,7,8}

# default user
RUN set -xe \
    && useradd --system runtime \
    && usermod --home /srv runtime

# show final size
RUN set -xe \
    && du -shxc / \
    && cat /etc/debian_version

# Stage 2 - MERGE LAYERS
# -----------------------------------------------------------
FROM scratch as release

# copy rootfs
COPY --from=postbuild / /

# start bash
ENTRYPOINT [ "/bin/bash" ]
