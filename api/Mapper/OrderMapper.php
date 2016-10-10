<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 13/09/2016
 * Time: 18:52
 */

namespace Mapper;


use Exception\OrderNotFoundException;
use Model\BaseModel;
use Model\OrderModel;

class OrderMapper extends BaseMapper
{

    /**
     * OrderMapper constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $key
     *
     * @return \Model\BaseModel
     * @throws \Exception\OrderNotFoundException
     */
    public function getOrderByKey($key) {
        global $database;
        $database->where('order_key', $key);

        $result = $database->getOne('orders');
        if ($result !== null) {
            return $this->create($result);
        } else {
            throw new OrderNotFoundException("Order: " . $key . " not found!");
        }
    }


    public function checkPaid($key) {
        global $database;
        $database->where('order_key', $key);
        $database->where('order_status', 'paid');
        $database->getOne('orders');

        if ($database->count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getOrders()
    {
        global $database;
        $database->orderBy('updated_at', 'DESC');

        $mollie = new \Mollie_API_Client();
        $mollie->setApiKey(MOLLIE_KEY);

        $return = [];
        foreach ($database->get('orders') as $tickets) {
            $order = $this->create($tickets);
            $order->setOrderAccountInfo(
                $mollie->payments->get($order->getOrderKey())->details
            )->setTickets(
                TicketSoldMapper::getInstance()->getTicketsByOrderKey($order->getOrderKey())
            );

            $return[] = $order;
        }

        return $return;
    }

    /**
     * Populate the DomainObject with the values
     * from the data array.
     *
     * To be implemented by the concrete mapper class
     *
     * @param BaseModel $obj
     * @param array     $data
     *
     * @return BaseModel
     */
    public function populate(BaseModel $obj, array $data)
    {
        if ($obj instanceof OrderModel) {
            /** @var OrderModel $obj */
            $obj->setId($data['id'])
                ->setOrderKey($data['order_key'])
                ->setOrderAmount($data['order_amount'])
                ->setOrderPaid($data['order_paid'])
                ->setOrderEventId($data['order_event_id'])
                ->setOrderStatus($data['order_status'])
                ->setOrderPaymentUrl($data['order_payment_url'])
                ->setCreatedAt($data['created_at'])
                ->setUpdatedAt($data['updated_at']);
        }
        return $obj;
    }

    /**
     * Create a new instance of a DomainObject
     *
     * @return BaseModel|\Model\OrderModel
     */
    protected function _create()
    {
        return new OrderModel();
    }

    /**
     * Insert the DomainObject to persistent storage
     *
     * @param BaseModel $obj
     *
     * @return \Model\BaseModel
     */
    protected function _insert(BaseModel $obj)
    {
        global $database;

        /** @var \MysqliDb $database */
        $id = $database->insert('orders', [
            'order_key' => $obj->getOrderKey(),
            'order_amount' => $obj->getOrderAmount(),
            'order_paid' => $obj->getOrderPaid(),
            'order_event_id' => $obj->getOrderEventId(),
            'order_status' => $obj->getOrderStatus(),
            'order_payment_url' => $obj->getOrderPaymentUrl(),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        $obj->setId($id);
    }

    /**
     * Update the DomainObject in persistent storage
     *
     * @param BaseModel $obj
     */
    protected function _update(BaseModel $obj)
    {
        global $database;
        $database->where('id', $obj->getId());
        $database->update('orders', [
            'order_key' => $obj->getOrderKey(),
            'order_amount' => $obj->getOrderAmount(),
            'order_paid' => $obj->getOrderPaid(),
            'order_event_id' => $obj->getOrderEventId(),
            'order_status' => $obj->getOrderStatus(),
            'order_payment_url' => $obj->getOrderPaymentUrl()
        ]);
    }

    /**
     * Delete the DomainObject from peristent Storage
     *
     * @param BaseModel $obj
     */
    protected function _delete(BaseModel $obj)
    {
        // TODO: Implement _delete() method.
    }
}