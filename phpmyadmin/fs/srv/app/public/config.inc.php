<?php

/**
 * This is needed for cookie based authentication to encrypt password in
 * cookie. Needs to be 32 chars long.
 */
/* YOU MUST FILL IN THIS FOR COOKIE AUTH! */
$cfg['blowfish_secret'] = 'veezeOPT8M3bwqHaH563goTciQQPmb7w';


// check for server config
if (!is_readable('/etc/phpmyadmin.ini')){
    die('/etc/phpmyadmin.conf is not readable');
}

// load server config (list) of servers
$_serverConfig = parse_ini_file('/etc/phpmyadmin.ini', true);

// config counter
$i = 0;

// generate phomyamdin server config
foreach ($_serverConfig as $servername => $serverconf){
    // increment
    $i++;

    // Authentication type
    $cfg['Servers'][$i]['auth_type'] = 'cookie';
    
    // Server parameters 
    $cfg['Servers'][$i]['name'] = $servername;
    $cfg['Servers'][$i]['host'] = $serverconf['host'];
    $cfg['Servers'][$i]['port'] = $serverconf['port'];
    $cfg['Servers'][$i]['compress'] = false;
    $cfg['Servers'][$i]['AllowNoPassword'] = false;

    // use TLS ?
    if (isset($serverconf['cert'])){
        // enable ssl/tls for this connection
        $cfg['Servers'][$i]['ssl'] = true;

        // enforce cert verification
        $cfg['Servers'][$i]['ssl_verify'] = true;

        // client certificate
        $cfg['Servers'][$i]['ssl_cert'] = '/etc/certs.d/' . $serverconf['cert'] . '/client.crt';
        
        // client secret key
        $cfg['Servers'][$i]['ssl_key'] = '/etc/certs.d/' . $serverconf['cert'] . '/client.key';

        // certification authority
        $cfg['Servers'][$i]['ssl_ca'] = '/etc/certs.d/' . $serverconf['cert'] . '/ca.crt';
    }
}

/**
 * Directories for saving/loading files from server
 */
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';

/**
 * Whether to display icons or text or both icons and text in table row
 * action segment. Value can be either of 'icons', 'text' or 'both'.
 * default = 'both'
 */
//$cfg['RowActionType'] = 'icons';

/**
 * Defines whether a user should be displayed a "show all (records)"
 * button in browse mode or not.
 * default = false
 */
$cfg['ShowAll'] = true;

/**
 * Number of rows displayed when browsing a result set. If the result
 * set contains more rows, "Previous" and "Next".
 * Possible values: 25, 50, 100, 250, 500
 * default = 25
 */
$cfg['MaxRows'] = 50;

/**
 * Disallow editing of binary fields
 * valid values are:
 *   false    allow editing
 *   'blob'   allow editing except for BLOB fields
 *   'noblob' disallow editing except for BLOB fields
 *   'all'    disallow editing
 * default = 'blob'
 */
//$cfg['ProtectBinary'] = false;

/**
 * Default language to use, if not browser-defined or user-defined
 * (you find all languages in the locale folder)
 * uncomment the desired line:
 * default = 'en'
 */
//$cfg['DefaultLang'] = 'en';
//$cfg['DefaultLang'] = 'de';

/**
 * How many columns should be used for table display of a database?
 * (a value larger than 1 results in some information being hidden)
 * default = 1
 */
//$cfg['PropertiesNumColumns'] = 2;

/**
 * Set to true if you want DB-based query history.If false, this utilizes
 * JS-routines to display query history (lost by window close)
 *
 * This requires configuration storage enabled, see above.
 * default = false
 */
//$cfg['QueryHistoryDB'] = true;

/**
 * When using DB-based query history, how many entries should be kept?
 * default = 25
 */
//$cfg['QueryHistoryMax'] = 100;

/**
 * Whether or not to query the user before sending the error report to
 * the phpMyAdmin team when a JavaScript error occurs
 *
 * Available options
 * ('ask' | 'always' | 'never')
 * default = 'ask'
 */
//$cfg['SendErrorReports'] = 'always';

/**
 * You can find more configuration options in the documentation
 * in the doc/ folder or at <https://docs.phpmyadmin.net/>.
 */