<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 15/09/2016
 * Time: 19:34
 */

namespace Controller;


use Mapper\TicketSoldMapper;

class MailController
{

    public function mailOrder($payment) {
        $tickets = TicketSoldMapper::getInstance()->getTicketsByOrderKey($payment);

        $message = "";
        foreach ($tickets as $ticket) {
            $message .= $ticket->getUserName()." "
               .$ticket->getUserEmail()." ".$ticket->getUniqueKey()." "
               .$ticket->getTicket()->getName()." "
               .$ticket->getTicket()->getDate().PHP_EOL;
        }
        echo $message;
//        mail($tickets[0]->getUserEmail(), "Lustrum #trending - tickets", $message);
    }

}