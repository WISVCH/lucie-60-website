<?php

namespace Model;

/**
 * Created by PhpStorm.
 * User: sven
 * Date: 13/09/2016
 * Time: 19:40
 */
class TicketModel extends BaseModel
{

    public $key;

    public $name;

    public $description;

    public $amount;

    public $date;

    private $max_sold;

    private $available;

    public $background;

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     *
     * @return TicketModel
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return TicketModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return TicketModel
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     *
     * @return TicketModel
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     *
     * @return TicketModel
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxSold()
    {
        return $this->max_sold;
    }

    /**
     * @param mixed $max_sold
     *
     * @return TicketModel
     */
    public function setMaxSold($max_sold)
    {
        $this->max_sold = $max_sold;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     *
     * @return TicketModel
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @param mixed $background
     *
     * @return TicketModel
     */
    public function setBackground($background)
    {
        $this->background = $background;
        return $this;
    }

}