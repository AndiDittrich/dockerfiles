#!/usr/bin/env bash

set -xe

# build image
docker build -t debian-raw-build .

# remove old env container
docker container rm debian-raw-env

# create container
docker create --tty --name debian-raw-env --interactive debian-raw-build