<?php 
namespace Controller;

use Exception\AlreadyScannedException;
use Exception\NotPaidException;
use Mapper\OrderMapper;
use Mapper\TicketMapper;
use Mapper\TicketSoldMapper;

class TicketController extends BaseController {

    private $_soldMapper;

    /**
     * TicketController constructor.
     */
    public function __construct() {
		$this->_mapper = new TicketMapper();
        $this->_soldMapper = new TicketSoldMapper();
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

    /**
     * @return array
     */
    public function getTickets()
    {
        return $this->_mapper->getTickets();
    }

    /**
     * @param $uid
     *
     * @param $ticketID
     *
     * @return \Model\BaseModel
     * @throws \Exception\AlreadyScannedException
     * @throws \Exception\NotPaidException
     */
    public function getTicketByUID($uid, $ticketID)
    {
        $ticket = $this->_soldMapper->getTicketByUID($uid);

        $orderMapper = new OrderMapper();
        if ($orderMapper->checkPaid($ticket->getOrderKey())) {
            if ($ticket->getScanned() == false) {
                if ($ticket->getTicketKey() == $ticketID) {
                    $ticket->setScanned(true);
                    TicketSoldMapper::getInstance()->save(($ticket));
                    return $ticket;
                } else {
                    throw new NotPaidException('Ticket is not for this event');
                }
            } else {
                throw new AlreadyScannedException('Already scanned');
            }
        } else {
            throw new NotPaidException('Not paid ticket');
        }
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