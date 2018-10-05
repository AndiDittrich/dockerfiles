DEBIAN Base Image Builder
==============================

minimal debian **rootfs** build with debootstrap

## Features ##

* Minimal Debian Image `~55MB`
* Preinstalled bash
* `rc.d` dummmy scripts
* `apt-clean-install` script

## Motivation ##

1. Security
2. Reliability
3. Transparency

## Usage ##

**Requires** to run docker without user-namespace-remapping during build - see [moby #34645](https://github.com/moby/moby/issues/34645) related to multistage builds

### 1. Create rootfs ##

Run the `build.sh` script as root to create the initial root file system via **debootstrap**

### 2. Create optimized Docker Image ##

Run `docker build -t debian:stretch .` to build the docker image. This step removes unnecessary packages + files from the image and merges all layers finally.

