DEBIAN Base Image Builder
==============================

minimal debian **rootfs** build with [multistrap](https://manpages.debian.org/stretch/multistrap/multistrap.1.en.html) within an isolated docker environment (requires prebuild debian image)

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

### Create rootfs + optimized Docker Image##

Run the `build.sh` script to trigger the rootfs container build.  This step removes unnecessary packages + files from the image and merges all layers finally.

it builds the image **debian-raw-build** and a container for testing named **debian-raw-env**

