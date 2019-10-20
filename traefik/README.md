traefik ingress routing
================================

busybox based image for [traefik](https://traefik.io/) - to be used as ingress load balancer/proxy **without** default docker swarm ingress routing

Features
---------------

* Running standalone via `file` provider without access to the docker daemon socket
* Static configuration file stored in `/etc/traefik/traefik.yml`
* Dynamic configuration files stored in `/etc/traefik/conf.d/*.yml`
* Executed as non-privileged user `runtime` (userid `999` / or `232071` with default namespace remapping)