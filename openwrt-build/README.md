OpenWRT encapsulated build environment
========================================

build openwrt firmware images within docker container. based on debian 9.4

Current Snapshot
-------------------

* Tag: `v18.06.0-rc1`

Usage
-------------------

### Step 0 - Build the docker image ###

This step is optionally (build image from source). It installs the **build environment**, fetches the **openwrt git repository** and adds the related **feeds**

```bash
# run docker-build via GitHub Docker file
docker build https://github.com/AndiDittrich/dockerfiles.git#master:openwrt-build

# OR run docker-build in the current directory (cloned repo)
# docker build -t openwrt-build-1806rc .
```

### Step 1 - Start a new docker container and attach it ###

```bash
# run docker in interactive mode - container is named openwrt-env based on previous created image
docker run -it --name openwrt-env openwrt-build-1806rc

# the entrypoint is set to /bin/bash. you can terminate the container by typing "exit<enter>"

# to "restart" the container just run docker start
docker start -i openwrt-env
```

### Step 2 - Setup build configuration and run make ###

Note: building the specific toolchain will initially take some time depending on your cpu resources (+20min)

```bash
# set target device
make menuconfig

# set defaults
make defconfig

# change config
make menuconfig

# fetch packages
make download

# build (n+1 core)
make -j5
```

### Step 3 - Copy the firmware files ###



References/Docs
-------------------

* [Quick Image Building Guide](https://openwrt.org/docs/guide-developer/quickstart-build-images) | openwrt.org
* [Build system Usage](https://openwrt.org/docs/guide-developer/build-system/use-buildsystem) | openwrt.org


Device References 
-------------------

* [Linksys WRTxxxAC Series](https://openwrt.org/toh/linksys/wrt_ac_series)