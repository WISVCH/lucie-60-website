<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 14/09/2016
 * Time: 15:44
 */

namespace Mapper;


use Exception\OrderNotFoundException;
use Model\BaseModel;
use Model\TicketSoldModel;

class TicketSoldMapper extends BaseMapper
{

    public function getTicketsByOrderKey($key)
    {
        global $database;
        $database->where('order_key', $key);

        $result = $database->get("tickets_sold");
        if ($result !== null) {
            $tickets = [];
            foreach ($result as $row) {
                $model = $this->create($row);
                $model->setTicket(
                    TicketMapper::getInstance()->getTicketByKey($model->getTicketKey())
                );
                $tickets[] = $model;
            }

            return $tickets;
        } else {
            throw new OrderNotFoundException("Ticket from order " . $key . " not found!");
        }
    }

    public function getTicketsByTicketKey($key)
    {
        global $database;
        $database->join("orders o", "t.order_key=o.order_key", "LEFT");
        $database->where('ticket_key', $key);
        $database->where('order_status', 'paid');

        $result = $database->get("tickets_sold t");
        if ($result !== null) {
            $tickets = [];
            foreach ($result as $row) {
                $tickets[] = $this->create($row);
            }

            return $tickets;
        } else {
            throw new OrderNotFoundException("Ticket from order " . $key . " not found!");
        }
    }

    public function getTicketsSoldByTicketKey($key)
    {
        global $database;
        $database->join("orders o", "t.order_key=o.order_key", "LEFT");
        $database->where('ticket_key', $key);
        $database->where('order_status', 'paid');

        return $database->getValue("tickets_sold t", "count(*)");
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
        $obj->setId($data['id'])
            ->setOrderKey($data['order_key'])
            ->setTicketKey($data['ticket_key'])
            ->setUserName($data['user_name'])
            ->setUserEmail($data['user_email'])
            ->setUniqueKey($data['unique_key'])
            ->setCreatedAt($data['created_at'])
            ->setUpdatedAt($data['updated_at']);

        return $obj;
    }

    /**
     * Create a new instance of a DomainObject
     *
     * @return BaseModel
     */
    protected function _create()
    {
        return new TicketSoldModel();
    }

    /**
     * Insert the DomainObject to persistent storage
     *
     * @param BaseModel $obj
     */
    protected function _insert(BaseModel $obj)
    {
        global $database;

        $database->insert('tickets_sold', [
            'order_key' => $obj->getOrderKey(),
            'ticket_key' => $obj->getTicketKey(),
            'user_name' => $obj->getUserName(),
            'user_email' => $obj->getUserEmail(),
            'unique_key' => $obj->getUniqueKey(),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }

    /**
     * Update the DomainObject in persistent storage
     *
     * @param BaseModel $obj
     */
    protected function _update(BaseModel $obj)
    {
        // TODO: Implement _update() method.
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