# STAGE 1 - MERGE LAYERS
# ---------------------------------------------------------------------------

# clean environment
FROM scratch as release

# expand rootfs image
ADD build/rootfs.tar /

# shell as default entry point
ENTRYPOINT [ "/bin/sh" ]
