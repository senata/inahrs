<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Ajaxpaymentconfirm extends MY_Controller {

    var $event_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');


    }


    public function index()
    {
		print_r($_FILES['transfer_proof']);
    }



}


