# Stage 1 - BUILD
# -----------------------------------------------------------
FROM andidittrich/debian-raw:9.8 as build

# version
ARG PYTHON_VERSION="3.6.8"

# install packages --enable-optimizations
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        ca-certificates apt-transport-https curl \
        make build-essential libssl-dev zlib1g-dev \
        libbz2-dev libreadline-dev libsqlite3-dev wget llvm \
        libncurses5-dev  libncursesw5-dev xz-utils tk-dev \
    && wget -O /tmp/python.tgz https://www.python.org/ftp/python/${PYTHON_VERSION}/Python-${PYTHON_VERSION}.tgz \
    && mkdir /tmp/build /tmp/runtime \
    && tar xfz /tmp/python.tgz -C /tmp/build --strip-components=1 \
    && cd /tmp/build \
    && ./configure  --prefix=/tmp/runtime \
    && make -j9 \
    && make install \
    && rm -rf /tmp/build

# Stage 2 - Production - copy results
# -----------------------------------------------------------
FROM andidittrich/debian-raw:9.8 as runtime

# install packages
RUN set -xe \
    && apt-get update \
    && apt-clean-install \ 
        ca-certificates apt-transport-https curl

COPY --from=build /tmp/runtime /opt/python
