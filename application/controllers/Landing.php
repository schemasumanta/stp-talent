<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	
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
		$this->db->select('
			a.lowongan_id,
			a.lowongan_judul,
			a.perusahaan_id,
			a.lowongan_gaji_min,
			a.lowongan_gaji_max,
			a.lowongan_gaji_secret,
			lowongan_created_date,
			b.perusahaan_logo,
			c.kategori_nama,
			d.jabatan_nama,
			e.prov_nama,
			f.kabkota_nama'
		);
		$this->db->join('tbl_perusahaan b','b.perusahaan_id=a.perusahaan_id');
		$this->db->join('tbl_master_kategori_job c','c.kategori_id=a.kategori_id');
		$this->db->join('tbl_master_jabatan d','d.jabatan_id=a.jabatan_id');
		$this->db->join('tbl_master_provinsi e','e.prov_id=b.perusahaan_prov');
		$this->db->join('tbl_master_kabkota f','f.kabkota_id=b.perusahaan_kabkota');
		$this->db->limit(8);
		$this->db->order_by('lowongan_id','desc');	
		$data['featured_job'] = $this->db->get('tbl_lowongan_pekerjaan a')->result();
		$this->load->view('web/header',$data);
		$this->load->view('web/tampilan_landing',$data);
		$this->load->view('web/footer',$data);
		$this->load->view('web/script_include',$data);

	}

	public function login()
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
			$this->load->view('web/tampilan_login',$data);
			$this->load->view('web/script_include',$data);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function register()
	{
		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		if ($this->session->login==FALSE) {
			$this->load->view('web/header',$data);
			$this->load->view('web/tampilan_daftar',$data);
			$this->load->view('web/script_include',$data);
		}else{
			redirect('seeker/dashboard','refresh');
		}
	}


	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


	public function kirim_email($id_user,$email)
	{
		$data['id_user'] = $id_user;
		$data['email'] = $email;
		$content = $this->load->view('web/body_email',$data,true);
		return $content;
	}

	public function cek_forgot()
	{
		$email =$this->input->post('seeker_email');
		$cek = $this->model_query->cek_email($email)->result();
		if ($cek !=NULL) {
			foreach ($cek as $a)
			{
				if ($a->user_status==1) {

					$user_id = $a->user_id;
					$token = $this->generateRandomString();
					$tanggal = date('Y-m-d H:i:s');
					$data_token  = array(
						'token_isi' => $token, 
						'token_expired_date' => date('Y-m-d H:i:s', strtotime($tanggal .' +1 day')),
						'token_keterangan' => 'Reset Password Akun',
						'user_id' => $user_id,
					);
					$this->db->insert('tbl_token',$data_token);

					$this->load->library('Mailer');

					$email_penerima = $this->input->post('seeker_email');
					if ($email_penerima !='') {

						$subjek = "Reset Password Akun Talent Hub - ".$a->user_nama;
						$pesan = $this->kirim_email($token,$email_penerima); 
						$content = $this->load->view('content', array('pesan'=>$pesan), true);
						$sendmail = array(
							'email_penerima'=>$email_penerima,
							'subjek'=>$subjek,
							'content'=>$content,
						);
						$send = $this->mailer->send($sendmail);
					}

					$data['title'] = 'Berhasil';
					$data['text'] = 'Silahkan Klik Tautan Reset Password Diemail!';
					$data['icon'] = 'success';
					$this->session->set_flashdata($data); 
					redirect('landing/forgot','refresh');

				}else{

					$data['title'] = 'Error';
					$data['text'] = 'User Dinonaktifkan!';
					$data['icon'] = 'error';
					$this->session->set_flashdata($data); 
					redirect('landing/forgot','refresh');
				}
			}
		}
		else{
			$data['title'] = 'Error';
			$data['text'] = 'Akun Tidak Ditemukan!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data); 
			redirect('landing/forgot','refresh');
		}
	}


	public function ubah_password()
	{
		$this->db->where('user_id',$this->input->post('user_id'));
		$result = $this->db->update('tbl_master_user',array('user_password' => md5($this->input->post('seeker_password'))));

		if ($result) {
			$this->db->where('token_isi',$this->input->post('token'));
			$this->db->delete('tbl_token');
			$data['title'] = 'Berhasil';
			$data['text'] = 'Reset Password Berhasil!';
			$data['icon'] = 'success';
			$this->session->set_flashdata($data); 
			redirect('landing/login','refresh');
		}
		else{
			$data['title'] = 'Error';
			$data['text'] = 'Reset Password Gagal!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data); 
			redirect('landing/reset_password/'.$this->input->post('token'),'refresh');
		}
	}


	public function forgot()
	{
		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		if ($this->session->login==FALSE) {
			$this->load->view('web/header',$data);
			$this->load->view('web/tampilan_forgot',$data);
			$this->load->view('web/script_include',$data);
		}else{
			redirect('seeker/dashboard','refresh');
		}
	}



	public function reset_password($token)
	{

		$this->db->where('token_isi',$token);
		$data_token = $this->db->get('tbl_token');
		if ($data_token->num_rows() > 0 ) {
			foreach ($data_token->result() as $key) {
				$tanggal = date('Y-m-d H:i:s');
				if ($key->token_expired_date < $tanggal) {
					$data['title'] = 'Error';
					$data['text'] = 'Link Expired!';
					$data['icon'] = 'error';
					$this->session->set_flashdata($data);
					redirect('landing/login','refresh');
				}else{
					$data['token'] = $token;
					$data['user_id']= $key->user_id;
					$data['stp'] = $this->db->get('tbl_master_stp')->result();
					if ($this->session->login==FALSE) {
						$this->load->view('web/header',$data);
						$this->load->view('web/tampilan_reset_password',$data);
						$this->load->view('web/script_include',$data);
					}else{
						redirect('seeker/dashboard','refresh');
					}

				}
			}
		}

		else{
			$data['title'] = 'Error';
			$data['text'] = 'Link Tidak Valid!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
			redirect('landing/login','refresh');
		}



	}

}
