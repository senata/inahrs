<?php

class Inahrs_gallery_model extends MY_Model {

	// public $table = 'inahrs_cover';
	// protected $where = array('status' => 'active');
	// protected $order_by = array('pos', 'ASC');
	// public $primary_key = 'id';
	// // protected $upload_fields = array('image_url' => UPLOAD_DEMO_COVER_PHOTO);
	protected $order_by = array('pos', 'ASC');
	public function __construct()
    {
        parent::__construct();
    }
}