<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_notifikasi'); 
		$this->load->view('admin/footer');
	}

	public function get_notifikasi()
	{
		$this->db->where('a.user_id',$this->session->user_id);
		$this->db->join('tbl_notifikasi b','b.notifikasi_key=a.notifikasi_key');
		$data = $this->db->get('tbl_penerima_notifikasi a')->result();
		echo json_encode($data);
	}


	public function tabel_notifikasi(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'notifikasi_tanggal';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('notifikasi',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success  item_edit_notifikasi" data="'.$l->notifikasi_key.'"><i class="fa fa-edit"></i></a>';
			$opsi .='</div>';
			$l->opsi = $opsi;
			if ($l->notifikasi_lampiran !='') {
				$l->notifikasi_lampiran = '<a href="'.$l->notifikasi_lampiran.'" target="_blank" class="btn btn-sm btn-circle  btn-success " ><i class="fa fa-download"></i></a>';
			}
			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('notifikasi',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('notifikasi',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}



	public function simpan()
	{


		

		$data_notifikasi = array(
			'notifikasi_pengirim' 	=> $this->session->user_id,
			'notifikasi_key' 		=> $this->input->post('notifikasi_key'),
			'notifikasi_isi' 		=> $this->input->post('notifikasi_isi'),
			'notifikasi_judul' 		=> $this->input->post('notifikasi_judul'),
			'notifikasi_tanggal' 	=> date('Y-m-d H:i:s'),
			'notifikasi_lampiran' 	=> $this->input->post('lampiran_notifikasi_lama'),
			'notifikasi_link' 		=> $this->input->post('notifikasi_link'),
		);
		$result= $this->db->insert('tbl_notifikasi', $data_notifikasi);
		if ($result) {
			$this->db->select('user_id');
			$this->db->where('user_status',1);
			if ($this->input->post('notifikasi_penerima')=="Job Provider") {
				$this->db->where('user_level',3);
			}

			if ($this->input->post('notifikasi_penerima')=="Job Seeker") {
				$this->db->where('user_level',1);
			}

			$data_user = $this->db->get('tbl_master_user')->result();
			foreach ($data_user as $key) {
				$data_penerima = array(
					'user_id' 			=> $key->user_id, 
					'notifikasi_key' 	=> $this->input->post('notifikasi_key'),
					'read_status' 		=>0, 
				);
				$this->db->insert('tbl_penerima_notifikasi', $data_penerima);
			}

			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Blast Notifikasi Baru",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Notifikasi Berhasil Dikirim!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Notifikasi Gagal Dikirim!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('notifikasi','refresh');
	}
}