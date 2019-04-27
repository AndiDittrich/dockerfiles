phpmyadmin dockerized
=======================

**based on php-web-runtime (debian+lighttpd+php-fcgi)**

It is designed to manage multiple hosts from a centralized location

## Simplified Configuration ##

This images uses a simplified configuration file to define the server settings stored in `/etc/phpmyadmin.ini`.

```ini
; PHPMYADMIN simple server config

[ myserver1 ]
host = "server1.example.org"
port = "3306"

[ myserver2 ]
host = "server2.example.org"
port = "3306"
```

## Classic Configuration ##

Just override `/srv/app/public/config.inc.php`