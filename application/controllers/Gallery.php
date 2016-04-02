<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Gallery extends MY_Controller {

	public function index()
	{
		$this->load->model('inahrs_gallery_model', 'galleries');
		$galleries = $this->galleries->get_all();
		$this->mViewData['galleries'] = $galleries;
		$this->render('gallery');
	}
}
