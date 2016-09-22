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
            $message .= $ticket->getUserName() . " "
                . $ticket->getUserEmail() . " " . $ticket->getUniqueKey() . " "
                . $ticket->getTicket()->getName() . " "
                . $ticket->getTicket()->getDate() . PHP_EOL;
        }
        $template  = file_get_contents("../api/mail-template.html");
        $message = str_replace("%tablecontent", $message, $template);

        echo $message;
    }

}