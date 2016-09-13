<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 13/09/2016
 * Time: 18:51
 */

namespace Controller;


use Exception;
use Mapper\OrderMapper;
use Mollie_API_Exception;
use Mollie_API_Object_Method;

class OrderController extends BaseController
{

    private $_mollie;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->_mollie = new \Mollie_API_Client();
        $this->_mollie->setApiKey("test_4c4S5pn4N58rAEncrr3RdQNhVPVyAf");

        $this->_mapper = new OrderMapper();
    }

    public function create($data)
    {
        global $database;
        $ticketController = new TicketController();

        $amount = 0.0;

        // Lock database
        $database->startTransaction();
        foreach ($data as $ticket) {
            $ticket = $ticketController->getByKey($ticket['key']);

            $amount += $ticket->getAmount();

            // TODO: insert ticket into database
        };

        try {
            $payments = $this->_mollie->payments->create([
                "method" => Mollie_API_Object_Method::IDEAL,
                "amount" => $amount,
                "description" => "Lustrum trending",
                "redirectUrl" => "http://lustrum:8080/hallo.php",
            ]);

            // TODO: insert order into database
            print_r($payments);

            return $this->getURL($payments->id);
        } catch (Exception $e) {
            $database->rollback();
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }

        $database->commit();
    }

    public function getURL($orderId)
    {
        $order = $this->_mollie->payments->get($orderId);
        return $order->getPaymentUrl();
    }

}