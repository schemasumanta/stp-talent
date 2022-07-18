<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cv extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('seeker','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}


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

		$this->db->where('a.user_id',$this->session->user_id);
		$data['resume'] = $this->db->get('tbl_resume a')->result();

			$this->db->where('a.user_id',$this->session->user_id);
		$data['upload_resume'] = $this->db->get('tbl_resume_lampiran a')->result();

		$this->db->where('pendidikan_status',1);
		$data['pendidikan'] = $this->db->get('tbl_master_pendidikan')->result();


		$data['provinsi'] = $this->db->get('tbl_master_provinsi')->result();
		$this->load->view('web/header',$data);
		$this->load->view('seeker/sidebar',$data); 
		$this->load->view('seeker/tampilan_cv',$data);
		$this->load->view('web/script_include',$data);

	}
	public function simpan_resume()
	{
		$data_resume = array(
			'resume_nama_lengkap' => $this->input->post('resume_nama_lengkap'),
				'user_id' => $this->session->user_id,
				'resume_created_date' =>date('Y-m-d H:i:s')

		);

		$result= $this->db->insert('tbl_resume', $data_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Profil ".$this->input->post('resume_nama_lengkap'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Profil Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Profil Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('cv','refresh');
	}

}
