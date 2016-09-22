<?php

// We're still developing
error_reporting(E_ALL);
ini_set('display_errors', true);

//Database
define("DB_HOST", "host");
define("DB_USERNAME", "username");
define("DB_PASSWORD", "password");
define("DB_DATABASE", "database");
define("DB_PREFIX", "prefix_");


// Mollie
define("MOLLIE_KEY", "test_4c4S5pn4N58rAEncrr3RdQNhVPVyAf");

$GLOBALS['database'] = new MysqliDb([
        'host' => DB_HOST,
        'username' => DB_USERNAME,
        'password' => DB_PASSWORD,
        'db' => DB_DATABASE,
        'prefix' => DB_PREFIX
    ]
);