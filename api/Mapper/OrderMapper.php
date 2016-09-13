<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 13/09/2016
 * Time: 18:52
 */

namespace Mapper;


use BaseModel;

class OrderMapper extends BaseMapper
{

    /**
     * OrderMapper constructor.
     */
    public function __construct()
    {
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
        // TODO: Implement populate() method.
    }

    /**
     * Create a new instance of a DomainObject
     *
     * @return BaseModel
     */
    protected function _create()
    {
        // TODO: Implement _create() method.
    }

    /**
     * Insert the DomainObject to persistent storage
     *
     * @param BaseModel $obj
     */
    protected function _insert(BaseModel $obj)
    {
        // TODO: Implement _insert() method.
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