<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
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
		$this->load->view('admin/tampilan_job'); 
		$this->load->view('admin/footer');


	}

	public function kategori()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_job_kategori'); 
		$this->load->view('admin/footer');
	}

	public function level()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_job_level'); 
		$this->load->view('admin/footer');
	}


	public function simpan()
	{
		$data_job = array(
			'job_nama' => $this->input->post('job_nama'), 
			'job_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_job', $data_job);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data job Baru ".$this->input->post('job_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'job Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'job Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('job','refresh');
	}

	public function ubah()
	{
		$data_job = array(
			'job_nama' => $this->input->post('job_nama'), 
		);
		$this->db->where('job_id',$this->input->post('job_id'));
		$result= $this->db->update('tbl_master_job', $data_job);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data job ".$this->input->post('job_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data job Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data job Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('job','refresh');
	}


	public function simpan_kategori()
	{
		if (!is_dir('assets/img/icon_kategori/')) {
			mkdir('assets/img/icon_kategori/');
		}


		$icon = '';

		if($_FILES['lampiran_kategori']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_kategori']['name']);
			$location ='assets/img/icon_kategori/icon'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_kategori']['tmp_name'], $location)) {
					$icon = $location;
				}
			}
		}

		$data_kategori = array(
			'kategori_nama' => $this->input->post('kategori_nama'),
			'kategori_status' => 1,
			'kategori_icon' => $icon,
		);
		$result= $this->db->insert('tbl_master_kategori_job', $data_kategori);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Kategori Pekerjaan Baru dengan nama ".$this->input->post('kategori_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Kategori Pekerjaan Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Kategori Pekerjaan Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('job/kategori','refresh');
	}




	public function ubah_kategori()
	{
		if (!is_dir('assets/img/icon_kategori/')) {
			mkdir('assets/img/icon_kategori/');
		}


		$icon = $this->input->post('lampiran_kategori_lama');

		if($_FILES['lampiran_kategori']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_kategori']['name']);
			$location ='assets/img/icon_kategori/icon'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_kategori']['tmp_name'], $location)) {
					$icon = $location;
				}
			}
		}

		$data_kategori = array(
			'kategori_nama' => $this->input->post('kategori_nama'),
			'kategori_icon' => $icon,
		);
		$this->db->where('kategori_id',$this->input->post('kategori_id'));
		$result= $this->db->update('tbl_master_kategori_job', $data_kategori);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Kategori Pekerjaan dengan nama ".$this->input->post('kategori_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Kategori Pekerjaan Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Kategori Pekerjaan Gagal Diubah!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('job/kategori','refresh');
	}


	public function simpan_level()
	{
		$data_level = array(
			'joblevel_nama' => $this->input->post('joblevel_nama'),
			'joblevel_status' => 1,
		);
		$result= $this->db->insert('tbl_master_level_job', $data_level);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Level Pekerjaan Baru dengan nama ".$this->input->post('joblevel_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level Pekerjaan Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Level Pekerjaan Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('job/level','refresh');
	}
	
	public function ubah_level()
	{
		$data_level = array(
			'joblevel_nama' => $this->input->post('joblevel_nama'),
		);
		$this->db->where('joblevel_id',$this->input->post('joblevel_id'));
		$result= $this->db->update('tbl_master_level_job', $data_level);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Level Pekerjaan dengan nama ".$this->input->post('joblevel_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level Pekerjaan Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Level Pekerjaan Gagal Diubah!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('job/level','refresh');
	}


	

	public function tabel_job(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'job_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job" data="'.$l->job_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->job_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job" data="'.$l->job_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job" data="'.$l->job_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->job_status > 0) {
				$l->job_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->job_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}



	public function tabel_job_kategori(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'kategori_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job_kategori',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job_kategori" data="'.$l->kategori_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->kategori_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job_kategori" data="'.$l->kategori_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job_kategori" data="'.$l->kategori_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->kategori_status > 0) {
				$l->kategori_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->kategori_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			if ($l->kategori_icon != '') {
				$l->kategori_icon = '<img src="'.base_url().$l->kategori_icon.'" width="50px">';
			}

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job_kategori',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job_kategori',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}




	public function tabel_job_level(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'joblevel_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job_level',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job_level" data="'.$l->joblevel_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->joblevel_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job_level" data="'.$l->joblevel_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job_level" data="'.$l->joblevel_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->joblevel_status > 0) {
				$l->joblevel_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->joblevel_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job_level',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job_level',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}


	public function detail_job()
	{
		$this->db->where('job_id',$this->input->get('job_id'));
		$data = $this->db->get('tbl_master_job')->result();
		echo json_encode($data);
	}
	public function detail_kategori()
	{
		$this->db->where('kategori_id',$this->input->get('kategori_id'));
		$data = $this->db->get('tbl_master_kategori_job')->result();
		echo json_encode($data);
	}

	public function detail_level()
	{
		$this->db->where('joblevel_id',$this->input->get('joblevel_id'));
		$data = $this->db->get('tbl_master_level_job')->result();
		echo json_encode($data);
	}
	public function aktivasi()
	{
		$this->db->set('job_status',$this->input->post('isi'));
		$this->db->where('job_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_job');
		echo json_encode($data);
	}
	public function aktivasi_kategori()
	{
		$this->db->set('kategori_status',$this->input->post('isi'));
		$this->db->where('kategori_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_kategori_job');
		echo json_encode($data);

	}


}
