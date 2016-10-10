<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 09/10/2016
 * Time: 17:21
 */

namespace Exception;


use Exception;

class AlreadyScannedException extends Exception
{
    public function __construct($message, $code = 406, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}