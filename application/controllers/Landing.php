<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	
	public function index()
	{
		$this->load->view('web/header');
		$this->load->view('web/tampilan_landing');
		$this->load->view('web/footer');
	}

	
}
