<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 13/09/2016
 * Time: 21:06
 */

namespace Exception;


use Exception;

class TicketNotFoundException extends Exception
{
    public function __construct($message, $code = 403, Exception $previous = null) {
        parent::__construct($message, 403, $previous);
    }
}