<?php
use Mapper\OrderMapper;
use Mapper\TicketMapper;

setlocale(LC_MONETARY, 'nl_NL.UTF-8');

// Autoload
require "../../vendor/autoload.php";
require "../autoload.php";
require "../config.php";

$tickets = new \Controller\TicketController();
if (isset($_POST['addTicket'])) {
    $tickets->addTicket($_POST);
    header("Location: https://lustrum.ch/dashboard/");
} else if (isset($_POST['submit_hidden'])){
    $ticket = $tickets->getByKey($_POST['hidden_ticket']);
    $ticket->setAvailable($ticket->getAvailable() ^ 1);

    TicketMapper::getInstance()->save($ticket);
    header("Location: https://lustrum.ch/dashboard/");
}

include_once "pages/components/header.php";


?>
    <section id="about">
        <div class="container">
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
                            <th>Background</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($tickets->getTickets() as $ticket) {
                            $row = "<tr data-json='" .stripslashes(json_encode($ticket, JSON_HEX_TAG | JSON_HEX_APOS |
                                    JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)). "'>
                            <td class='clickable'>" . $ticket->getId() . "</td>
                            <td class='clickable'>" . $ticket->getName() . "</td>
                            <td class='clickable'>" . $ticket->getDescription() . "</td>
                            <td class='clickable'>" . money_format('%(#1n', $ticket->getAmount()) . "</td>
                            <td class='clickable'>" . $ticket->getDate() . "</td>
                            <td class='clickable'>" . $ticket->getSold() . "/" . $ticket->getMaxSold() . "</td>
                            <td class='clickable'>" . $ticket->getAvailable() . "</td>
                            <td class='clickable'><a href='" . $ticket->getBackground() . "'>" . substr($ticket->getBackground(), 0,
                                    20) .
                                "...</a></td>
                        </tr>";

                            echo $row;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="section-heading">Orders</h2>
                    <table class="table" id="orderOverview">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Key</th>
                            <th>Consumer name</th>
                            <th>Consumer account</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (OrderMapper::getInstance()->getOrders() as $order) {
                            $row = "<tr data-json='" .stripslashes(json_encode($order, JSON_HEX_TAG | JSON_HEX_APOS |
                                   JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)). "'>
                                <td>" . $order->getId() . "</td>
                                <td>" . $order->getOrderKey() . "</td>
                                <td>" . $order->getOrderAccountInfo()->consumerName . "</td>
                                <td>" . $order->getOrderAccountInfo()->consumerAccount  . "</td>
                                <td>" . money_format('%(#1n', $order->getOrderAmount()) . "</td>
                                <td>" . $order->getOrderStatus() . "</td>
                                <td>" . $order->getCreatedAt() . "</td>
                            </tr>";

                            echo $row;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: calc(80vw);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="basketLabel">Order <span class="order_key"></span></h4>
                </div>
                <div class="modal-body">
                    <h5>Order details</h5>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Consumer name</th>
                            <td><span class="consumer_name"></span></td>
                        </tr>
                        <tr>
                            <th>Consumer account</th>
                            <td><span class="consumer_account"></span></td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td><span class="order_amount"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="order_status"></span></td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td><span class="order_created"></span></td>
                        </tr>
                        </tbody>
                    </table>

                    <h5>Tickets details</h5>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Owner name</th>
                            <th>Owner email</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody class="ticket-details"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: calc(80vw);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="basketLabel">Ticket <span class="ticket_name"></span></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="hidden_ticket" id="hidden_value" value="">
                        <input type="submit" name="submit_hidden" value="Show/Hide" class="btn btn-danger">
                    </form>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Unique number</th>
                        </tr>
                        </thead>
                        <tbody class="consumers-details"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ticketAddModal" tabindex="-1" role="dialog" aria-labelledby="addTicket">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="basketLabel">Add ticket</h4>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Ticket name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea name="description" class="form-control" id="description" cols="30"
                                      rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Price: </label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                   placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="date">Date: </label>
                            <input type="date" class="form-control" id="date" name="date"
                                   placeholder="Date event">
                        </div>
                        <div class="form-group">
                            <label for="max_sold">Max sold: </label>
                            <input type="number" class="form-control" id="max_sold" name="max_sold"
                                   placeholder="Max sold tickets">
                        </div>
                        <div class="form-group">
                            <label for="available">Available: </label>
                            <select name="available" id="available" class="form-control">
                                <option value="0">False</option>
                                <option value="1">True</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="background">Background url: </label>
                            <input type="text" class="form-control" id="background" name="background"
                                   placeholder="URL to background">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" name="addTicket">
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php

include_once "pages/components/footer.php";

?>