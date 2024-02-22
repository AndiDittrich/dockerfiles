prometheus blackbox-exporter
=========================================

busybox based [prometheus-exporter](https://github.com/prometheus/blackbox_exporter) image including ca-certificates

[Official exporter documentation](https://github.com/prometheus/blackbox_exporter/blob/master/CONFIGURATION.md)

**Testing**

```bash
docker run -it --rm -p 9115:9115 prometheus-blackbox
```