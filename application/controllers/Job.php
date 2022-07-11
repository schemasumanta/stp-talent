<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('login','refresh');
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
		$data_job = array(
			'job_kategori_nama' => $this->input->post('job_kategori_nama'), 
			'job_kategori_status' => 1, 
		);

		$result= $this->db->insert('tbl_job_kategori', $data_job);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Level job Baru ".$this->input->post('job_kategori_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level job Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Level job Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('job/job_kategori','refresh');
	}

	public function ubah_kategori()
	{
		$data_job = array(
			'job_kategori_nama' => $this->input->post('job_kategori_nama'), 
		);
		$this->db->where('job_kategori_id',$this->input->post('job_kategori_id'));
		$result= $this->db->update('tbl_job_kategori', $data_job);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Level job ".$this->input->post('job_kategori_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Level job Berhasil Diubah!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Level job Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('job/job_kategori','refresh');
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
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'job_kategori_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job_kategori',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job_kategori" data="'.$l->job_kategori_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->job_kategori_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job_kategori" data="'.$l->job_kategori_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job_kategori" data="'.$l->job_kategori_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->job_kategori_status > 0) {
				$l->job_kategori_status = '<button type="button" class="btn btn-success btn-sm btn-round  item_aktivasi_agama">Aktif</button>';
			}else{
				$l->job_kategori_status = '<button type="button" class="btn btn-danger btn-sm btn-round  item_aktivasi_agama">Non Aktif</button>';
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
 
	public function detail_job()
	{
		$this->db->where('job_id',$this->input->get('job_id'));
		$data = $this->db->get('tbl_master_job')->result();
		echo json_encode($data);
	}
	public function detail_job_kategori()
	{
		$this->db->where('job_kategori_id',$this->input->get('job_kategori_id'));
		$data = $this->db->get('tbl_job_kategori')->result();
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
		$this->db->set('job_kategori_status',$this->input->post('isi'));
		$this->db->where('job_kategori_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_job_kategori');
		echo json_encode($data);

	}


}
