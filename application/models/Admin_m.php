<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Admin_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function checkLogin($username, $password)
    {
        $password = sha1($password);

        $query = $this->db->get_where('admin', array('username'=>$username, 'password'=>$password));
        if($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return false;
        }

    }

}