FROM debian:9.4

# system base packages + build dependencies + user setup
RUN set -xe \
    && apt-get update \
    && apt-get install -y --no-install-recommends \ 
        nano bash ca-certificates \
        subversion g++ zlib1g-dev build-essential git python \
        rsync libncurses5-dev gawk gettext unzip file libssl-dev wget zip time \
    && rm -rf /var/lib/apt/lists/* \
    && useradd build \
    && mkdir /home/build \
    && chown build:build /home/build

# run as build user
USER build

# clone openwrt repo
RUN set -xe \
    && cd /home/build \
    && git clone https://git.openwrt.org/openwrt/openwrt.git openwrt

# fetch branch/tag and update feeds
RUN set -xe \
    && cd /home/build/openwrt \
    && git checkout v18.06.0-rc1 \
    && ./scripts/feeds update -a \
    && ./scripts/feeds install -a

# working dir
WORKDIR /home/build/openwrt

# start bash
ENTRYPOINT [ "/bin/bash" ]