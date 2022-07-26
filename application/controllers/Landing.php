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


	
}
