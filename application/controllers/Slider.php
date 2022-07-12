<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('admin','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_slider'); 
		$this->load->view('admin/footer');


	}

	public function simpan()
	{

		if (!is_dir('assets/img/slider/')) {
			mkdir('assets/img/slider/');
		}




		$slider = '';

		if($_FILES['lampiran_slider']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_slider']['name']);
			$location ='assets/img/slider/slider'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_slider']['tmp_name'], $location)) {
					$slider = $location;
					$this->db->where('slider_tipe',$this->input->post('slider_tipe'));
					$this->db->update('tbl_master_slider', array('slider_status' =>0));
				}
			}
		}
		$data_slider = array(
			'slider_gambar' => $slider, 
			'slider_tipe' => $this->input->post('slider_tipe'), 
			'slider_status' => 1, 
		);
		$result= $this->db->insert('tbl_master_slider', $data_slider);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Slider Baru ",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Slider Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Slider Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('slider','refresh');
	}


	public function ubah()
	{

		if (!is_dir('assets/img/slider/')) {
			mkdir('assets/img/slider/');
		}




		$slider = $this->input->post('slider_lama');

		if($_FILES['lampiran_slider']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_slider']['name']);
			$location ='assets/img/slider/slider'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_slider']['tmp_name'], $location)) {
					$slider = $location;
					$this->db->where('slider_tipe',$this->input->post('slider_tipe'));
					$this->db->update('tbl_master_slider', array('slider_status' =>0));
				}
			}
		}
		$data_slider = array(
			'slider_gambar' => $slider, 
			'slider_tipe' => $this->input->post('slider_tipe'), 
			'slider_status' => 1, 
		);
		$this->db->where('slider_id',$this->input->post('slider_id'));
		$result= $this->db->update('tbl_master_slider', $data_slider);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Slider",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Slider Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Slider Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('slider','refresh');
	}





	public function tabel_slider(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'slider_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('slider',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_slider" data="'.$l->slider_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->slider_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_slider" data="'.$l->slider_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_slider" data="'.$l->slider_id.'"><i class="fa fa-check-circle"></i></a>';
			}

			if ($l->slider_status > 0) {
				$l->slider_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->slider_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			if ($l->slider_tipe=="main") {
				$l->slider_tipe = '<button type="button" class="btn btn-info btn-sm btn-round ">Main Slider</button>';
			}elseif($l->slider_tipe=="cv") {

				$l->slider_tipe = '<button type="button" class="btn btn-info btn-sm btn-round ">CV Panel</button>';
			}else{
				$l->slider_tipe = '<button type="button" class="btn btn-info btn-sm btn-round ">How Its Works</button>';
			}

			$opsi .='</div>';


			$l->opsi = $opsi;

			if ($l->slider_gambar !='') {
				$l->slider_gambar = '<img src="'.base_url().$l->slider_gambar.'" width="100px">';
			}

			$data[] = $l;

		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('slider',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('slider',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_slider()
	{
		$this->db->where('slider_id',$this->input->get('slider_id'));
		$data = $this->db->get('tbl_master_slider')->result();
		echo json_encode($data);
	}

	public function aktivasi()
	{

		$this->db->set('slider_status',$this->input->post('isi'));
		$this->db->where('slider_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_slider');
		echo json_encode($data);

	}

}
