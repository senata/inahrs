<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Submitabstract extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');

	}

	public function index()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form('submitabstract/createnew',TRUE,array( 'name'=>'contact-form'));

		if ($form->validate())
		{
			$this->system_message->set_success('Success!');
			refresh();
		}

		// require reCAPTCHA script at page head
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';
		
		$this->mTitle = 'Abstract Submission';
		$this->mViewData['form'] = $form;

		$this->load->model('inahrs_home_model', 'homes');
		$submission = $this->homes->get(11);
		$this->mViewData['data'] = $submission;

		$this->render('submission');
	}

	public function createnew(){
		$this->load->model('event_abstract_model', 'abstract');
		//            'upload_path'   => '/var/www/admin-inahrs/assets/content_inahrs/inahrs_upload/abstract',
		$config = array(
            'upload_path'   => '../admin-inahrs/assets/content_inahrs/inahrs_upload/abstract',
            'allowed_types' => 'pdf|doc|docx',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);
        // var_dump($_FILES);
        $poster = 0;
        if($this->input->post('poster')){
        	$poster = $this->input->post('poster');
        }
        $oral = 0;
        if($this->input->post('oral')){
        	$oral = $this->input->post('oral');
        }

        if ($this->upload->do_upload('abstract')) {
            $data_abstract = $this->upload->data();
			if ($this->upload->do_upload('cv')) {
            	$data_cv = $this->upload->data();
            	$data = array(
				'name' => $this->input->post('name'),
				'phone' => $this->input->post('phone_number'),
				'email' => $this->input->post('email'),
				'topic' => $this->input->post('topic'),
				'file' => $data_abstract['file_name'],
				'cv_file' => $data_cv['file_name'],
				'poster_presentation' => $poster,
				'oral_presentation' => $oral,
				);
				$this->abstract->save($data);
				$this->system_message->set_success('Thank you. Your Abstract have been submited');
				redirect('/submitabstract');
				// return array("status"=>1,"message"=>"Thank you");
        	}else{
        		$error = array('error_cv' => $this->upload->display_errors());
            	// var_dump($error);die;
        	}
        } else {
            $error = array('error_abstract' => $this->upload->display_errors());
            var_dump($error);die;
        }
	}
}
