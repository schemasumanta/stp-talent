<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahasa extends CI_Controller {
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
		$this->load->view('admin/tampilan_bahasa'); 
		$this->load->view('admin/footer');


	}

	public function simpan()
	{
		$data_bahasa = array(
			'bahasa_nama' => $this->input->post('bahasa_nama'), 
			'bahasa_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_bahasa', $data_bahasa);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Bahasa Baru ".$this->input->post('bahasa_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Bahasa Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Bahasa Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('bahasa','refresh');
	}

	public function ubah()
	{
		$data_bahasa = array(
			'bahasa_nama' => $this->input->post('bahasa_nama'), 
		);
		$this->db->where('bahasa_id',$this->input->post('bahasa_id'));
		$result= $this->db->update('tbl_master_bahasa', $data_bahasa);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Bahasa ".$this->input->post('bahasa_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Bahasa Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Bahasa Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('bahasa','refresh');
	}




	public function tabel_bahasa(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'bahasa_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('bahasa',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_bahasa" data="'.$l->bahasa_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->bahasa_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_bahasa" data="'.$l->bahasa_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_bahasa" data="'.$l->bahasa_id.'"><i class="fa fa-check-circle"></i></a>';
			}
			if ($l->bahasa_status > 0) {
				$l->bahasa_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->bahasa_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('bahasa',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('bahasa',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_bahasa()
	{
		$this->db->where('bahasa_id',$this->input->get('bahasa_id'));
		$data = $this->db->get('tbl_master_bahasa')->result();
		echo json_encode($data);
	}

	public function aktivasi()
	{

		$this->db->set('bahasa_status',$this->input->post('isi'));
		$this->db->where('bahasa_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_bahasa');
		echo json_encode($data);

	}

}
