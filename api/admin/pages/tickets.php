<?php
use Mapper\TicketMapper;

setlocale(LC_MONETARY, 'nl_NL.UTF-8');

// Autoload
require "../../../vendor/autoload.php";
require "../../autoload.php";
require "../../config.php";

$tickets = new \Controller\TicketController();

if (isset($_POST['addTicket'])) {
    $tickets->addTicket($_POST);

    header("Location: https://lustrum.ch/dashboard/tickets/");
} else if (isset($_POST['editTicket'])) {
    $ticket = $tickets->getByKey($_POST['ticket_key']);
    $ticket->setAvailable($_POST['available'])
        ->setAmount($_POST['amount'])
        ->setBackground($_POST['background'])
        ->setDate($_POST['date'])
        ->setName($_POST['name'])
        ->setMaxSold($_POST['max_sold'])
        ->setDescription($_POST['description'])
        ->setMaxHidden($_POST['max_hidden']);

    TicketMapper::getInstance()->save($ticket);

    header("Location: https://lustrum.ch/dashboard/tickets/");
}


include_once "components/header.php";
include_once "components/navbar.php"
?>



    <div class="row">
        <div class="col-xs-12">
            <h2 class="section-heading">Tickets <a id="addTicket" class="btn btn-danger" data-toggle="modal"
                                                   data-target="#ticketAddModal">Add ticket</a></h2>
            <table class="table" id="ticketsOverview">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Sold</th>
                    <th>Available</th>
                    <th>Hidden</th>
                    <th>Background</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($tickets->getTickets() as $ticket) {
                    $row = "<tr data-json='" . stripslashes(json_encode($ticket, JSON_HEX_TAG | JSON_HEX_APOS |
                            JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)) . "'>
                            <td class='clickable'>" . $ticket->getId() . "</td>
                            <td class='clickable'>" . $ticket->getName() . "</td>
                            <td class='clickable'>" . $ticket->getDescription() . "</td>
                            <td class='clickable'>" . money_format('%(#1n', $ticket->getAmount()) . "</td>
                            <td class='clickable'>" . $ticket->getDate() . "</td>
                            <td class='clickable'>" . $ticket->getSold() . "/" . $ticket->getMaxSold() . "</td>
                            <td class='clickable'>" . $ticket->getAvailable() . "</td>
                            <td class='clickable'>" . $ticket->getMaxHidden() . "</td>
                            <td class='clickable'><a href='" . $ticket->getBackground() . "'>" . substr($ticket->getBackground(), 0,
                            20) .
                        "...</a></td>
                            <td><span id='editTicket' class='btn btn-danger'>Edit</span></td>
                        </tr>";

                    echo $row;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php

include_once "components/blueprint_add_ticket.php";
include_once "components/blueprint_edit_ticket.php";
include_once "components/blueprint_overview_ticket.php";

include_once "components/footer.php";