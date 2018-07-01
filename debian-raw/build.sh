#!/usr/bin/env bash

# command trace string
PS4='\e[0;36m[command] $ \e[0m'

# get current directory - rootfs cp destination
BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# fail on errors, enable command tracing
set -xe

# create temp dir
TMP_DIR=`mktemp -d`

# create minimal debian rootfs
debootstrap \
    --arch=amd64 \
    --variant=minbase \
    --merged-usr \
    --verbose \
    --include=apt-utils \
    stretch \
    $TMP_DIR \
    http://httpredir.debian.org/debian/

# create archive in basedir
cd $TMP_DIR
tar cf /$BASEDIR/rootfs.tar * --owner=root --group=root

# delete temp dir
rm -rf $TMP_DIR