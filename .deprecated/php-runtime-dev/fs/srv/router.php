<?php

// drop get params..
$uri = preg_replace('/^(.*)(:?\?.*$|$)/U', '$1', $_SERVER['REQUEST_URI']);

// file exists ?
if (file_exists('/srv/app' . $uri)){
    // serve file directly
    return false;

// std rewrite
}else{
    include '/srv/app/index.php';
}
