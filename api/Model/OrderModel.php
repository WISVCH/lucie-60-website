<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 14/09/2016
 * Time: 12:49
 */

namespace Model;


class OrderModel extends BaseModel
{

    public $order_key = null;
    public $order_amount = 0;
    public $order_paid = 0;
    public $order_event_id = 0;
    public $order_payment_url = 0;
    public $order_status = 'open';

    /**
     * @return mixed
     */
    public function getOrderKey()
    {
        return $this->order_key;
    }

    /**
     * @param mixed $order_key
     *
     * @return OrderModel
     */
    public function setOrderKey($order_key)
    {
        $this->order_key = $order_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderAmount()
    {
        return $this->order_amount;
    }

    /**
     * @param mixed $order_amount
     *
     * @return OrderModel
     */
    public function setOrderAmount($order_amount)
    {
        $this->order_amount = $order_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderPaid()
    {
        return $this->order_paid;
    }

    /**
     * @param mixed $order_paid
     *
     * @return OrderModel
     */
    public function setOrderPaid($order_paid)
    {
        $this->order_paid = $order_paid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderEventId()
    {
        return $this->order_event_id;
    }

    /**
     * @param mixed $order_event_id
     *
     * @return OrderModel
     */
    public function setOrderEventId($order_event_id)
    {
        $this->order_event_id = $order_event_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderPaymentUrl()
    {
        return $this->order_payment_url;
    }

    /**
     * @param mixed $order_payment_url
     *
     * @return OrderModel
     */
    public function setOrderPaymentUrl($order_payment_url)
    {
        $this->order_payment_url = $order_payment_url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @param mixed $order_status
     *
     * @return OrderModel
     */
    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
        return $this;
    }

}