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
use Mapper\TicketSoldMapper;
use Model\OrderModel;
use Model\TicketSoldModel;
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
        $this->_mollie->setApiKey(MOLLIE_KEY);

        $this->_mapper = new OrderMapper();
    }

    public function create($data)
    {
        $ticketController = new TicketController();

        $amount = 0.0;
        foreach ($data as $ticket) {
            $ticket = $ticketController->getByKey($ticket['key']);

            if ($ticket->getAvailable() || $ticket->getSold() === $ticket->getMaxSold()) {
                throw new Exception\AllTicketsSoldException("");
            }
            $amount += $ticket->getAmount();
        };
        $amount += 0.29;

        $payments = $this->_createMollieOrder($amount);
        foreach ($data as $item) {
            $ticket = $ticketController->getByKey($item['key']);
            $ticketSold = TicketSoldModel::getInstance()
                ->setOrderKey($payments->id)
                ->setTicketKey($ticket->getKey())
                ->setUserName($item['name'])
                ->setUserEmail($item['email'])
                ->setUniqueKey(rand(100000, 999999));

            TicketSoldMapper::getInstance()->save($ticketSold);
        }

        return $this->getURL($payments->id);
    }

    private function _createMollieOrder($amount) {
        try {
            // TODO: redirectURL
            $payments = $this->_mollie->payments->create([
                "method" => Mollie_API_Object_Method::IDEAL,
                "amount" => $amount,
                "description" => "Lustrum #trending",
                "redirectUrl" => "http://lustrum:8080/hallo.php",
            ]);

            $orderMapper = new OrderMapper();
            $order = OrderModel::getInstance()->setOrderKey($payments->id)
                ->setOrderAmount($payments->amount)
                ->setOrderPaymentUrl($this->getURL($payments->id));
            $orderMapper->save($order);

            return $payments;
        } catch (Mollie_API_Exception $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }

        return false;
    }

    public function updatePayment($id) {
        $payment = $this->_mollie->payments->get($id);

        $order = OrderMapper::getInstance()->getOrderByKey($id)
            ->setOrderStatus($payment->status);
        OrderMapper::getInstance()->save($order);

        // Mail user if order is paid
        if ($payment->isPaid()) {
            (new MailController())->mailOrder($payment->id);
        }
    }

    public function getURL($orderId)
    {
        $order = $this->_mollie->payments->get($orderId);
        return $order->getPaymentUrl();
    }

}