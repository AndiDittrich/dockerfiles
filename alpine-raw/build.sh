#!/usr/bin/env bash

# merge the default alpine rootfs with some modified files
# in the future this can be replaced by a multistage build but during some bugs https://github.com/moby/moby/issues/34645
# with user-namespace-remapping this has to be done outside the docker environment

# fail on errors
set -xe

# vars
ALPINE_RELEASE_VERSION="3.8"
ALPINE_PATCH_VERSION="3.8.0"
ALPINE_FILENAME="alpine-minirootfs-${ALPINE_PATCH_VERSION}-x86_64.tar.gz"
ALPINE_URL="http://dl-cdn.alpinelinux.org/alpine/v${ALPINE_RELEASE_VERSION}/releases/x86_64/${ALPINE_FILENAME}"

# create temp dir
mkdir -p build/fs

# fetch latest alpine image
wget $ALPINE_URL -O build/${ALPINE_FILENAME}

# checksum verification
sha256sum -c checksums.sha256

# uncompress alpine rootfs
# copy additional files
# create new rootfs
fakeroot sh -c "
    tar xfz build/${ALPINE_FILENAME} -C build/fs
    cp -R fs/* build/fs
    cd build/fs
    tar cf ../rootfs.tar * --owner=root --group=root
"

# trigger docker build
docker build -t alpine-raw:${ALPINE_RELEASE_VERSION} .

# delete temp dir
rm -rf build