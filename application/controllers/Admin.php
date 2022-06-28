<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	public function index()
	{
		$this->load->view('admin/tampilan_login');
	}

	public function cek_login()
	{
		$email =$this->input->post('user_email');
		$password =md5($this->input->post('user_password'));
		$cek = $this->model_query->cek_admin($email,$password)->result();
		if ($cek !=NULL) {
			foreach ($cek as $a)
			{
				if ($a->user_status==1) {
					
					$data['user_id'] = $a->user_id;
					$data['user_nama'] = $a->user_nama;
					$data['user_email'] = $a->user_email;
					$data['user_level'] = $a->user_level;
					$data['user_foto'] = $a->user_foto;
					$data['user_telepon'] = $a->user_telepon; 
					$data['login'] = TRUE;
					$this->session->set_userdata($data);

					$data = array(

						'user_login_status'=> "1",
					);

					$this->db->where('user_id', $a->user_id);
					$this->db->update('tbl_master_user', $data);
					redirect('dashboard','refresh');
				}else{

					$data['title'] = 'Login Gagal';
					$data['text'] = 'User Belum Diaktivasi!';
					$data['icon'] = 'error';
					$this->session->set_flashdata($data); 
					redirect('admin','refresh');
				}
			}
		}
		else{
			$data['title'] = 'Login Gagal';
			$data['text'] = 'Silahkan Periksa Email & Password!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data); 
			redirect('admin','refresh');
		}
	}
	public function logout()
	{
		$this->db->where('user_id',$this->session->user_id);
		$logout = $this->db->update('tbl_master_user',array('user_login_status' => 0, ));
		if ($logout) {
			$this->session->sess_destroy();
			redirect('admin');
		}
	}
}
