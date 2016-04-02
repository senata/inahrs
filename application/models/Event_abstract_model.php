<?php

class Event_abstract_model extends MY_Model {

	// public $table = 'inahrs_cover';
	// protected $where = array('status' => 'active');
	// protected $order_by = array('pos', 'ASC');
	// public $primary_key = 'id';
	// // protected $upload_fields = array('image_url' => UPLOAD_DEMO_COVER_PHOTO);
	public function __construct()
    {
        parent::__construct();
    }

    public function save($data){
    	$this->db->insert('event_abstracts',$data);
    }

}