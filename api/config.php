<?php

// We're still developing
error_reporting(E_ALL);
ini_set('display_errors', true);

//Database
define("DB_HOST", "127.0.0.1");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "ch_lucie_website");
define("DB_PREFIX", "lucie");


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