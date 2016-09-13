<?php

namespace Mapper;

use BaseModel;

abstract class BaseMapper
{

    /**
     * Create a new instance of the DomainObject that this
     * mapper is responsible for. Optionally populating it
     * from a data array.
     *
     * @param array $data
     *
     * @return BaseModel
     */
    public function create(array $data = null)
    {
        $obj = $this->_create();
        if ($data) {
            $obj = $this->populate($obj, $data);
        }
        return $obj;
    }

    /**
     * Save the DomainObject
     *
     * Store the DomainObject in persistent storage. Either insert
     * or update the store as required.
     *
     * @param BaseModel $obj
     */
    public function save(BaseModel $obj)
    {
        if (is_null($obj->getId())) {
            $this->_insert($obj);
        } else {
            $this->_update($obj);
        }
    }

    /**
     * Delete the DomainObject
     *
     * Delete the DomainObject from persistent storage.
     *
     * @param BaseModel $obj
     */
    public function delete(BaseModel $obj)
    {
        $this->_delete($obj);
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
    abstract public function populate(BaseModel $obj, array $data);

    /**
     * Create a new instance of a DomainObject
     *
     * @return BaseModel
     */
    abstract protected function _create();

    /**
     * Insert the DomainObject to persistent storage
     *
     * @param BaseModel $obj
     */
    abstract protected function _insert(BaseModel $obj);

    /**
     * Update the DomainObject in persistent storage
     *
     * @param BaseModel $obj
     */
    abstract protected function _update(BaseModel $obj);

    /**
     * Delete the DomainObject from peristent Storage
     *
     * @param BaseModel $obj
     */
    abstract protected function _delete(BaseModel $obj);
}