FROM andidittrich/php-runtime:7.0

# add additional files/override existing
COPY --chown=www-data:www-data fs/ /

# webserver port
EXPOSE 8080/tcp

# run php webserver
ENTRYPOINT [ "/usr/bin/php" , "-c", "/etc/php/php.production.ini", "-S", "0.0.0.0:8080" ]
CMD [ "-t", "/srv/app", "/srv/router.php" ]