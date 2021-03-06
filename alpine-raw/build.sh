#!/usr/bin/env bash

# merge the default alpine rootfs with some modified files
# in the future this can be replaced by a multistage build but during some bugs https://github.com/moby/moby/issues/34645
# with user-namespace-remapping this has to be done outside the docker environment

# command trace string
PS4='\e[0;36m[command] $ \e[0m'

# fail on errors, enable command tracing
set -xe

# vars
ALPINE_RELEASE_VERSION="3.8"
ALPINE_PATCH_VERSION="3.8.0"
ALPINE_FILENAME="alpine-minirootfs-${ALPINE_PATCH_VERSION}-x86_64.tar.gz"
ALPINE_URL="http://dl-cdn.alpinelinux.org/alpine/v${ALPINE_RELEASE_VERSION}/releases/x86_64/${ALPINE_FILENAME}"
NOW=`date`

# create temp dir
TMP_DIR=`mktemp -d`
mkdir $TMP_DIR/fs

# fetch latest alpine image
wget $ALPINE_URL -O $TMP_DIR/${ALPINE_FILENAME}

# checksum verification
#sha256sum -c checksums.sha256

# uncompress alpine rootfs
fakeroot sh -c "
    tar xfz $TMP_DIR/${ALPINE_FILENAME} -C $TMP_DIR/fs
"

# copy additional files
cp -R fs/* $TMP_DIR/fs

# get os release vars
echo "Release $ALPINE_PATCH_VERSION | Build $NOW" >> $TMP_DIR/fs/etc/motd

# create new rootfs
fakeroot sh -c "
    cd $TMP_DIR/fs
    tar cf $TMP_DIR/rootfs.tar * --owner=root --group=root
"

# trigger docker build
docker build -t alpine-raw:${ALPINE_RELEASE_VERSION} --build-arg ROOTFS=$TMP_DIR/rootfs.tar .

# delete temp dir
rm -rf $TMP_DIR