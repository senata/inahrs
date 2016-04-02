<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Country_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function getAll()
    {
        $query = $this->db->get('country');
        return $query->result_array();
    }

    function getStates($country_id = null)
    {
        $this->db->select('country_id,province');
        if(!is_null($country_id)) $this->db->where('country_id', $country_id);
        $this->db->group_by('province');
        $query = $this->db->get('state_city');
        return $query->result_array();
    }

    function getCities($country_id, $state)
    {
        $this->db->select('country_id,province,city');
        $this->db->where('country_id', $country_id);
        $this->db->where('province', $state);
        $query = $this->db->get('state_city');
        return $query->result_array();
    }


}