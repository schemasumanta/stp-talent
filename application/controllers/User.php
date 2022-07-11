<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor\autoload.php';
use Google\Cloud\Storage\StorageClient;

class User extends CI_Controller {
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

	public function detail_user()
	{
		$this->db->where('user_id',$this->input->get('user_id'));
		$data = $this->db->get('tbl_master_user')->result();
		echo json_encode($data);
	}

	public function tabel_user(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'user_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('user',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_user" data="'.$l->user_id.'"><i class="fa fa-edit"></i></a>
			<a href="javascript:;" class="btn btn-sm btn-circle btn-primary  item_edit_password" data="'.$l->user_id.'"><i class="fa fa-key"></i></a>';
			if ($l->user_level!='1') {
			if ($l->user_status == 1) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_user" data="'.$l->user_id.'"><i class="fa fa-times-circle"></i></a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_user" data="'.$l->user_id.'"><i class="fa fa-check-circle"></i></a>';
			}
			}
			$opsi .='</div>';
			$l->opsi = $opsi;
			if ($l->user_status > 0) {
				$l->user_status = '<button type="button" class="btn btn-success btn-sm btn-round  item_aktivasi_agama">Aktif</button>';
			}else{
				$l->user_status = '<button type="button" class="btn btn-danger btn-sm btn-round  item_aktivasi_agama">Non Aktif</button>';
			}

			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('user',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('user',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}




	public function index()
	{
		$data['level'] = $this->db->get('tbl_master_level')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_user',$data);
		$this->load->view('admin/footer');
	}

	public function aktivasi_user()
	{

		$this->db->set('user_status',$this->input->post('isi'));
		$this->db->where('user_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_master_user');
		echo json_encode($data);

	}


	public function simpan()
	{

		try {
			$storage = new StorageClient([
				'projectId' => 'etraining-solo',
				'keyFilePath' => 'assets/json/solo-digital-tech-9a8c6ffab50b.json',
			]);
			$bucketName = 'artisansweb-bucket';
			$bucket = $storage->defaultBucket();
				echo "Your Bucket $bucket .";
		} catch(Exception $e) {
			echo $e->getMessage();
		}


		// if($_FILES['lampiran_user']['name'] != '')
		// {
		// 	$bucketName = "solo-digital-tech.appspot.com";
		// 	$objectName = $_FILES['lampiran_user']['name'];
		// 	$storage = new StorageClient();
		// 	$bucket = $storage->bucket($bucketName);
		// 	$object = $bucket->upload(
		// 		file_get_contents($_FILES['lampiran_user']['tmp_name']),
		// 		[
		// 			'name' => $_FILES['lampiran_user']['name']
		// 		]
		// 	);

		// 	$publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";
		// }

		// var_dump($publicUrl);
		// exit();

		// $data_user = array(
		// 	'nama' => $this->input->post('nama_lengkap'),
		// 	'level' => $this->input->post('level'),
		// 	'email' => $this->input->post('email'),
		// 	'id_cabang' => $this->input->post('cabang'),
		// 	'id_jabatan' => $this->input->post('jabatan'),
		// 	'username' => $this->input->post('username'),
		// 	'password' => md5($this->input->post('password')),
		// 	'foto' => $foto,
		// 	'status_user' =>1,
		// 	'date_created'=> date('Y-m-d H:i:s'),
		// );
		// $result= $this->db->insert('tbl_master_user', $data_user);
		// if ($result) {
		// 	$data_history = array(
		// 		'id_user' => $this->session->id_user, 
		// 		'ip_address'=>get_ip(),
		// 		'aktivitas' => "Menambah Data user Baru atas nama ".$this->input->post('nama_lengkap'),
		// 	);

		// 	$this->db->insert('tbl_history', $data_history);

		// 	$data['title'] = 'Berhasil';
		// 	$data['text'] = 'User Berhasil Ditambahkan!';
		// 	$data['icon'] = 'success';


		// }else{

		// 	$data['title'] = 'Gagal';
		// 	$data['text'] = 'User Gagal Ditambahkan!';
		// 	$data['icon'] = 'error';

		// }	

		// $this->session->set_flashdata($data);
		// redirect('user','refresh');

	}


	public function cek_username()
	{
		$this->db->where('username',$this->input->get('username'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);
	}

	
	public function ubah()
	{


		if (!is_dir('assets/img/foto_user/')) {
			mkdir('assets/img/foto_user/');
		}


		$foto = $this->input->post('lampiran_user_lama');

		if($_FILES['lampiran_user']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_user']['name']);
			$location ='assets/img/foto_user/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_user']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}

		$data_user = array(
			'nama' => $this->input->post('nama_lengkap'),
			'level' => $this->input->post('level'),
			'email' => $this->input->post('email'),
			'id_cabang' => $this->input->post('cabang'),
			'id_jabatan' => $this->input->post('jabatan'),
			'username' => $this->input->post('username'),
			'foto' => $foto,
			'status_user' =>1,
		);
		$this->db->where('id_user',$this->input->post('id_user'));
		$result= $this->db->update('tbl_master_user', $data_user);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Data user dengan id_user".$this->input->post('id_user'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'User Berhasil Diubah!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'User Gagal Diubah!';
			$data['icon'] = 'error';

		}	

		$this->session->set_flashdata($data);
		redirect('user','refresh');

	}


	public function cek_email()
	{
		$this->db->where('user_email',$this->input->get('email'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);
	}



	public function reset_password()
	{
		$data_user = array(
			'password' 			=> md5('12345678'),

		);

		$this->db->where('id_user',$this->input->post('id_user_password'));
		$result= $this->db->update('tbl_master_user', $data_user);
		if ($result) {

			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mereset Password user dengan id_user".$this->input->post('id_user_password'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah';
			$data['icon'] = 'success';
			
		}	else{
			$data['title'] = 'Error';
			$data['text'] = 'Password Gagal Diubah';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data); 
		redirect('user','refresh');
	}

	
}