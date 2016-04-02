<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Eventreg_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function submit($event_id)
    {
        $guserdata = $this->session->userdata('event_registration');

        $userdata = @$guserdata[$event_id];

        if(empty($userdata)) throw new Exception('userdata is empty');

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
		// plus hotel
		// $this->load->model('Hotel_m');
		// foreach($userdata['hotel'] as $uhroom){
		// 	$total += $this->Hotel_m->getFee($uhroom['id']) * $uhroom['qty'] * $uhroom['night'];
		// }

        // insert
        $this->db->trans_begin();

        $data = array(
            'event_id' => (int) $event_id,
            'tranx_number' => $userdata['tranx_number'],
            'fullname' => $userdata['contact']['fullname'],
            'email' => @$userdata['contact']['email'],
            'phone' => @$userdata['contact']['phone'],
            'fax' => @$userdata['contact']['fax'],
            'mobile' => $userdata['contact']['mobile'],
            'company_name' => $userdata['contact']['company_name'],
            'company_address' => $userdata['contact']['company_address'],
            'company_country' => $userdata['contact']['company_country'],
            'company_state' => $userdata['contact']['company_state'],
            'company_city' => $userdata['contact']['company_city'],
            'total' => (int) @$total,
            'created_at' => date('Y-m-d H:i:s')

        );
        $this->db->insert('event_registrant', $data);
        $registrant_id = $this->db->insert_id();

        // insert participant
        foreach($userdata['participants'] as $key=>$participant):
            $participant_data = array(
                'registrant_id' => (int) $registrant_id,
                'participant_type' => (int) @$userdata['participants'][$key]['participant_type'],
                'fullname' => @$userdata['participants'][$key]['fullname'],
                'email' => @$userdata['participants'][$key]['email'],
                'title_prefix' => @$userdata['participants'][$key]['title_prefix'],
                'title_sufix' => @$userdata['participants'][$key]['title_sufix'],
                'phone' => @$userdata['participants'][$key]['fullname'],
                'fax' => @$userdata['participants'][$key]['fax'],
                'mobile' => @$userdata['participants'][$key]['mobile'],
                'country' => $userdata['participants'][$key]['country'],
                'state' => $userdata['participants'][$key]['state'],
                'city' => $userdata['participants'][$key]['city'],
                'address' => $userdata['participants'][$key]['address'],
                'company_name' => $userdata['participants'][$key]['company_name'],
                'company_address' => $userdata['participants'][$key]['company_address'],
                'company_country' => $userdata['participants'][$key]['company_country'],
                'company_state' => $userdata['participants'][$key]['company_state'],
                'company_city' => $userdata['participants'][$key]['company_city'],
                'id_type' => $userdata['participants'][$key]['id_type'],
                'id_number' => $userdata['participants'][$key]['id_number'],
                'graduated_from' => $userdata['participants'][$key]['graduated_from'],

            );
            $this->db->insert('event_registrant_participant' , $participant_data);

            $participant_id = $this->db->insert_id();


            // insert symposium
            if(isset($participant['registered_to']['symposium']['symposium_id'])){
                $symposium_data = array(
                    'event_participant_id' => (int) $participant_id,
                    'event_symposium_id' => (int) @$participant['registered_to']['symposium']['symposium_id'],
                    'participant_type' => @$participant['registered_to']['symposium']['participant_type'],
                    'fee' => (int) $participant['registered_to']['symposium']['fee'],
                );
                $this->db->insert('event_participant_symposium', $symposium_data);
            }

            // insert workshop
            if(@count(@$participant['registered_to']['workshops']) > 0){
                foreach($participant['registered_to']['workshops'] as $workshop)
                {
                    $workshop_data = array(
                        'event_participant_id' => (int) $participant_id,
                        'event_workshop_id' => (int) @$workshop['id'],
                        'name' => $workshop['name'],
                        'fee' => (int) $workshop['fee'],
                    );
                    $this->db->insert('event_participant_workshop', $workshop_data);
                }

            }

        endforeach;

		// insert hotel
		$uhotels = @$userdata['hotel'];
        if(count($uhotels) > 0) {
            foreach($uhotels as $uroom){
                $this->load->model('Hotel_m');
                $hotel = $this->Hotel_m->getHotel($uroom['id']);
                $hotel_data['registrant_id'] = (int) $registrant_id;
                $hotel_data['hotel_id'] = (int) $uroom['id'];
                $hotel_data['hotel_name'] = $hotel['name'];
                $hotel_data['hotel_room'] = $hotel['room_type'];
                $hotel_data['night'] = (int) $uroom['night'];
                $hotel_data['room_count'] = (int) $uroom['qty'];
                $hotel_data['price'] = (int) $hotel['nett_price'];
                $hotel_data['total'] = (int) $hotel['nett_price'] * $uroom['qty'] * $uroom['night'];


                $hotel_data['book_from'] = $date = DateTime::createFromFormat('d/m/Y', $uroom['book_from'])->format('Y-m-d');
                $hotel_data['book_to'] = $date = DateTime::createFromFormat('d/m/Y', $uroom['book_to'])->format('Y-m-d');

                $this->db->insert('event_registrant_hotel', $hotel_data);
            }
        }



        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            throw new Exception('An error has occurred while inserting your application to database.');
        }
        else
        {
            $this->db->trans_commit();
            // hapus session di sini

        }

		$userdata['total'] = $total;
        $userdata['insert_id'] = $registrant_id;
        return $userdata;

    }

    public function getRegistrants($event_id)
    {
        $this->db->select('r.*');
        $this->db->order_by('r.id', 'desc');

        if(@$event_id) {
            $this->db->where('event_id', $event_id);
        }

        $query = $this->db->get('event_registrant r');
        $registrants = $query->result_array();

        return $registrants;
    }

    public function getRegistrantsExport()
    {
        $this->db->select('r.*,
        p.id as participant_id,
        p.fullname as participant_name,
        ptype.name as participant_type,
        p.email as participant_email,
        p.phone as participant_phone,
        p.fax as participant_fax,
        ');


        $this->db->join('event_registrant_participant p', 'p.registrant_id=r.id', 'left');
        $this->db->join('event_participant_type ptype', 'ptype.id=p.participant_type', 'left');

        $this->db->order_by('r.id', 'desc');
        $query = $this->db->get('event_registrant r');
        $participants = $query->result_array();

        $curr_id = null;

        foreach($participants as $key => $row){


            // get sympo
            $this->db->join('event_symposium', 'event_symposium.id=ps.event_symposium_id', 'left');
            $this->db->where('event_participant_id', $row['participant_id']);
            $qps = $this->db->get('event_participant_symposium ps');

            $row['symposium'] = $qps->row_array();
            $participants[$key] = $row;


            // get workshops
            $this->db->join('event_workshop', 'event_workshop.id=pw.event_workshop_id', 'left');
            $this->db->where('event_participant_id', $row['participant_id']);
            $qpw = $this->db->get('event_participant_workshop pw');
            $row['workshops'] = $qpw->result_array();
            $participants[$key] = $row;

            // get hotels cukup sekali per registrant
            if($curr_id != $row['id']) {
                $this->db->where('registrant_id', $row['id']);
                $qh = $this->db->get('event_registrant_hotel rh');
                $row['hotels'] = $qh->result_array();
                $participants[$key] = $row;
            }

            $curr_id = $row['id'];


        }

        return $participants;
    }


    public function showRegistrant($registrant_id)
    {
        $result = array();

        $query = $this->db->get_where('event_registrant r', array('id'=> $registrant_id));
        $registrant = $query->row_array();

        if($query->num_rows() == 0) throw new Exception('Registrant id= ' . $registrant_id .' not found');

        $result = $registrant;

        // get event
        $query = $this->db->get_where('event', array('id'=>$registrant['event_id']));
        $event = $query->row_array();
        $result['event'] = $event;

        // get participants
        $query = $this->db->get_where('event_registrant_participant', array( 'registrant_id'=>$registrant['id'] ) );
        $participants = $query->result_array();

        // get symposiums and workshops
        foreach($participants as $key=>$participant)
        {
            $query = $this->db->get_where('event_participant_symposium', array('event_participant_id' => $participant['id']));
            $symposium = $query->row_array();
            if($symposium) $participants[$key]['symposium'] = $symposium;

            $query = $this->db->get_where('event_participant_workshop', array( 'event_participant_id' => $participant['id'] ) );
            $workshops = $query->result_array();
            $participants[$key]['workshops'] = $workshops;
        }

        $result['participants'] = $participants;

        // get hotels

        $query = $this->db->get_where('event_registrant_hotel', array( 'registrant_id'=>$registrant['id'] ) );
        $hotels = $query->result_array();
        $result['hotels'] = $hotels;

        return $result;
    }


    public function getInvoice($tx_number, $email)
    {
        $this->db->select('event_registrant.*,event.title as event_title, event.dates as event_date, event.place as event_place');
        $this->db->join('event','event_registrant.event_id=event.id','left');
        $query = $this->db->get_where('event_registrant', array('tranx_number'=>$tx_number, 'email'=>$email));
        $registrant = $query->row_array();


        if(!$registrant) return false;

        // get participant
        $query = $this->db->get_where('event_registrant_participant', array('registrant_id' => $registrant['id']));
        $participants = $query->result_array();

        foreach($participants as $key=>$participant)
        {
            // get symposium
            $query = $this->db->get_where('event_participant_symposium', array('event_participant_id'=>$participant['id']));
            $symposium = $query->row_array();

            // get workshops
            $query = $this->db->get_where('event_participant_workshop', array('event_participant_id'=>$participant['id']));
            $workshops = $query->result_array();

            $participants[$key]['symposium'] = $symposium;
            $participants[$key]['workshops'] = $workshops;
        }

        $registrant['participants'] = $participants;

		// get hotels

        $query = $this->db->get_where('event_registrant_hotel', array('registrant_id' => $registrant['id']));
		$hotels = $query->result_array();

		$registrant['hotels'] = $hotels;

        return $registrant;
    }

    public function confirmPayment($data)
    {
        $data['transfer_date'] = date('Y-m-d', strtotime($data['transfer_date']));
        $this->db->insert('event_payment_confirmation', $data);
    }

    public function getPaymentConfirmations()
    {
        $query = $this->db->get('event_payment_confirmation');

        $pconfirms = $query->result_array();
        $data = array();
        foreach($pconfirms as $pconfirm) {
            $pconfirm['img_url'] = '';
            if($pconfirm['file_name']) {
                if($pconfirm['registrant_id']) {
                    $pconfirm['img_url'] = site_url('uploads/payment_confirm/eventreg/' . $pconfirm['registrant_id'] . '/' . $pconfirm['file_name']);
                } else {
                    $pconfirm['img_url'] = site_url('uploads/payment_confirm/eventreg/' . $pconfirm['file_name']);
                }
            }

            $pconfirm['transfer_amount'] = 'Rp. ' . number_format($pconfirm['transfer_amount']);

            $pconfirm['created_at'] = date('Y-m-d @H:i', strtotime($pconfirm['created_at']) );

            $data[] = $pconfirm;
        }
        return $data;
    }

    public function markPaid($reg_id)
    {
		$this->db->where('id', $reg_id);
        $this->db->update('event_registrant', array('paid' => 1));
    }
    public function markUnpaid($reg_id)
    {
		$this->db->where('id', $reg_id);
        $this->db->update('event_registrant', array('paid' => 0));

    }

    public function delete($reg_id)
    {
        $this->db->where('id', $reg_id);
        $this->db->delete('event_registrant');
    }

}