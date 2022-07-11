<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {
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
		$this->load->view('admin/tampilan_pendidikan'); 
		$this->load->view('admin/footer');

	}

	public function simpan()
	{
		$data_pendidikan = array(
			'pendidikan_nama' => $this->input->post('pendidikan_nama'), 
			'pendidikan_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_pendidikan', $data_pendidikan);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Pendidikan Baru ".$this->input->post('pendidikan_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pendidikan Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pendidikan Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('pendidikan','refresh');
	}

	public function ubah()
	{
		$data_pendidikan = array(
			'pendidikan_nama' => $this->input->post('pendidikan_nama'), 
		);
		$this->db->where('pendidikan_id',$this->input->post('pendidikan_id'));
		$result= $this->db->update('tbl_master_pendidikan', $data_pendidikan);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Pendidikan ".$this->input->post('pendidikan_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pendidikan Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pendidikan Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('pendidikan','refresh');
	}




	public function tabel_pendidikan(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'pendidikan_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('pendidikan',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_pendidikan" data="'.$l->pendidikan_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->pendidikan_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_pendidikan" data="'.$l->pendidikan_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_pendidikan" data="'.$l->pendidikan_id.'"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .='</div>';

			$l->opsi = $opsi;

			if ($l->pendidikan_status > 0) {
				$l->pendidikan_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->pendidikan_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$data[] = $l;

		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('pendidikan',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('pendidikan',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_pendidikan()
	{
		$this->db->where('pendidikan_id',$this->input->get('pendidikan_id'));
		$data = $this->db->get('tbl_master_pendidikan')->result();
		echo json_encode($data);
	}

	public function aktivasi()
	{

		$this->db->set('pendidikan_status',$this->input->post('isi'));
		$this->db->where('pendidikan_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_pendidikan');
		echo json_encode($data);

	}

}
