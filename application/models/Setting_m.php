<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Setting_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getSetting($name)
    {
        $query = $this->db->get_where('setting', array('name'=>$name));
        $row = $query->row_array();
        if( @unserialize($row['value']) ) {
            return unserialize($row['value']);
        }

        return $row['value'];

    }


}