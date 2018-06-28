#!/usr/bin/env bash

# to merge the default alpine rootfs with some modified files
# in the future this can be replaced by a multistage build but during some bugs https://github.com/moby/moby/issues/34645
# with user-namespace-remapping this has to be done outside the docker environment

# fail on errors
set -xe

# create temp dir
mkdir -p .tmp

# uncompress alpine rootfs
# copy additional files
# create new rootfs
fakeroot sh -c '
    tar xfz alpine-minirootfs-3.8.0-x86_64.tar.gz -C .tmp
    cp -R fs/* .tmp
    cd .tmp
    tar cf ../rootfs.tar * --owner=root --group=root
'

# delete temp dir
rm -rf .tmp

# trigger docker build
docker build -t alpine-base:3.8 .