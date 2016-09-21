<?php 
namespace Controller;

use Mapper\TicketMapper;

class TicketController extends BaseController {

    /**
     * TicketController constructor.
     */
    public function __construct() {
		$this->_mapper = new TicketMapper();
	}

    /**
     * @param $key
     */
    public function getByKey($key) {
		return $this->_mapper->getTicketByKey($key);
	}

    /**
     * @return mixed
     */
    public function getAllAvailableTickets()
    {
        return $this->_mapper->getTickets();
    }
}