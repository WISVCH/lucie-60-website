<?php

namespace Mapper;

use Exception\TicketNotFoundException;
use Model\BaseModel;
use Model\TicketModel;

/**
 * Created by PhpStorm.
 * User: sven
 * Date: 13/09/2016
 * Time: 18:04
 */
class TicketMapper extends BaseMapper
{

    /**
     * @param $key
     *
     * @return \Model\BaseModel|TicketModel
     * @throws \Exception\TicketNotFoundException
     */
    public function getTicketByKey($key)
    {
        global $database;
        $database->where('ticket_key', $key);

        $result = $database->getOne("tickets");
        if ($result !== null) {
            return $this->create($result);
        } else {
            throw new TicketNotFoundException("Ticket: " . $key . " not found!");
        }
    }

    /**
     * Populate the DomainObject with the values
     * from the data array.
     *
     * To be implemented by the concrete mapper class
     *
     * @param BaseModel|TicketModel $obj
     * @param array                 $data
     *
     * @return BaseModel
     */
    public function populate(BaseModel $obj, array $data)
    {
        /** @var TicketModel $obj */
        $obj->setId($data['id'])
            ->setKey($data['ticket_key'])
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setAmount($data['amount'])
            ->setDate($data['date'])
            ->setAvailable($data['available'])
            ->setMaxSold($data['max_sold'])
            ->setBackground($data['background'])
            ->setUpdatedAt($data['updated_at'])
            ->setCreatedAt($data['created_at'])
            ->setSold(
                TicketSoldMapper::getInstance()->getTicketsSoldByTicketKey($obj->getKey())
            );

        if ($obj->getSold() >= $obj->getMaxSold()) {
            $obj->setAvailable(0);
            $this->save($obj);
        }
        
        return $obj;
    }

    /**
     * @return array
     */
    public function getAvailableTickets()
    {
        global $database;
        $database->where('available', 1);
        $database->orderBy('date', 'ASC');

        $return = [];
        foreach ($database->get('tickets') as $tickets) {
            $return[] = $this->create($tickets);
        }

        return $return;
    }

    /**
     * @return array
     */
    public function getTickets()
    {
        global $database;
        $database->orderBy('date', 'ASC');

        $return = [];
        foreach ($database->get('tickets') as $tickets) {
            $ticket = $this->create($tickets);
            $ticket->setTicketsSold(
                TicketSoldMapper::getInstance()->getTicketsByTicketKey($ticket->getKey())
            );
            $return[] = $ticket;
        }

        return $return;
    }

    /**
     * Create a new instance of a DomainObject
     *
     * @return BaseModel
     */
    protected function _create()
    {
        return new TicketModel();
    }

    /**
     * Insert the DomainObject to persistent storage
     *
     * @param \Model\BaseModel $obj
     *
     * @internal param $BaseModel
     */
    protected function _insert(BaseModel $obj)
    {
        global $database;

        /** @var \MysqliDb $database */
        $id = $database->insert('tickets', [
            'ticket_key' => $obj->getKey(),
            'name' => $obj->getName(),
            'description' => $obj->getDescription(),
            'amount' => $obj->getAmount(),
            'max_sold' => $obj->getMaxSold(),
            'available' => $obj->getAvailable(),
            'background' => $obj->getBackground(),
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
        $database->update('tickets', [
            'available' => $obj->getAvailable()
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