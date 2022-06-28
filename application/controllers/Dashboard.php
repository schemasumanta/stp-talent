<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('login','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function index()
	{
		if ($this->session->user_level==1) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar'); 
			$this->load->view('admin/tampilan_dashboard'); 
			$this->load->view('admin/footer');
			
		}
		if ($this->session->user_level==2) {
			$this->load->view('seeker/tampilan_dashboard');  
		}

		if ($this->session->user_level==3) {
			$this->load->view('provider/tampilan_dashboard');  
		}

	}

}
