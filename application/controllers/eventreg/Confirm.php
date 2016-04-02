<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Confirm extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data = '';
        $this->load->view('eventreg/payment_confirm_v', $data);
    }

    public function submit()
    {
        $this->form_validation->set_rules('transaction_number', 'Transaction Number', 'required|exact_length[16]|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('sender_account_name', 'Sender Account Name', 'required');
        $this->form_validation->set_rules('transfer_date', 'Transfer Date', 'required');
        $this->form_validation->set_rules('transfer_amount', 'Transfer Amount', 'required|numeric');


        if (empty($_FILES['transfer_proof']['name']))
        {
            $this->form_validation->set_rules('transfer_amount', 'Proof Of Transfer', 'required');
        }

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('eventreg/payment_confirm_v');
        }
        else
        {
            // check validitas transaction number
            $transaction_number = $this->input->post('transaction_number');
            $email = $this->input->post('email');
            $transfer_to = $this->input->post('transfer_to');
            $sender_account_name = $this->input->post('sender_account_name');
            $transfer_date = $this->input->post('transfer_date');
            $transfer_amount = $this->input->post('transfer_amount');
            $this->load->model('Eventreg_m');
            $invoice = $this->Eventreg_m->getInvoice($transaction_number, $email);


   /*         if(!$invoice) {
                $data = array('error' => 'Invalid combination of Transaction Number / Email. If you lost the Transaction Number, please contact us.');
                return $this->load->view('eventreg/payment_confirm_v', $data);
            }*/

            $config['upload_path'] = './uploads/tmp';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2000';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('transfer_proof'))
            {
                $data = array('error' => $this->upload->display_errors());
                // return $this->load->view('eventreg/payment_confirm_v', $data);
                $this->render('paymentconfirmation');
            }
            else
            {
                $file = $this->upload->data();
                $id = '';
                if(isset($invoice['id'])) $id = $invoice['id'] . '/';
                if(!file_exists('./uploads/payment_confirm/' . $invoice['id'])) mkdir('./uploads/payment_confirm/eventreg/' . $id , 0777, TRUE );
                rename($file['full_path'], './uploads/payment_confirm/eventreg/' . $id . $file['file_name']);
            }

            // insert to database
            if(@$invoice['id']) {
                $data['registrant_id'] = $invoice['id'];
                $data['tranx_number'] = $transaction_number;
            }
            $data['transfer_to'] = $transfer_to;
            $data['transfer_name'] = $sender_account_name;
            $data['transfer_amount'] = $transfer_amount;
            $data['transfer_date'] = $transfer_date;
            $data['file_name'] = $file['file_name'];

            $this->load->model('Eventreg_m');
            $this->Eventreg_m->confirmPayment($data);

            redirect(site_url('eventreg/confirm/success'));
        }

    }

    public function success()
    {
        $this->load->view('eventreg/payment_confirm_success_v');
    }

}


