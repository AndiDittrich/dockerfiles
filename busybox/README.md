busybox Base Image Builder
==============================

minimal busybox **rootfs** based on official binaries

## Features ##

* Minimal busybox image `~1.07MB`
* fancy colorprompt (via /etc/profile)
* default utc timezone
* `runtime` user/group to execute the service (uid/gid 999)

## Motivation ##

1. Security
2. Reliability
3. Transparency

## Usage ##

**Requires** to run docker without user-namespace-remapping during build - see [moby #34645](https://github.com/moby/moby/issues/34645) related to multistage builds

### Create rootfs + optimized Docker Image ##

```bash
docker build -t busybox .
```

## License ##

BusyBox is licensed under the [GNU General Public License version 2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)