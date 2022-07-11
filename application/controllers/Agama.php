<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agama extends CI_Controller {
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
		$this->load->view('admin/tampilan_agama'); 
		$this->load->view('admin/footer');


	}

	public function simpan()
	{
		$data_agama = array(
			'agama_nama' => $this->input->post('agama_nama'), 
			'agama_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_agama', $data_agama);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Agama Baru ".$this->input->post('agama_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Agama Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Agama Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('agama','refresh');
	}

	public function ubah()
	{
		$data_agama = array(
			'agama_nama' => $this->input->post('agama_nama'), 
		);
		$this->db->where('agama_id',$this->input->post('agama_id'));
		$result= $this->db->update('tbl_master_agama', $data_agama);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Agama ".$this->input->post('agama_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Agama Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Agama Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('agama','refresh');
	}




	public function tabel_agama(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'agama_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('agama',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_agama" data="'.$l->agama_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->agama_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_agama" data="'.$l->agama_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_agama" data="'.$l->agama_id.'"><i class="fa fa-check-circle"></i></a>';
			}
			if ($l->agama_status > 0) {
				$l->agama_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->agama_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('agama',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('agama',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_agama()
	{
		$this->db->where('agama_id',$this->input->get('agama_id'));
		$data = $this->db->get('tbl_master_agama')->result();
		echo json_encode($data);
	}

	public function aktivasi()
	{

		$this->db->set('agama_status',$this->input->post('isi'));
		$this->db->where('agama_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_agama');
		echo json_encode($data);

	}

}
