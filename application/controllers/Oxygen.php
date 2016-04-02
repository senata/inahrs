<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Oxygen extends MX_Controller{

	 public function __construct()
       {
            parent::__construct();
            // Your own constructor code
       }

	public function index()
	{
		$this->load->model('inahrs_cover_model', 'photos');
		$this->load->model('inahrs_home_model', 'homes');
		$this->load->model('inahrs_gallery_model', 'galleries');
		$photos = $this->photos->get_all();
		$about = $this->homes->get(2);
		$guidelines = $this->homes->get(4);
		$contact_us = $this->homes->get(5);
		$i2cp_intro = $this->homes->get(6);
		$galleries = $this->galleries->paginate(1, array(),8);
		$data = array('photos' => $photos, 'about' => $about, 'contact_us' => $contact_us, 'guidelines' => $guidelines, 'i2cp_intro'=>$i2cp_intro, 'galleries' => $galleries['data']);
		$this->load->view('oxygen', $data);
	}

	// 	// Bootstrap Carousel
	// public function carousel()
	// {
	// 	// grab records from database table "cover_photos"
	// 	$this->load->model('demo_cover_photo_model', 'photos');
	// 	$this->mViewData['photos'] = $this->photos->get_all();
	// 	$this->render('demo/carousel');
	// }

	public function register()
	{
		$this->load->view('register');
	}
}