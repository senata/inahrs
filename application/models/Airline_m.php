<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Airline_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getAirlines()
    {
        $this->db->where('enabled', 1);
        $query =$this->db->get('flight_airline');
        return $query->result_array();
    }


}