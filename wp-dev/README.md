WordPress Plugin-Test Runtime
=================================

**DO NOT USE THIS IMAGE IN PRODUCTION**

As a WordPress plugin developer you often need a "clean" testing environment to test your plugin against different php versions, different WordPress releases or cross-plugin-compatibility.

This testing environment is build upon **alpine-php** running the [php build-in webserver](http://php.net/manual/en/features.commandline.webserver.php).

It **requires** an external MySQL Database as storage backend. The `wp-config.php` has been changed to accept a simple [DSN](https://de.wikipedia.org/wiki/Data_Source_Name) to configure the database credentials via a single environment variable!


Usage
----------------------------------

Each of your plugins should contain a dedicated dockerfile which extends this runtime. See [Cryptex Plugin](https://github.com/AndiDittrich/WordPress.Cryptex) or [Enlighter Plugin](https://github.com/EnlighterJS/Plugin.WordPress) for real-world scenarios.

**DSN String**

The database source name (passed as `WP_DSN` env variable) has the following structure. The fragment is optionally used as table-prefix (default: wp_)

DSN: `mysql://user:passwd@host/table_name#table_prefix`

**Example Setup**

```dockerfile
FROM wp-dev

# copy release files to wordpress plugin directory
COPY --chown="www-data:www-data" dist/ /srv/public/wp-content/plugins/enlighter
```

**Run Container**

```bash
# build the test container
docker build -t myplugin-runtime .

# run container in interactive mode. remove container on close (ctrl+c)
docker run -p 8080:8080 --rm -e WP_DSN="mysql://user:passwd@mysql.instance.local/wordpress_test" --interactive --name myplugin-test myplugin-runtime
```