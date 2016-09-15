<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 14/09/2016
 * Time: 15:44
 */

namespace Mapper;


use Model\BaseModel;
use Model\TicketSoldModel;

class TicketSoldMapper extends BaseMapper
{

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