<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Paralax extends MX_Controller{

	 public function __construct()
       {
            parent::__construct();
            // Your own constructor code
       }

	public function index()
	{
		$this->load->view('paralax');
	}

	public function register()
	{
		$this->load->view('register');
	}
}