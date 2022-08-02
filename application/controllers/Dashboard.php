<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('landing','refresh');
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
			$this->db->where('slider_tipe','main');
			$this->db->where('slider_status',1);
			$data['slider_main'] = $this->db->get('tbl_master_slider')->result();
			
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar'); 
			$this->load->view('seeker/tampilan_dashboard',$data);
			$this->load->view('templates/footer');
		}
		if ($this->session->user_level==3) {
			$this->db->where('slider_tipe','main');
			$this->db->where('slider_status',1);
			$data['slider_main'] = $this->db->get('tbl_master_slider')->result();
			
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar'); 
			$this->load->view('provider/tampilan_dashboard',$data);
			$this->load->view('templates/footer');
			
		}

	}

	public function ubah_password()
	{
		$data_password = array(
			'user_password' => md5($this->input->post('password_baru_user')),
		);

		$this->db->where('user_id',$this->session->user_id);
		$result = $this->db->update('tbl_master_user',$data_password);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah!';
			$data['icon'] = 'success';
			

		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Password Gagal Diubah!';
			$data['icon'] = 'error';
			
		}	
		$this->session->set_flashdata($data);
		redirect('dashboard','refresh');
	}

	public function logout()
	{
		$this->db->where('user_id',$this->session->user_id);
		$logout = $this->db->update('tbl_master_user',array('user_login_status' => 0, ));
		if ($logout) {
			$this->session->sess_destroy();
			redirect('landing');
		}
	}

}
