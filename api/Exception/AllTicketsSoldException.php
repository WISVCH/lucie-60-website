<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 21/09/2016
 * Time: 22:23
 */

namespace Exception;

use Exception;

class AllTicketsSoldException extends Exception
{

    public function __construct($message, $code = 402, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}