<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 27-Mar-15
 * Time: 9:33 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');


class Country extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function getStates()
    {
        $country_id = $this->input->get('countryId');
        $this->load->model('Country_m');
        $response['states'] = $this->Country_m->getStates($country_id);
        echo json_encode($response);
    }

    public function getCities()
    {
        $country_id = $this->input->get('countryId');
        $state = $this->input->get('state');
        $this->load->model('Country_m');
        $response['cities'] = $this->Country_m->getCities($country_id, $state);
        echo json_encode($response);
    }


}