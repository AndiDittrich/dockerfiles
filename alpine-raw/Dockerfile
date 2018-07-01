# STAGE 1 - MERGE LAYERS
# ---------------------------------------------------------------------------

# rootfs location as arg
ARG ROOTFS=rootfs.tar

# clean environment
FROM scratch as release

# expand rootfs image
ADD ${ROOTFS} /

# shell as default entry point
ENTRYPOINT [ "/bin/sh" ]
