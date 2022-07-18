<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeker extends CI_Controller {

	
	public function index()
	{

		$this->db->where('slider_tipe','main');
		$this->db->where('slider_status',1);
		$data['slider_main'] = $this->db->get('tbl_master_slider')->result();

		$this->db->where('kategori_status',1);
		$this->db->limit(8);
		$this->db->order_by('kategori_nama','asc');

		$data['kategori_job'] = $this->db->get('tbl_master_kategori_job')->result();

		$this->db->where('slider_tipe','cv');
		$this->db->where('slider_status',1);
		$data['slider_cv'] = $this->db->get('tbl_master_slider')->result();

		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		$this->db->where('slider_tipe','how');
		$this->db->where('slider_status',1);
		$data['slider_how'] = $this->db->get('tbl_master_slider')->result();
		if ($this->session->login==FALSE) {
			$this->load->view('web/header',$data);
			$this->load->view('seeker/tampilan_login',$data);
			$this->load->view('web/script_include',$data);


		}else{
			redirect('seeker/dashboard','refresh');
		}
	}

	public function register()
	{
		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		if ($this->session->login==FALSE) {
			$this->load->view('web/header',$data);
			$this->load->view('seeker/tampilan_daftar',$data);
			$this->load->view('web/script_include',$data);
		}else{
			redirect('seeker/dashboard','refresh');
		}
	}

	public function cek_login()
	{
		$email =$this->input->post('seeker_email');
		$password =md5($this->input->post('seeker_password'));
		$cek = $this->model_query->cek_seeker($email,$password)->result();
		if ($cek !=NULL) {
			foreach ($cek as $a)
			{
				if ($a->user_status==1) {
					$stp = 	$this->db->get('tbl_master_stp')->result();
					foreach ($stp as $s) {
					$data['stp_id'] = $s->stp_id;
					$data['stp_nama'] = $s->stp_nama;
					$data['stp_pemilik'] = $s->stp_pemilik;
					$data['stp_logo'] = $s->stp_logo;
					}
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
					redirect('seeker','refresh');
				}
			}
		}
		else{
			$data['title'] = 'Login Gagal';
			$data['text'] = 'Silahkan Periksa Email & Password!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data); 
			redirect('seeker','refresh');
		}
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
