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

    public function mailOrder($payment)
    {
        $tickets = TicketSoldMapper::getInstance()->getTicketsByOrderKey($payment);

        $message = "";
        foreach ($tickets as $ticket) {
            $message .= "<tr><td>" . $ticket->getTicket()->getName() . "</td><td>" . $ticket->getUserName() . "</td><td>" . $ticket->getUniqueKey() . "</td></tr>";
        }
        $template = file_get_contents("../api/mail-template.html");
        $message = str_replace("%tablecontent%", $message, $template);

        $headers = "From: lucie@ch.tudelft.nl\r\n";
        $headers .= "Reply-To: lucie@ch.tudelft.nl\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($tickets[0]->getUserEmail(), "Lustrum #trending tickets", $message, $headers);
    }

}