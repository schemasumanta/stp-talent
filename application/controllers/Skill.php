<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends CI_Controller {
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
		$this->load->view('admin/tampilan_skill'); 
		$this->load->view('admin/footer');


	}

	public function skill_level()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_skill_level'); 
		$this->load->view('admin/footer');
	}

	public function simpan()
	{
		$data_skill = array(
			'skill_nama' => $this->input->post('skill_nama'), 
			'skill_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_skill', $data_skill);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Skill Baru ".$this->input->post('skill_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Skill Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Skill Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('skill','refresh');
	}

	public function ubah()
	{
		$data_skill = array(
			'skill_nama' => $this->input->post('skill_nama'), 
		);
		$this->db->where('skill_id',$this->input->post('skill_id'));
		$result= $this->db->update('tbl_master_skill', $data_skill);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Skill ".$this->input->post('skill_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Skill Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Skill Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('skill','refresh');
	}


	public function simpan_level()
	{
		$data_skill = array(
			'skill_level_nama' => $this->input->post('skill_level_nama'), 
			'skill_level_status' => 1, 
		);

		$result= $this->db->insert('tbl_skill_level', $data_skill);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Level Skill Baru ".$this->input->post('skill_level_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level Skill Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Level Skill Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('skill/skill_level','refresh');
	}

	public function ubah_level()
	{
		$data_skill = array(
			'skill_level_nama' => $this->input->post('skill_level_nama'), 
		);
		$this->db->where('skill_level_id',$this->input->post('skill_level_id'));
		$result= $this->db->update('tbl_skill_level', $data_skill);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Level Skill ".$this->input->post('skill_level_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Level Skill Berhasil Diubah!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Level Skill Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('skill/skill_level','refresh');
	}

	public function tabel_skill(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'skill_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('skill',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_skill" data="'.$l->skill_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->skill_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_skill" data="'.$l->skill_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_skill" data="'.$l->skill_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->skill_status > 0) {
				$l->skill_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->skill_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('skill',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('skill',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}



	public function tabel_skill_level(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'skill_level_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('skill_level',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_skill_level" data="'.$l->skill_level_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->skill_level_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_skill_level" data="'.$l->skill_level_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_skill_level" data="'.$l->skill_level_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->skill_level_status > 0) {
				$l->skill_level_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->skill_level_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('skill_level',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('skill_level',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_skill()
	{
		$this->db->where('skill_id',$this->input->get('skill_id'));
		$data = $this->db->get('tbl_master_skill')->result();
		echo json_encode($data);
	}
	public function detail_skill_level()
	{
		$this->db->where('skill_level_id',$this->input->get('skill_level_id'));
		$data = $this->db->get('tbl_skill_level')->result();
		echo json_encode($data);
	}
	public function aktivasi()
	{
		$this->db->set('skill_status',$this->input->post('isi'));
		$this->db->where('skill_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_skill');
		echo json_encode($data);
	}
		public function aktivasi_level()
	{
		$this->db->set('skill_level_status',$this->input->post('isi'));
		$this->db->where('skill_level_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_skill_level');
		echo json_encode($data);

	}


}
