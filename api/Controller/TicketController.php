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
        return $this->_mapper->getAvailableTickets();
    }

    public function getTickets()
    {
        return $this->_mapper->getTickets();
    }

    public function addTicket($data) {
        if (empty($data['name']) ||
            empty($data['description']) ||
            empty($data['amount']) ||
            empty($data['date']) ||
            empty($data['max_sold']) ||
            empty($data['background'])
        ) return false;

        $data['ticket_key'] = $this->getGUID();
        $data['created_at'] = date("Y-m-d h:i:s");
        $data['updated_at'] = date("Y-m-d h:i:s");


        $this->_mapper->save($this->_mapper->create($data));
        return true;
    }

    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = md5(uniqid(rand(), true));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
            return $uuid;
        }
    }
}