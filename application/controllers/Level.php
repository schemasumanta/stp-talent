<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('landing','refresh');
		}
		if ($this->session->user_level!=1) {
			redirect('landing','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_level'); 
		$this->load->view('admin/footer');


	}

	public function simpan()
	{
		$data_level = array(
			'level_nama' => $this->input->post('level_nama'), 
			'level_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_level', $data_level);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Level Baru ".$this->input->post('level_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Level Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('level','refresh');
	}

	public function ubah()
	{
		$data_level = array(
			'level_nama' => $this->input->post('level_nama'), 
		);
		$this->db->where('level_id',$this->input->post('level_id'));
		$result= $this->db->update('tbl_master_level', $data_level);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Level ".$this->input->post('level_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Level Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Level Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('level','refresh');
	}




	public function tabel_level(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'level_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('level',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_level" data="'.$l->level_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->level_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_level" data="'.$l->level_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_level" data="'.$l->level_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			if ($l->level_status > 0) {
				$l->level_status = '<button type="button" class="btn btn-success btn-sm btn-round  ">Aktif</button>';
			}else{
				$l->level_status = '<button type="button" class="btn btn-danger btn-sm btn-round  ">Non Aktif</button>';
			}

			$l->opsi = $opsi;

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('level',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('level',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_level()
	{
		$this->db->where('level_id',$this->input->get('level_id'));
		$data = $this->db->get('tbl_master_level')->result();
		echo json_encode($data);
	}

	public function aktivasi()
	{

		$this->db->set('level_status',$this->input->post('isi'));
		$this->db->where('level_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_level');
		echo json_encode($data);

	}

}
