traefik ingress routing
================================

busybox based image for [traefik](https://traefik.io/) - to be used as ingress load balancer/proxy **without** default docker swarm ingress routing

Features
---------------

* Running standalone via `file` provider without access to the docker daemon socket
* Static configuration file stored in `/etc/traefik/traefik.yml`
* Dynamic configuration files stored in `/etc/treafik/conf.d/*.yml`
* Executed as non-privileg user `runtime` (userid `999` / or `232071` with default namespace remapping)
* Using alternative ports `8080` for http and `8081` for https