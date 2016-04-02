<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class workshop extends MY_Controller {

	public function symposium()
	{
		$this->load->model('inahrs_home_model', 'homes');
		$symposium = $this->homes->get(10);
		$this->mViewData['data'] = $symposium;
		$this->render('asm');
	}

	public function index()
	{
		$this->load->model('inahrs_home_model', 'homes');
		$workshop = $this->homes->get(9);
		$this->mViewData['data'] = $workshop;
		$this->render('asm');
	}
}
