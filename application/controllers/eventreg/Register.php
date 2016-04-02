<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Register extends MY_Controller {

    public function index()
    {
        $event_id = $this->input->get('event_id');
        $this->load->model('Event_m');
        $this->load->model('Setting_m','setting');
        $event = $this->Event_m->getEvent($event_id);
        $data = array(
            'event' => $event
        );
        $this->load->view('eventreg/register_v', $data);
    }

    public function submit()
    {
        $event_id = $this->input->get('event_id');
        // masukkan database
        $this->load->model('Setting_m', 'setting');
        try
        {
            $this->load->model('Eventreg_m');
            $submit_return = $this->Eventreg_m->submit($event_id);
        }
        catch( Exception $e)
        {
            echo "Sorry an error has occurred when submitting your application. Please contact site owner." . "<br />";
            echo "Error message: " . $e->getMessage();
        }

        if($submit_return) {

            // hapus session
            $userdata = $this->session->userdata('event_registration');

            $regdata = $userdata[$event_id];

            // get email
            $registrant_email = $userdata[$event_id]['contact']['email'];


            // kirim email
            $this->load->library('email');

            $this->email->from(SYS_EMAIL, 'InaHRS Mail System');
            $this->email->reply_to(ADMIN_EMAIL, 'InaHRS Administrator');

            $this->email->to($registrant_email);

            $this->email->subject('InaHRS Event Registration');

            $data['placed_on'] = date('j F Y @H:i');
            $data['tx_number'] = $submit_return['tranx_number'];
            $data['email'] = $submit_return['contact']['email'];
            $data['invoice_url'] = site_url('eventreg/invoice?tx_num='. $data['tx_number'] .'&email=' .rawurlencode( $data['email'])  );
            $data['site_contact_email'] = $this->setting->getSetting('site/contact/email');
            $data['contact'] = $submit_return['contact'];
			$data['total'] = $submit_return['total'];

            $message = $this->load->view('email/event_registration_v',  $data, TRUE);

            $message = str_replace('__ITEMS__', $this->getItemsHtml($regdata['participants']), $message);

            // hotel table
            $message = str_replace('__HOTEL_TABLE__', $this->getHotelHtml($submit_return['insert_id']), $message);

            $payment_info = $this->setting->getSetting('payment/bank_transfer/info');

            $payment_info = '<p>Bank Transfer</p>' .  $payment_info;
            $message = str_replace('__PAYMENT_INFO__', $payment_info, $message);

            $this->email->message($message);
            $this->email->send();

            $userdata[$event_id] = '';
            $this->session->set_userdata('event_registration', $userdata);

            // redirect ke invoice
            redirect('eventreg/invoice?tx_num=' .  $submit_return['tranx_number'] . '&email=' . $submit_return['contact']['email']);

        } else {
            echo "Error while submitting your application. Server didn't reply anything.";
        }


    }


    public function showSession()
    {
        var_dump($this->session->userdata('event_registration'));
    }

    function getSessionContact()
    {
        $event_id = $this->input->get('event_id');
        $guserdata = $this->session->userdata('event_registration');
        $userdata = @$guserdata[$event_id]['contact'];
        if($userdata){
            echo json_encode($userdata);
        } else {
            echo json_encode(array());
        }
    }

    function getHotelHtml($registrant_id)
    {
        $this->load->model('Hotel_m');
        $hotels = $this->Hotel_m->getRegHotels($registrant_id);

        if(count($hotels) > 0) {
            $html = '<table>';
            $html .= '<thead><tr><th
style="font-weight:700;padding:10px 15px;background:#f1f1f1;text-transform:uppercase;text-align:left;font-size:11px; width: 40%;">Hotel</th><th style="font-weight:700;padding:10px 15px;background:#f1f1f1;text-transform:uppercase;text-align:left;font-size:11px; width: 40%;">Room Type</th><th style="font-weight:700;padding:10px 15px;background:#f1f1f1;text-transform:uppercase;text-align:left;font-size:11px; width: 40%;">Night</th><th style="font-weight:700;padding:10px 15px;background:#f1f1f1;text-transform:uppercase;text-align:left;font-size:11px; width: 40%;">Room</th><th style="font-weight:700;padding:10px 15px;background:#f1f1f1;text-transform:uppercase;text-align:left;font-size:11px; width: 40%;">Price</th><th style="font-weight:700;padding:10px 15px;background:#f1f1f1;text-transform:uppercase;text-align:left;font-size:11px; width: 40%;">Total</th></tr></thead>';
            $html .='<tbody>';
            // loop
            foreach($hotels as $hotel){
                $html .= '<tr><td>'.$hotel['hotel_name'].'</td>';
                $html .= '<td>'.$hotel['hotel_room'].'</td>';
                $html .= '<td>'.$hotel['night'].'</td>';
                $html .= '<td>'.$hotel['room_count'].'</td>';
                $html .= '<td>'.number_format($hotel['price'] * 1000).'</td>';
                $html .= '<td>'.number_format($hotel['total'] * 1000).'</td>';
                $html .= '</tr>';
            }
            $html .='</tbody>';
            $html .= '</table>';

            return $html;
        } else {
            return '';
        }

    }

    function getItemsHtml($participants)
    {
        $output = '';
        foreach($participants as $key => $participant):
            $rowspan = 0;
            if(isset($participant['registered_to']['symposium'])) $rowspan += 1;
            $rowspan += @count(@$participant['registered_to']['workshops']);
            if(isset($participant['registered_to']['symposium'])):
                $output .= '<tr>';
                if($rowspan>0) $rowspan = 'rowspan="'.$rowspan . '"';
                $output .= '<td '. $rowspan .'>' . strtoupper($participant['fullname']).'</td>';
                $output .= '<td>Symposium for ' . $participant['registered_to']['symposium']['participant_type'] . '</td>';
                $output .= '<td>Rp. ' . @number_format((int) @$participant['registered_to']['symposium']['fee'] * 1000) . '</td>';
                $output .= '</tr>';
            endif;


            if(@count(@$participant['registered_to']['workshops']) > 0) {
                foreach($participant['registered_to']['workshops'] as $p=>$workshop) :

                    $output .= '<tr>';

                    if(!isset($participant['registered_to']['symposium'])  and $p == 0):
                        if($rowspan>0 and $p == 0) $rowspan = 'rowspan="'.$rowspan.'"';
                        $output .= '<td '.$rowspan.' >'. strtoupper($participant['fullname']);
                        $output .= '</td>';
                    endif;

                    $output .= '<td>' . $workshop['name'] . '</td>';
                    $output .= '<td>Rp. '. number_format($workshop['fee'] * 1000) . '</td>';
                    $output .= '</tr>';
                endforeach;
            }
        endforeach;

        return $output;
    }
}


