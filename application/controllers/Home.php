<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {

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
		$messages = $this->homes->get(3);
		$galleries = $this->galleries->paginate(1, array(),8);
		$data = array('photos' => $photos, 'about' => $about, 'contact_us' => $contact_us, 'guidelines' => $guidelines, 'i2cp_intro'=>$i2cp_intro, 'galleries' => $galleries['data']);
		$this->mViewData['photos'] = $photos;
		$this->mViewData['about'] = $about;
		$this->mViewData['contact_us'] = $contact_us;
		$this->mViewData['guidelines'] = $guidelines;
		$this->mViewData['i2cp_intro'] = $i2cp_intro;
		$this->mViewData['galleries'] = $galleries['data'];
		$this->mViewData['messages'] = $messages;

		$this->render('home');
	}
}
