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
define("MOLLIE_KEY", "your_mollie_test_key");

$GLOBALS['database'] = new MysqliDb([
        'host' => DB_HOST,
        'username' => DB_USERNAME,
        'password' => DB_PASSWORD,
        'db' => DB_DATABASE,
        'prefix' => DB_PREFIX
    ]
);
