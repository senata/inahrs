<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Hotel_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function getAll()
    {
        $query = $this->db->get_where('event_hotel', array('enabled'=>1));
        return $query->result_array();
    }

	function getFee($room_id)
	{
        $query = $this->db->get_where('event_hotel', array('id'=> $room_id));
        return $query->row()->nett_price;
	}

	function getHotel($room_id)
	{
        $query = $this->db->get_where('event_hotel', array('id'=> $room_id));
        return $query->row_array();
	}

    function getRegHotels($registrant_id)
    {
        $query = $this->db->get_where('event_registrant_hotel', array('registrant_id'=>$registrant_id));
        return $query->result_array();
    }


}