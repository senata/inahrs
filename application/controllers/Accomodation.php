<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Accomodation extends MY_Controller {

	public function index()
	{
		$this->load->model('inahrs_home_model', 'homes');
		$symposium = $this->homes->get(12);
		$this->mViewData['data'] = $symposium;
		$this->render('asm');
	}
}
