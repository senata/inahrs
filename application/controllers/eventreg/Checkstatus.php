<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Checkstatus extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');

	}

	public function index()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form('/eventreg/checkstatus/submit',TRUE,array( 'name'=>'contact-form','onsubmit'=>'return get_action(this)'));

		if ($form->validate())
		{
			$this->system_message->set_success('Success!');
			refresh();
		}

		// require reCAPTCHA script at page head
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';
		
		$this->mViewData['form'] = $form;

		$this->render('checkstatus');
	}

	public function submit()
    {
                $this->load->model('Setting_m', 'setting');
        $tx_num = $this->input->post('transaction_number');
        $email = $this->input->post('email');
        if(!$form->validate()){
        	$this->system_message->set_error("Invalid transaction number or/and email combination.");
            redirect('/eventreg/checkstatus');
        }
        $this->load->model('Eventreg_m');
        $invoice = $this->Eventreg_m->getInvoice($tx_num, $email);

        if($invoice) {
            redirect('eventreg/invoice?tx_num='.$tx_num.'&email=' . $email);
        } else {
            $this->system_message->set_error("Invalid transaction number or/and email combination.");
            redirect('/eventreg/checkstatus');
        }
    }
}
