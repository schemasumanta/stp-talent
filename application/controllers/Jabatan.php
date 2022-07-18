<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('admin','refresh');
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
		$this->load->view('admin/tampilan_jabatan'); 
		$this->load->view('admin/footer');


	}

	public function simpan()
	{
		$data_jabatan = array(
			'jabatan_nama' => $this->input->post('jabatan_nama'), 
			'jabatan_status' => 1, 
		);

		$result= $this->db->insert('tbl_master_jabatan', $data_jabatan);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Jabatan Baru ".$this->input->post('jabatan_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Jabatan Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Jabatan Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('jabatan','refresh');
	}

	public function ubah()
	{
		$data_jabatan = array(
			'jabatan_nama' => $this->input->post('jabatan_nama'), 
		);
		$this->db->where('jabatan_id',$this->input->post('jabatan_id'));
		$result= $this->db->update('tbl_master_jabatan', $data_jabatan);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Jabatan ".$this->input->post('jabatan_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Jabatan Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Data Jabatan Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('jabatan','refresh');
	}




	public function tabel_jabatan(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'jabatan_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('jabatan',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_jabatan" data="'.$l->jabatan_id.'"><i class="fa fa-edit"></i></a>';


			if ($l->jabatan_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_jabatan" data="'.$l->jabatan_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_jabatan" data="'.$l->jabatan_id.'"><i class="fa fa-check-circle"></i></a>';
			}
			if ($l->jabatan_status > 0) {
				$l->jabatan_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			}else{
				$l->jabatan_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('jabatan',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('jabatan',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	public function detail_jabatan()
	{
		$this->db->where('jabatan_id',$this->input->get('jabatan_id'));
		$data = $this->db->get('tbl_master_jabatan')->result();
		echo json_encode($data);
	}

	public function aktivasi()
	{

		$this->db->set('jabatan_status',$this->input->post('isi'));
		$this->db->where('jabatan_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_jabatan');
		echo json_encode($data);

	}

}
