<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Registration extends MY_Controller {

	public function index()
	{
		$this->load->model('Inahrs_events_m', 'event');
		$participants = $this->event->getParticipantTypes();
		$event = $this->event->getActiveEvent();
		$symposiums = $this->event->getEventSymposium($event['id']);
		$workshops = $this->event->getEventWorkshop($event['id']);
		$special_workshops = $this->event->getEventWorkshop($event['id'],1);
		// var_dump($workshops);die;
		$this->mViewData['event'] = $event;
		$this->mViewData['symposiums'] = $symposiums;
		$this->mViewData['workshops'] = $workshops;
		$this->mViewData['special_workshops'] = $special_workshops;
		$this->mViewData['participants'] = $participants;
		$this->render('registration');
	}
}