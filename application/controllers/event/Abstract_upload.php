<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 12-May-15
 * Time: 6:44 PM
 */

class Abstract_upload extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function upload(){
        $config['upload_path'] = './uploads/tmp';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size']	= '50000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $insert['topic'] = $this->input->post('topic');

        if ( ! $this->upload->do_upload('abstract_file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error);
            //redirect($this->input->post('return_url'));
			exit('Error. Abstract file is not selected.');
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $file_abstract = $data['upload_data'];
            //copy from tmp to real folder
        }

        if ( ! $this->upload->do_upload('cv_file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error);
            //redirect($this->input->post('return_url'));
			exit('Error. CV file is not selected.');
        }
        else
        {
            $data= array('upload_data' => $this->upload->data());
            $file_cv = $data['upload_data'];
            //copy from tmp to real folder

        }
        $this->load->model('Event_m');

        $insert['file_abstract'] = $file_abstract['file_name'];
        $insert['file_cv'] = $file_cv['file_name'];
        $insert['email'] = $this->input->post('email');
        $insert['phone'] = $this->input->post('phone');
        $id = $this->Event_m->insertAbstract($insert);
        if($id) {
            if(!is_dir('./uploads/abstract_files/' . $id)) mkdir( './uploads/abstract_files/' . $id , 0777 , true);
            rename ($file_abstract['full_path'] , './uploads/abstract_files/' . $id . '/' . $file_abstract['file_name']) ;
            rename ($file_cv['full_path'], './uploads/abstract_files/' . $id . '/' . $file_cv['file_name']) ;

            $message['success'] = 'Thank you for sending your abstract.';
            $this->session->set_flashdata('message', $message);
            //redirect($this->input->post('return_url'));
			exit('Thank you for sending your abstract.');
        } else {
            // insert db error
        }
    }
}