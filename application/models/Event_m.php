<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Event_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getEvent($event_id)
    {
        $this->db->where('id', $event_id);
        $query = $this->db->get('event');
        return $query->row_array();
    }

    function saveEvent($event_id, $data)
    {
        $this->db->where('id', $event_id);
        $this->db->update('event', $data);
    }

    function getEvents()
    {
        $query = $this->db->get('event');
        return $query->result_array();
    }

    function getSymposium($event_id, $membership_type)
    {
        $this->db->where('event_id', $event_id);
        $this->db->where('membership_type', $membership_type);
        $this->db->where('deleted', 0);
        $query = $this->db->get('event_symposium');
        return $query->row_array();
    }

    function getSymposiums($event_id, $userdata = null)
    {

        $sympo = array();
        if($userdata) {
            if(isset($userdata['participants']) and count($userdata['participants']) > 0) {

                foreach($userdata['participants'] as $participant){

                    $this->db->select('event_symposium.*, local.scope, local.scope_value, local.fee_before_boundary AS local_fbb, local.fee_after_boundary AS local_fab');

                    $this->db->join('event_symposium_localfee local', 'event_symposium.id=local.sympo_id', 'left');

                    $this->db->where('membership_type', $participant['participant_type']);
                    $this->db->where('event_id', $event_id);
                    $this->db->where('deleted', 0);
                    $query = $this->db->get('event_symposium');

                    $sympo_fee = $query->row_array();

                    if( ( $sympo_fee['scope'] == 'state' and $participant['state'] == $sympo_fee['scope_value'] )  OR $this->ifBali($participant['graduated_from']) ) {
                        $sympo_fee['fee_before_boundary'] = $sympo_fee['local_fbb'];
                        $sympo_fee['fee_after_boundary'] = $sympo_fee['local_fab'];
                        $sympo_fee['discounted'] = true;
                    }

                    $sympo[] = $sympo_fee;

                }


            }
        }

        return $sympo;
    }

    function getWorkshops($event_id, $userdata = null)
    {
        $workshops = array();
        if($userdata) {
            if (isset($userdata['participants']) and count($userdata['participants']) > 0) {

                foreach($userdata['participants'] as $key => $participant){


                    $this->db->select('event_workshop.*, local.scope, local.scope_value, local.fee_before_boundary AS local_fbb, local.fee_after_boundary AS local_fab');

                    $this->db->join('event_workshop_localfee local', 'event_workshop.id=local.workshop_id', 'left');


                    $this->db->where('event_id', $event_id);
                    $this->db->where('special_package', 0);
                    $this->db->where('deleted', 0);
                    $query =$this->db->get('event_workshop');

                    $workshop_list = $query->result_array();

                    foreach($workshop_list as $key2 => $w)
                    {

                        if( ( $w['scope'] == 'state' and $participant['state'] == $w['scope_value'] )  OR $this->ifBali($participant['graduated_from']) ) {
                            $w['fee_before_boundary'] = $w['local_fbb'];
                            $w['fee_after_boundary'] = $w['local_fab'];
                            $w['discounted'] = true;
                            $workshop_list[$key2] = $w;
                        }
                    }


                    $workshops[$key] = $workshop_list;


                }
            }
        }

        return $workshops;
    }

    function getPackageWorkshops($event_id, $userdata = null)
    {
        $workshops = array();
        if($userdata) {
            if (isset($userdata['participants']) and count($userdata['participants']) > 0) {

                foreach($userdata['participants'] as $key => $participant){


                    $this->db->select('event_workshop.*, local.scope, local.scope_value, local.fee_before_boundary AS local_fbb, local.fee_after_boundary AS local_fab');

                    $this->db->join('event_workshop_localfee local', 'event_workshop.id=local.workshop_id', 'left');


                    $this->db->where('event_id', $event_id);
                    $this->db->where('special_package', 1);
                    $this->db->where('deleted', 0);
                    $query =$this->db->get('event_workshop');

                    $workshop_list = $query->result_array();

                    foreach($workshop_list as $key2 => $w)
                    {

                        if( ($w['scope'] == 'state' and $participant['state'] == $w['scope_value'] ) OR $this->ifBali($participant['graduated_from']) )  {
                            $w['fee_before_boundary'] = $w['local_fbb'];
                            $w['fee_after_boundary'] = $w['local_fab'];
                            $w['discounted'] = true;
                            $workshop_list[$key2] = $w;
                        }
                    }


                    $workshops[$key] = $workshop_list;


                }
            }
        }

        return $workshops;


    }

    function getSatteliteSymposium($event_id, $userdata = null)
    {
        $workshops = array();
        if($userdata) {
            if (isset($userdata['participants']) and count($userdata['participants']) > 0) {

                foreach($userdata['participants'] as $key => $participant){


                    $this->db->select('event_workshop.*, local.scope, local.scope_value, local.fee_before_boundary AS local_fbb, local.fee_after_boundary AS local_fab');

                    $this->db->join('event_workshop_localfee local', 'event_workshop.id=local.workshop_id', 'left');


                    $this->db->where('event_id', $event_id);
                    $this->db->where('special_package', 2);
                    $this->db->where('deleted', 0);
                    $query =$this->db->get('event_workshop');

                    $workshop_list = $query->result_array();

                    foreach($workshop_list as $key2 => $w)
                    {

                        if( ($w['scope'] == 'state' and $participant['state'] == $w['scope_value'] ) OR $this->ifBali($participant['graduated_from']) )  {
                            $w['fee_before_boundary'] = $w['local_fbb'];
                            $w['fee_after_boundary'] = $w['local_fab'];
                            $w['discounted'] = true;
                            $workshop_list[$key2] = $w;
                        }
                    }


                    $workshops[$key] = $workshop_list;


                }
            }
        }

        return $workshops;


    }

    function getSatteliteWorkshop($event_id, $userdata = null)
    {
        $workshops = array();
        if($userdata) {
            if (isset($userdata['participants']) and count($userdata['participants']) > 0) {

                foreach($userdata['participants'] as $key => $participant){


                    $this->db->select('event_workshop.*, local.scope, local.scope_value, local.fee_before_boundary AS local_fbb, local.fee_after_boundary AS local_fab');

                    $this->db->join('event_workshop_localfee local', 'event_workshop.id=local.workshop_id', 'left');


                    $this->db->where('event_id', $event_id);
                    $this->db->where('special_package', 3);
                    $this->db->where('deleted', 0);
                    $query =$this->db->get('event_workshop');

                    $workshop_list = $query->result_array();

                    foreach($workshop_list as $key2 => $w)
                    {

                        if( ($w['scope'] == 'state' and $participant['state'] == $w['scope_value'] ) OR $this->ifBali($participant['graduated_from']) )  {
                            $w['fee_before_boundary'] = $w['local_fbb'];
                            $w['fee_after_boundary'] = $w['local_fab'];
                            $w['discounted'] = true;
                            $workshop_list[$key2] = $w;
                        }
                    }


                    $workshops[$key] = $workshop_list;


                }
            }
        }

        return $workshops;


    }
/*
    function getWorkshopPrice($workshop_id)
    {
        $this->db->where('id', $workshop_id);
        $query =$this->db->get('event_workshop');
        return $query->row_array()[''];
    }
*/
    function getParticipantTypes()
    {
        $query = $this->db->get('event_participant_type');
        return $query->result_array();
    }

    function getParticipantType($participant_type_id)
    {
        $this->db->where('id',$participant_type_id);
        $query = $this->db->get('event_participant_type');
        return $query->row_array();
    }



    function insertAbstract($data)
    {
        $insert = array(
            'topic' => $data['topic'],
            'file' => $data['file_abstract'],
            'cv_file' => $data['file_cv'],
        );

        if(isset($data['email']) and $data['email']) $insert['email'] = $data['email'];
        if(isset($data['phone']) and $data['phone']) $insert['phone'] = $data['phone'];

        $this->db->insert('event_abstract', $insert);

        if($this->db->affected_rows()) return $this->db->insert_id();

        return false;
    }

    function getAbstracts()
    {
        $query = $this->db->get('event_abstract');
        return $query->result_array();
    }

    function deleteAbstract($id)
    {
        $this->db->delete('event_abstract', array('id'=>$id));
        //delete files
        $this->rrmdir('./uploads/abstract_files/' . $id);

    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    function ifBali($graduated_from)
    {
        $pos = stripos($graduated_from, 'denpasar');
        if ($pos !== false) {
            return true;
        }

        return false;
    }

    function getEventList()
    {
        $this->db->order_by('id','desc');
        $q = $this->db->get('event');
        return $q->result_array();
    }
}