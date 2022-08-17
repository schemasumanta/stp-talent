<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premium extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('landing','refresh');
		}

		if ($this->session->user_level!=1) {
			redirect('landing','refresh');
		}
		
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/maintenance'); 
		$this->load->view('admin/footer');


	}


}
