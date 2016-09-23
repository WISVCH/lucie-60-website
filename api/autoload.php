<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 05/08/2016
 * Time: 02:55
 */

spl_autoload_register(
    function ($class) {
        $file = __DIR__."/".str_replace('\\', '/', $class).".php";

        if (file_exists($file) === true) {
            require $file;
        }
    },
    true,
    false
);