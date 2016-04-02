<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Checkinvoice extends MY_Controller {

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->model('Setting_m', 'setting');
        $this->load->view('eventreg/checkinvoice_v');
    }

    public function submit()
    {
        $this->load->model('Setting_m', 'setting');
        $tx_num = $this->input->post('transaction_number');
        $email = $this->input->post('email');

        $this->load->model('Eventreg_m');
        $invoice = $this->Eventreg_m->getInvoice($tx_num, $email);

        if($invoice) {
            redirect('eventreg/invoice?tx_num='.$tx_num.'&email=' . $email);
        } else {
            $this->session->set_flashdata('message', array('error' => 'Invalid transaction number or/and email combination.'));
            redirect('eventreg/checkinvoice');

        }


    }

}


