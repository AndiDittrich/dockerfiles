# Stage 1 - POSTBUILD env (debian)
# -----------------------------------------------------------
FROM scratch as postbuild

# don't show user interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# expand rootfs created via debootstrap
ADD rootfs.tar /

# show release version
RUN cat /etc/debian_version

# add additional files/override existing
COPY fs/ /

# remove unnecessary packages
# force command via 'Yes, do as I say!'
RUN set -xe \
    && echo 'Yes, do as I say!' | apt-get purge \
        mount \
        e2fslibs \
        e2fsprogs \
        sysvinit-utils \
        ncurses-base \
        ncurses-bin \
        libsystemd0 \
        libmount1 \
        libfdisk1

# cleanup apt cache
RUN set -xe \
    && apt-get autoremove \
    && apt-get clean

# remove unnecessary files
RUN set -xe \
    && rm -rf \
        /lib/lsb \
        /etc/systemd \
        /var/log/* \
        /var/lib/apt/lists/* \
        /var/cache/debconf/* \
        /usr/share/man/* \
        /usr/share/info/* \
        /usr/share/locale/*

# create dummy directory structures (may required by additional packages!)
RUN set -xe \
    && mkdir -p /usr/share/man/man{1,2,3,4,5,6,7,8}

# Stage 2 - MERGE LAYERS
# -----------------------------------------------------------
FROM scratch as release

# copy rootfs
COPY --from=postbuild / /

# start bash
ENTRYPOINT [ "/bin/bash" ]
