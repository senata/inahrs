<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Crash_m extends CI_Model
{


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function regCrash($request)
    {
        $this->db->where('id', $event_id);
        $query = $this->db->get('event');
        return $query->row_array();
    }

    function register($request)
    {
        // check duplicate email
        $this->db->where('email', $request['email']);
        $query = $this->db->get('crashprogram_member');
        if($query->row_array()) {
            throw new Exception('Email is already registered');
        }

        $data = array(
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone' => $request['phone'],
            'mobile' => $request['mobile'],
            'almamater' => $request['almamater'],
            'hospital_name' => $request['hospital_name'],
            'hospital_address' => $request['hospital_address'],
            'hospital_province' => $request['hospital_province'],
            'hospital_city' => $request['hospital_city'],
            'hospital_carm_available' => (int) $request['hospital_carm_available'],
            'verify_code'  => $request['verify_code'],
            'approve_code'  => $request['approve_code'],
        );
        $this->db->insert('crashprogram_member', $data);

        return true;
    }

    public function verify_user()
    {
        $email = $this->input->get('email');
        $code = $this->input->get('code');
        $this->db->where('email', $email);
        $this->db->where('verify_code', $code);
        $data = array(
            'verified' => 1
        );
        $this->db->update('crashprogram_member', $data);

        $this->check_user_finish($email);
    }

    public function approve_user()
    {
        $email = $this->input->get('email');
        $code = $this->input->get('code');
        $this->db->where('email', $email);
        $this->db->where('approve_code', $code);
        $data = array(
            'paid' => 1
        );
        $this->db->update('crashprogram_member', $data);

        $this->check_user_finish($email);
    }

    public function check_user_finish($email)
    {
        // jika verified and paid, kirim email ke user
        $query = $this->db->get_where('crashprogram_member', array('verified' => 1, 'paid' => 1, 'email'=>$email));
        $user = $query->row_array();
        if($user) {
            // send email
            $this->load->library('email');

            $this->email->initialize( array(
                    'mailtype' => 'html'
                )
            );

            $crash_send_user_login = $this->load->view('email/crash_send_user_login_v', '', true);
            $crash_send_user_login = str_replace('__FULLNAME__', $user['fullname'], $crash_send_user_login);
            $crash_send_user_login = str_replace('__CRASH_LOGIN_URL__', site_url('crashprogram/login'), $crash_send_user_login);
            $crash_send_user_login = str_replace('__USERNAME__', $user['email'], $crash_send_user_login);
            $crash_send_user_login = str_replace('__PASSWORD__', $user['password'], $crash_send_user_login);

            $this->email->from(SYS_EMAIL, 'InaHRS Mail System');
			$this->email->reply_to(ADMIN_EMAIL, 'InaHRS Administrator');
            $this->email->to($user['email']);

            $this->email->subject('Crash Program - Registration - ' . $user['fullname']);
            $this->email->message($crash_send_user_login);

            $this->email->send();
			return;
        }


        // jika belum verified and paid, check verified
        $query = $this->db->get_where('crashprogram_member', array('verified' => 1, 'paid' => 0, 'email'=>$email));
        $user = $query->row_array();
        if($user) {
            // send email
            $this->load->library('email');

            $this->email->initialize( array(
                    'mailtype' => 'html'
                )
            );

            $crash_send_user_verified = $this->load->view('email/crash_send_user_verified_v', '', true);
            $crash_send_user_verified = str_replace('__FULLNAME__', $user['fullname'], $crash_send_user_verified);

            $this->email->from(SYS_EMAIL, 'InaHRS Mail System');
			$this->email->reply_to(ADMIN_EMAIL, 'InaHRS Administrator');
			$this->email->to($user['email']);

            $this->email->subject('Integrated Implanter Crash Program - Registration - ' . $user['fullname']);
            $this->email->message($crash_send_user_verified);

            $this->email->send();

            return;
        }


        // jika belum verified and paid, check paid
        $query = $this->db->get_where('crashprogram_member', array('verified' => 0, 'paid' => 1, 'email'=>$email));
        $user = $query->row_array();
        if($user) {
            // send email
            $this->load->library('email');

            $this->email->initialize(array(
                    'mailtype' => 'html'
                )
            );

            $crash_send_user_payment_verified = $this->load->view('email/crash_send_user_payment_verified_v', '', true);
            $crash_send_user_payment_verified = str_replace('__FULLNAME__', $user['fullname'], $crash_send_user_payment_verified);

            $this->email->from(SYS_EMAIL, 'InaHRS Mail System');
			$this->email->reply_to(ADMIN_EMAIL, 'InaHRS Administrator');
			$this->email->to($user['email']);

            $this->email->subject('Integrated Implanter Crash Program - Registration - ' . $user['fullname']);
            $this->email->message($crash_send_user_payment_verified);

            $this->email->send();

            return;
        }
    }

    public function get_user($param)
    {
        if(isset($param['email'])) {
            $query = $this->db->get_where('crashprogram_member', array('email'=>$param['email']));
            return $query->row_array();
        }
        if(isset($param['user_id'])) {
            $query = $this->db->get_where('crashprogram_member', array('id'=>$param['user_id']));
            return $query->row_array();
        }
    }

    public function check_login($username, $password)
    {
        $query = $this->db->get_where('crashprogram_member', array('email'=>$username, 'password'=>$password));
        $user = $query->row_array();
        if($user) {
            if($user['verified'] == 0) {
                throw new Exception('Your account has not been verified.');
            }
            if($user['paid'] == 0) {
                throw new Exception('You have not paid for this account.');
            }
            return $user;
        }   else {
            return false;

        }


    }

    function getMember($member_id)
    {
        $query = $this->db->get_where('crashprogram_member', array('id'=> $member_id) );
        return $query->row_array();
    }

    function getMemberByEmail($email)
    {
        $query = $this->db->get_where('crashprogram_member', array('email'=> trim($email) ) );
        return $query->row_array();
    }

    function getMemberlist()
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('crashprogram_member');
        return $query->result_array();
    }

    function updateMember($member_id, $data)
    {
        $this->db->where('id', $member_id);
        $this->db->update('crashprogram_member', $data);
    }

    function confirmPayment($post)
    {
        $data['fullname'] = $post['fullname'];
        $data['email'] = $post['email'];
        $data['transfer_from'] = $post['transfer_from'];
        $data['transfer_date'] = date('Y-m-d H:i:s', strtotime($post['transfer_date']) );
        $data['transfer_amount'] = $post['transfer_amount'];
        $data['filename'] = $post['filename'];
        $this->db->insert('crashprogram_payment_confirmation', $data);
    }


    public function getPaymentConfirmations()
    {
        $query = $this->db->get('crashprogram_payment_confirmation');

        $pconfirms = $query->result_array();
        $data = array();
        foreach($pconfirms as $pconfirm) {

            $pconfirm['img_url'] = 'No Image';

            if($pconfirm['filename']) {

                $pconfirm['img_url'] = '<a href="'. site_url('uploads/iicp/payment_confirmation/' . $pconfirm['filename']) .'" target="_blank"><img width="200" src="' . site_url('uploads/iicp/payment_confirmation/' . $pconfirm['filename']) . '" /></a>';

            }


            $pconfirm['transfer_amount'] = 'Rp. ' . number_format($pconfirm['transfer_amount']);

            $pconfirm['created_at'] = date('Y-m-d @H:i', strtotime($pconfirm['created_at']) );

            $data[] = $pconfirm;
        }
        return $data;
    }
}