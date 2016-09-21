<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 15/09/2016
 * Time: 19:27
 */

namespace Exception;


use Exception;

class OrderNotFoundException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}