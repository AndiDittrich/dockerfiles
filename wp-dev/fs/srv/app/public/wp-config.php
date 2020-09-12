<?php
// The base configuration for WordPress
// special version configured by simple DSN via docker-env var
// example: docker run -e WP_DSN='mysql://user:password@localhost/wpdatabase#prefix'

// try to fetch dsn
$_dsn = getenv('WP_DSN', true);

// dsn provided ?
if ($_dsn === false){
    die('FATAL ERROR: DSN not provided via "WP_DSN" env variable');
}

// try to parse dsn
$_dsnp = parse_url($_dsn);

// dsn valid ?
if ($_dsnp === false){
    die('FATAL ERROR: invalid DSN');
}

// assign db config
define('DB_NAME', str_replace('/', '', $_dsnp['path']));
define('DB_USER', $_dsnp['user']);
define('DB_PASSWORD', $_dsnp['pass']);
define('DB_HOST', $_dsnp['host']);
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '' );

// table prefix set ?
$table_prefix = ($_dsnp['fragment'] === null ) ? 'wp_' : $_dsnp['fragment'];

// Authentication Unique Keys and Salts
// !! NOT TO BE USED WITHIN PRODUCTION ENVIRONMENT !!
define('AUTH_KEY', 'C=8D:bdf<B1Qx/TVIhs°)xW>n7#e7ezDP)°J*cP|tJxoKzwq?*3J§Rr4_uX-98Hu');
define('SECURE_AUTH_KEY', ',ZYFn§JPS1aST°:~Y]_O}OZrzR_^RVrOgh]LC1yQ3@::z/a><jeS-Pbek/5S+1JW');
define('LOGGED_IN_KEY', 'pUad§Hez*#{GOvq0nhPf1G(Sgv^!*-OfI}§§UyXg4@]m?wc@/t.CE#2]h@6RH!4*');
define('NONCE_KEY', 'dQdTjO3oQ6hc}m2eeWe5kf(dJB9ngx2wu.~-1vywZ1P01Py§CR7%~+9x6125ax4i');
define('AUTH_SALT', '8%K§Lsb#Yw^-1@gP;!%^oRyC^;_~8-urbCU^y+-Wb-}]YsL/°f^Ob*td+TlgI]:l');
define('SECURE_AUTH_SALT', '~qlv{RGW+Y?G9[h;+VIgnb)0qB.x+iG+a4Dy!vy5f}F.ClwU5Xxk%=2><L{np°&T');
define('LOGGED_IN_SALT', ')ifT{J!G/&>[?y°(~G<AjJd^Nkdv*|Eya7MzW6jng($r§6/=+VMbtPuKTs~Nbk7i');
define('NONCE_SALT', 'g6I+,tE<|ib§-l,*D_|77wAl168Q*§T@qk2Jv^P3-(Ut#/7R}<**E]X+-D}y0@$X');

// enable debugging
define('WP_DEBUG', true);

// use multisite ?
if (getenv('WP_MU', 'off') == 'on'){
    define('WP_ALLOW_MULTISITE', true);
    define('MULTISITE', true);
    define('SUBDOMAIN_INSTALL', false);
    define('DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST']);
    define('PATH_CURRENT_SITE', '/');
    define('SITE_ID_CURRENT_SITE', 1);
    define('BLOG_ID_CURRENT_SITE', 1);
}

// set site url to current active url
define('WP_SITEURL','http://' . $_SERVER['HTTP_HOST']);
define('WP_HOME', WP_SITEURL);

// Absolute path to the WordPress directory
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

// Sets up WordPress vars and included files
require_once( ABSPATH . 'wp-settings.php' );