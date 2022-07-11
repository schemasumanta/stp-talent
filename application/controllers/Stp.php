<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stp extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->login==FALSE) {

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!!! <button type="button" class="close" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</span></button></div>');

			redirect('dashboard','refresh');
		}

		// elseif($this->session->level!='1')  {
		// 	echo "<script> alert('Tidak Ada Akses Untuk Menu ini');
		// 	history.back();
		// 	</script>";

		// } 
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function detail_stp()
	{
		$this->db->where('stp_id',$this->input->get('stp_id'));
		$data = $this->db->get('tbl_master_stp')->result();
		echo json_encode($data);
	}

	public function tabel_stp(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'stp_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('stp',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success  item_edit_stp" data="'.$l->stp_id.'"><i class="fa fa-edit"></i></a>';
			$opsi .='</div>';
			$l->opsi = $opsi;
			if ($l->stp_logo !='') {
				$l->stp_logo = '<img src="'.base_url().$l->stp_logo.'" width="100px">';
			}
			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('stp',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('stp',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}




	public function index()
	{
		$data['profil'] = $this->db->get('tbl_master_stp')->num_rows();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_stp',$data);
		$this->load->view('admin/footer');
	}


	public function simpan()
	{


		if (!is_dir('assets/img/foto_stp/')) {
			mkdir('assets/img/foto_stp/');
		}


		$logo = '';

		if($_FILES['lampiran_stp']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_stp']['name']);
			$location ='assets/img/foto_stp/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_stp']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}

		$data_stp = array(
			'stp_nama' => $this->input->post('stp_nama'),
			'stp_tagline' => $this->input->post('stp_tagline'),
			'stp_telepon' => $this->input->post('stp_telepon'),
			'stp_email' => $this->input->post('stp_email'),
			'stp_pemilik' => $this->input->post('stp_pemilik'),
			'stp_facebook' => $this->input->post('stp_facebook'),
			'stp_instagram' => $this->input->post('stp_instagram'),
			'stp_website' => $this->input->post('stp_website'),
			'stp_alamat' => $this->input->post('stp_alamat'),
			'stp_logo' => $logo,
		);
		$result= $this->db->insert('tbl_master_stp', $data_stp);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Profil Aplikasi Baru atas nama ".$this->input->post('stp_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Profil STP Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Profil STP Gagal Ditambahkan!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('stp','refresh');
	}



	public function ubah()
	{


		if (!is_dir('assets/img/foto_stp/')) {
			mkdir('assets/img/foto_stp/');
		}


		$logo = $this->input->post('lampiran_stp_lama');

		if($_FILES['lampiran_stp']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_stp']['name']);
			$location ='assets/img/foto_stp/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_stp']['tmp_name'], $location)) {
					$logo = $location;
				}
			}
		}

		$data_stp = array(
			'stp_nama' => $this->input->post('stp_nama'),
			'stp_tagline' => $this->input->post('stp_tagline'),
			'stp_telepon' => $this->input->post('stp_telepon'),
			'stp_email' => $this->input->post('stp_email'),
			'stp_pemilik' => $this->input->post('stp_pemilik'),
			'stp_facebook' => $this->input->post('stp_facebook'),
			'stp_instagram' => $this->input->post('stp_instagram'),
			'stp_website' => $this->input->post('stp_website'),
			'stp_alamat' => $this->input->post('stp_alamat'),
			'stp_logo' => $logo,
		);
		$this->db->where('stp_id',$this->input->post('stp_id'));
		$result= $this->db->update('tbl_master_stp', $data_stp);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data Profil Aplikasi Baru atas nama ".$this->input->post('stp_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Profil STP Berhasil Diubah!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Profil STP Gagal Diubah!';
			$data['icon'] = 'error';

		}	
		$this->session->set_flashdata($data);
		redirect('stp','refresh');
	}

	
}