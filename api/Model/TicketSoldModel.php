<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 14/09/2016
 * Time: 15:44
 */

namespace Model;


class TicketSoldModel extends BaseModel
{

    public $order_key;
    public $ticket_key;
    public $ticket = null;
    public $user_name;
    public $user_email;
    public $scanned = 0;
    public $unique_key = null;

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
     * @return TicketSoldModel
     */
    public function setOrderKey($order_key)
    {
        $this->order_key = $order_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     *
     * @return TicketSoldModel
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTicketKey()
    {
        return $this->ticket_key;
    }

    /**
     * @param mixed $ticket_key
     *
     * @return TicketSoldModel
     */
    public function setTicketKey($ticket_key)
    {
        $this->ticket_key = $ticket_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     *
     * @return TicketSoldModel
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     *
     * @return TicketSoldModel
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
        return $this;
    }

    /**
     * @return null
     */
    public function getUniqueKey()
    {
        return $this->unique_key;
    }

    /**
     * @param null $unique_key
     *
     * @return TicketSoldModel
     */
    public function setUniqueKey($unique_key)
    {
        $this->unique_key = $unique_key;
        return $this;
    }

    /**
     * @return int
     */
    public function getScanned()
    {
        return $this->scanned;
    }

    /**
     * @param int $scanned
     *
     * @return TicketSoldModel
     */
    public function setScanned($scanned)
    {
        $this->scanned = $scanned;
        return $this;
    }

}