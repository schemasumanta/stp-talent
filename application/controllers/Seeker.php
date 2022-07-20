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

	public function cek_email()
	{
		$this->db->where('user_email',$this->input->get('seeker_email'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);

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

	public function kirim_email($id_user,$email,$password)
	{
		$data['id_user'] = $id_user;
		$data['email'] = $email;
		$data['password'] = $password;
		$content = $this->load->view('seeker/body_email',$data,true);
		return $content;
	}

	public function aktivasi($token)
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
					redirect('seeker','refresh');
				}else{
					$this->db->where('user_id',$key->user_id);
					$result = $this->db->update('tbl_master_user', array('user_status' =>1));
					if ($result) {
						$this->db->where('token_isi',$key->token_isi);
						$result = $this->db->delete('tbl_token');
						$data['title'] = 'Aktivasi Berhasil';
						$data['text'] = 'Silahkan Login!';
						$data['icon'] = 'success';
						$this->session->set_flashdata($data);
						redirect('seeker','refresh');
					}
				}
			}
		}else{
			$data['title'] = 'Error';
			$data['text'] = 'Link Tidak Valid!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
			redirect('seeker','refresh');
		}

	}
	public function simpan_pendaftaran()
	{
		$foto = 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fphoto_user%2Fprofile.svg?alt=media&token=a595aaab-3258-4367-a935-e0e245b18588';
		$data_seeker = array(
			'user_level' 			=>2,
			'user_nama' 			=>$this->input->post('seeker_nama'),
			'user_telepon' 			=>$this->input->post('seeker_telepon'),
			'user_password' 		=>md5($this->input->post('seeker_password')),
			'user_email' 			=>$this->input->post('seeker_email'),
			'user_status'			=>0,
			'user_foto' 			=>$foto,
			'user_created_date' 	=>date('Y-m-d H:i:s'),
		);

		$result = $this->db->insert('tbl_master_user',$data_seeker);
		if ($result) {

			$this->db->where('user_nama',$this->input->post('seeker_nama'));
			$this->db->where('user_level',2);
			$this->db->order_by('user_id','desc');
			$this->db->limit(1);
			$user = $this->db->get('tbl_master_user')->result();
			foreach ($user as $key) {
				$user_id = $key->user_id;
				$token = $this->generateRandomString();
				$tanggal = date('Y-m-d H:i:s');
				$data_token  = array(
					'token_isi' => $token, 
					'token_expired_date' => date('Y-m-d H:i:s', strtotime($tanggal .' +1 day')),
					'token_keterangan' => 'Aktivasi Akun',
					'user_id' => $user_id,
				);
				$this->db->insert('tbl_token',$data_token);

				$this->load->library('Mailer');
				$email_penerima = $this->input->post('seeker_email');
				if ($email_penerima !='') {
					$subjek = "Aktivasi Akun Talent Hub - ".$this->input->post('seeker_nama');
					$password = $this->input->post('seeker_password');
					$pesan = $this->kirim_email($token,$email_penerima,$password); 
					$content = $this->load->view('content', array('pesan'=>$pesan), true);
					$sendmail = array(
						'email_penerima'=>$email_penerima,
						'subjek'=>$subjek,
						'content'=>$content,
					);
					$send = $this->mailer->send($sendmail);
				}
			}

			$data['title'] = 'Pendaftaran Berhasil';
			$data['text'] = 'Silahkan Cek Email Untuk Aktivasi Akun!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Pendaftaran Gagal!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('seeker/register','refresh');
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
					redirect('landing/login','refresh');
				}
			}
		}
		else{
			$data['title'] = 'Login Gagal';
			$data['text'] = 'Silahkan Periksa Email & Password!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data); 
			redirect('landing/login','refresh');
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
