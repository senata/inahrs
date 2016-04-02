<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Ajax extends MY_Controller {

    var $event_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $event_id = $this->input->get('event_id');

        if(!$event_id) {
            die('Invalid event_id');
        }

        $this->event_id = $event_id;

        $userdata = $this->session->userdata('event_registration'); // copy ke temporary variable

        if(!isset($userdata[$this->event_id])) {
            $userdata[$this->event_id] = array();
        }

        if(!isset($userdata[$event_id]['tranx_number']) OR @!$userdata[$event_id]['tranx_number']){ // jika tak ada nomor tranx
            $userdata[$event_id]['tranx_number'] = $this->generate_tranx_number();

            $this->session->set_userdata('event_registration',$userdata);
        }


    }


    public function index()
    {
    }

    public function register()
    {
        //sleep(1);

        // catches forms data and save into session

        $form_name = $this->input->post('form_name');

        if($form_name == 'contact') {

            $contact = array(
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'fax' => $this->input->post('fax'),
                'mobile' => $this->input->post('mobile'),
                'company_name' => $this->input->post('company_name'),
                'company_address' => $this->input->post('company_address'),
                'company_country' => $this->input->post('company_country'),
                'company_state' => $this->input->post('company_state'),
                'company_city' => $this->input->post('company_city'),
            );
            $userdata = $this->session->userdata('event_registration');
            $userdata[$this->event_id]['contact'] = $contact;
            $this->session->set_userdata('event_registration', $userdata);

        }
        else if ($form_name == 'participants')
        {
            $participants = $this->input->post('participants');

            // save current userdata
            $userdata = $this->session->userdata('event_registration');

            // save current symposium and workshops
            if(count( @$userdata[$this->event_id]['participants'] ) > 0){
                foreach( $userdata[$this->event_id]['participants'] as $key=> $participant){
                    $participants[$key]['registered_to']  = @$participant['registered_to'];
                }
            }

            $userdata[$this->event_id]['participants'] = $participants;

            $this->session->set_userdata('event_registration', $userdata);
        }
        else if ($form_name == 'fees')
        {
            // simpan ke participants
            $participations = $this->input->post('participants');
            $userdata = $this->session->userdata('event_registration');
            $participants = $userdata[$this->event_id]['participants'];
            $event_id = $this->input->get('event_id');

            $this->load->model('Event_m');

            if(count($participations) > 0) {// simpan hanya jika ada data post participants

                $this->load->model('Event_m');

                foreach($participations as $key => $events) {

                    // checks required fields

                    if(isset($participants[$key]['registered_to']['not_participate_symposium']) and $participants[$key]['registered_to']['not_participate_symposium']){
                        unset($events['symposium']);
                    } else {
                        // masukkan membership type ke symposium
                        $p = $this->Event_m->getParticipantType($participants[$key]['participant_type']);
                        $events['symposium']['participant_type'] = $p['name'];
                        // get symposium
                        $symposium = $this->Event_m->getSymposium($event_id, $participants[$key]['participant_type']);
                        $events['symposium']['symposium_id'] = (int) $symposium['id'];
                    }
                    if(@count(@$participations[$key]['workshops']) > 0 ){
                        // kosongkan array dulu biar $events['workshops'][0] inputan user gak ikut
                        $events['workshops'] = array();
                        foreach($participations[$key]['workshops'] as $keyw => $workshop){
                            $w = explode('|', $workshop);
                            if(@is_numeric($w[0])) {
                                $events['workshops'][$w[0]] = array('id' => @$w[0], 'name' => @$w[1], 'fee' => (int) @$w[2]);
                            }
                        }
                    }

                    $userdata[$this->event_id]['participants'][$key]['registered_to'] = $events;
                }

                $this->session->set_userdata('event_registration', $userdata);
            }

        }
        else if ($form_name == 'accomodation')
        {
			$hotels = $this->input->post('hotel');

			$registration_data = $this->session->userdata('event_registration');
			$registration_data[$this->event_id]['hotel'] = array();

			foreach($hotels as $hotel){
				if(@$hotel['id'] > 0){
					$registration_data[$this->event_id]['hotel'][] = $hotel;
				}
			}
			$this->session->set_userdata('event_registration', $registration_data);

        }
        else if ($form_name == 'flight')
        {
            $need_flight = (bool) $this->input->post('need_flight');
            $passenger_count = $this->input->post('passenger_count');
            $passengers = $this->input->post('passengers');
            $registration_data = $this->session->userdata('event_registration');

            $registration_data[$this->event_id]['flight']['need_flight'] = $need_flight;
            $registration_data[$this->event_id]['flight']['passenger_count'] = $passenger_count;
            $registration_data[$this->event_id]['flight']['passengers'] = $passengers;

            $this->session->set_userdata('event_registration', $registration_data);
        }
        else if ($form_name == 'car')
        {

            $this->session->set_userdata('flight', $newdata);
        }
        else {

        }

        $step_number = $this->input->post('step_number');
        $functionName = 'step' . $step_number;
        $this->$functionName();

    }


    public function step1()
    {
        $guserdata = $this->session->userdata('event_registration');
        $data['contact'] = @$guserdata[$this->event_id]['contact'];

        $this->load->model('Country_m');
        $data['countries'] = $this->Country_m->getAll();
        $data['states'] = $this->Country_m->getStates();

        $this->load->view('eventreg/step1_v', $data);
    }

    private function step2()
    {
        $guserdata = $this->session->userdata('event_registration');
        $data['participants'] = @$guserdata[$this->event_id]['participants'];

        $this->load->model('Country_m');
        $data['countries'] = $this->Country_m->getAll();
        $states = $this->Country_m->getStates();
        $country_states = array();
        foreach($states as $state) {
            $country_states[$state['country_id']][] = $state['province'];
        }
        $data['country_states'] = $country_states;
        // var_dump($country_states);die;
        $this->load->model('Event_m');
        $data['participant_types'] = $this->Event_m->getParticipantTypes();


        $this->load->view('eventreg/step2_v', $data);
    }

    private function step3()
    {
        $data = '';

        $guserdata = $this->session->userdata('event_registration');

        foreach($guserdata as $g)
        {
            $g = $g;
        }


        $this->load->model('Event_m');
        $data['today'] = date('Y-m-d');
        $data['event'] = $this->Event_m->getEvent($this->event_id);
        $data['symposium'] = $this->Event_m->getSymposiums($this->event_id, $g);
        $data['workshops'] = $this->Event_m->getWorkshops($this->event_id, $g);
        $data['package_workshops'] = $this->Event_m->getPackageWorkshops($this->event_id, $g);
        $guserdata = $this->session->userdata('event_registration');
        $data['satellite_symposium'] = $this->Event_m->getSatteliteSymposium($this->event_id, $g);
        $data['satellite_workshop'] = $this->Event_m->getSatteliteWorkshop($this->event_id, $g);
        $data['participants'] = @$guserdata[$this->event_id]['participants'];

        $today_date = date('Y-m-d');
        if($today_date < $data['event']['date_boundary']){
            $data['is_before_boundary'] = true;
        } else {
            $data['is_before_boundary'] = false;
        }

        $this->load->view('eventreg/step3_v', $data);

    }

    private function step4()
    {
        $this->load->model('Hotel_m');
        $hotels = $this->Hotel_m->getAll();
        foreach($hotels as $key=>$hotel){
            $hotels[$key]['image_url'] = "http://admin.inahrsdev.or.id/assets/content_inahrs/inahrs_upload/images/".$hotel['image'];
            //base_url('uploads/hotel/'. $hotel['image']);
        }

		$guserdata = $this->session->userdata('event_registration');
		$uhotels = @$guserdata[$this->event_id]['hotel'];
		$data['hotels'] = $hotels;
        $data['uhotels'] = $uhotels;
        $this->load->view('eventreg/step4_v', $data);
    }

    // private function step5()
    // {
    //     $data = '';
    //     $guserdata = $this->session->userdata('event_registration');
    //     $data['need_flight'] = @$guserdata[$this->event_id]['flight']['need_flight'];
    //     $data['passenger_count'] = @$guserdata[$this->event_id]['flight']['passenger_count'];
    //     $data['passengers'] = @$guserdata[$this->event_id]['flight']['passengers'];

    //     $this->load->model('Airline_m');
    //     $data['airlines'] = $this->Airline_m->getAirlines();

    //     $this->load->view('eventreg/step5_v', $data);
    // }

    // private function step6()
    // {
    //     $data = '';
    //     $this->load->view('eventreg/step6_v', $data);
    // }

    private function step5()
    {
        $data = '';

        $guserdata = $this->session->userdata('event_registration');
        $userdata = @$guserdata[$this->event_id];
        $data['reg_data'] = $userdata;

        $this->load->model('Event_m');
        $event = $this->Event_m->getEvent($this->input->get('event_id'));
        $data['event_title'] = $event['title'];
        $data['dates'] = $event['dates'];
        $data['place'] = $event['place'];
        $data['participants'] = @$userdata['participants'];

        // calculate total
        $total = 0;
        foreach($userdata['participants'] as $key=>$participant){
            // jika ada symposium
            if(isset($participant['registered_to']['symposium']['fee'])) {
                $total += $participant['registered_to']['symposium']['fee'];
            }
            // workshops
            if(@count(@$participant['registered_to']['workshops']) > 0) {
                foreach($participant['registered_to']['workshops'] as $workshop){
                    // ambil harga dari database
                    $total += $workshop['fee'];
                }

            }
        }

		$this->load->model('Hotel_m');
		foreach ( $userdata['hotel'] as $hotel ) {
			$total += $this->Hotel_m->getFee($hotel['id']) * $hotel['qty'] * $hotel['night'];

			$hroom = $this->Hotel_m->getHotel($hotel['id']);
            $hroom['night'] = $hotel['night'];
			$hroom['qty'] = $hotel['qty'];
			$data['hotels'][] = $hroom;
		}

        $data['grand_total'] = $total;


        $this->load->view('eventreg/stepSummary_v', $data);
    }
    private function generate_tranx_number()
    {
        $this->load->helper('string');
        return date('Ymd') . random_string('numeric', 8);
    }


}


