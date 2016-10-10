<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 09/10/2016
 * Time: 17:02
 */

namespace Exception;


use Exception;

class NotPaidException extends Exception
{
    public function __construct($message, $code = 405, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}