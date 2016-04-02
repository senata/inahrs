<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Invoice extends MY_Controller {

    public function index()
    {
        $this->load->model('Setting_m', 'setting');
        $tx_num = $this->input->get('tx_num');
        $email = $this->input->get('email');
        try {
            $this->load->model('Eventreg_m');
            $data['registrant'] = $this->Eventreg_m->getInvoice($tx_num,$email);
        }
        catch(Exception $e)
        {
            echo "Error: " . $e->getMessage();
            die;
        }
        if(!$data['registrant']) {
            echo "Data not available or invalid transaction number or email.";
            die;
        }

        $data['payment_info'] = $this->setting->getSetting('payment/bank_transfer/info');

        $this->load->view('eventreg/invoice_v', $data);
    }

}


