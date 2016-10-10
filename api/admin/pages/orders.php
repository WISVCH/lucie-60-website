<?php

use Mapper\OrderMapper;

setlocale(LC_MONETARY, 'nl_NL.UTF-8');

// Autoload
require "../../../vendor/autoload.php";
require "../../autoload.php";
require "../../config.php";

$tickets = new \Controller\TicketController();


include_once "components/header.php";
include_once "components/navbar.php"
?>

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
                    $row = "<tr data-json='" . stripslashes(json_encode($order, JSON_HEX_TAG | JSON_HEX_APOS |
                            JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)) . "'>
                                <td>" . $order->getId() . "</td>
                                <td>" . $order->getOrderKey() . "</td>
                                <td>" . $order->getOrderAccountInfo()->consumerName . "</td>
                                <td>" . $order->getOrderAccountInfo()->consumerAccount . "</td>
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
    </div>
    </section>
<?php

include_once "components/blueprint_overview_order.php";
include_once "components/footer.php";