# Stage 1 - BUILD
# -----------------------------------------------------------
FROM debian-raw:9.9 as build

# rootfs dir
ARG ROOTFS=/tmp/rootfs

# use bash as default shell (brace expansion..)
SHELL ["/bin/bash", "-c"]

# add additional files to rootfs
COPY fs/ /tmp/rootfs

# create rootfs structure
RUN set -xe \
    && apt-get update \
    && apt-clean-install wget tzdata \
    && mkdir -p ${ROOTFS}/{bin,dev,etc,lib,mnt,opt,root,sbin,srv,tmp,usr,var} \
    && ls -all ${ROOTFS} \
    && mkdir -p ${ROOTFS}/usr/{bin,sbin,lib} \
    && cp /usr/share/zoneinfo/UCT ${ROOTFS}/etc/localtime \
    && chmod -R 0755 ${ROOTFS} \
    && chmod 0700 ${ROOTFS}/root \
    && chmod 1777 ${ROOTFS}/tmp

# download+extract busybox
RUN set -xe \
    && wget -O ${ROOTFS}/usr/bin/busybox https://busybox.net/downloads/binaries/1.31.0-defconfig-multiarch-musl/busybox-x86_64 \
    && chmod 0755 ${ROOTFS}/usr/bin/busybox \
    && chroot /${ROOTFS} /usr/bin/busybox --install \
    && rm ${ROOTFS}/linuxrc

# Stage 2 - merge
# -----------------------------------------------------------
FROM scratch as merge

# copy rootfs
COPY --from=build /tmp/rootfs /

# use /etc/profile
ENV ENV="/etc/profile"

# set busybox as default entrypoint
ENTRYPOINT [ "/usr/bin/busybox", "ash" ]