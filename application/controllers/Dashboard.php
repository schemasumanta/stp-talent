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
			$this->load->view('web/header',$data);
			$this->load->view('seeker/sidebar',$data); 
			$this->load->view('seeker/tampilan_dashboard',$data);
			$this->load->view('web/script_include',$data);
		}
		if ($this->session->user_level==3) {
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
			$this->load->view('web/header',$data);
			$this->load->view('provider/sidebar',$data); 
			$this->load->view('provider/tampilan_dashboard',$data);
			$this->load->view('web/script_include',$data);
			
		}

	}

}
