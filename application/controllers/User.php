<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar'); 
			$this->load->view('admin/tampilan_user'); 
			$this->load->view('admin/footer');
			

	}

}
