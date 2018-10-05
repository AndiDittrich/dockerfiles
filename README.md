Public Dockerfile Library
==============================

Docker Hub Repository: [https://hub.docker.com/r/andidittrich/](https://hub.docker.com/r/andidittrich/)

Index
----------------------------

**Base Images**

* [debian-raw](debian-raw/) | Minimal Debian image including multistrap based build system `~55MB`
* [alpine-raw](alpine-raw/) | Minimal Alpine Linux image directly based on mini-root-filesystem

**Runtime**

* [php-runtime](php-runtime/) | PHP 7.0 FPM runtime
* [php-runtime-dev](php-runtime-dev/) | PHP 7.0 development via [php build-in webserver](http://php.net/manual/en/features.commandline.webserver.php)

**Web Development**

* [wp-dev](wp-dev/) | WordPress plugin test runtime

**Embedded**

* [openwrt-build](openwrt-build/) | OpenWRT encapsulated build environment

**Deprecated**

* [debian-raw-external-debootstrap](.deprecated/debian-raw-external-debootstrap/) | Minimal Debian image via debootstrap and external rootfs build

License
------------------------------
The Dockerfiles are OpenSource and licensed under the Terms of [Mozilla Public License 2.0](https://opensource.org/licenses/MPL-2.0) - your're welcome to contribute