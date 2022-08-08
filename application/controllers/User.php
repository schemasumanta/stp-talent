<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require 'vendor\autoload.php';
use Google\Cloud\Storage\StorageClient;

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') == FALSE) {
			redirect('landing', 'refresh');
		}

		if ($this->session->user_level != 1) {
			redirect('landing', 'refresh');
		}
		date_default_timezone_set('Asia/Jakarta');
	}

	public function detail_user()
	{
		$this->db->where('user_id', $this->input->get('user_id'));
		$data = $this->db->get('tbl_master_user')->result();
		echo json_encode($data);
	}

	public function tabel_user()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'user_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('user', $sort, $order, $search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi = '
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_user" onclick="edit_user(\'' . $l->user_id . '\')"><i class="fa fa-edit"></i></a>
			';
			if ($l->user_level != '1') {
				if ($l->user_status == 1) {
					$opsi .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-times-circle"></i></a>';
				} else {
					$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-check-circle"></i></a>';
				}
			}
			$opsi .= '</div>';
			$l->opsi = $opsi;
			$l->user_status = '<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" onclick="changeStatus(\'' . $l->user_id . '\')" id="set_active' . $l->user_id . '" ' . isChecked($l->user_status) . '>
			                	<label class="custom-control-label" for="set_active' . $l->user_id . '">' . isLabelChecked($l->user_status) . '</label>
							   </div>';

			if ($l->user_foto != '') {
				$l->user_foto = '<img src="'  . $l->user_foto . '" width="50px">';
			}

			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('user', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('user', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function tabel_job_provider()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'user_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('user_job_provider', $sort, $order, $search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;
			$opsi = '
			<div class="btn-group">';
			if ($l->user_level != '1') {
				if ($l->user_status == 1) {
					$opsi .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-times-circle"></i></a>';
				} else {
					$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-check-circle"></i></a>';
				}
			}
			$opsi .= '</div>';
			$l->opsi = $opsi;
			if ($l->user_status > 0) {
				$l->user_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			} else {
				$l->user_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}
			if ($l->user_foto != '') {
				$l->user_foto = '<img src="' . base_url() . $l->user_foto . '" width="50px">';
			}
			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('user_job_provider', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('user_job_provider', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}


	public function tabel_job_seeker()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'user_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('user_job_seeker', $sort, $order, $search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi = '
			<div class="btn-group">';
			if ($l->user_level != '1') {
				if ($l->user_status == 1) {
					$opsi .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-times-circle"></i></a>';
				} else {
					$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-check-circle"></i></a>';
				}
			}
			$opsi .= '</div>';
			$l->opsi = $opsi;
			if ($l->user_status > 0) {
				$l->user_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			} else {
				$l->user_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			if ($l->user_foto != '') {
				$l->user_foto = '<img src="' . base_url() . $l->user_foto . '" width="50px">';
			}

			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('user_job_seeker', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('user_job_seeker', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}



	public function index()
	{
		$data['level'] = $this->db->get('tbl_master_level')->result();
		$data['menu'] = $this->db->get('tbl_master_role')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_user', $data);
		$this->load->view('admin/footer');
	}

	public function job_provider()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_job_provider');
		$this->load->view('admin/footer');
	}

	public function job_posting()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_job_posting');
		$this->load->view('admin/footer');
	}


	public function job_seeker()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_job_seeker');
		$this->load->view('admin/footer');
	}


	public function tabel_job_posting()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'lowongan_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('job_posting_all', $sort, $order, $search);
		foreach ($list as $l) {

			$no++;
			$l->isi_lowongan = '<div class="card border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><img src="' . $l->perusahaan_logo . '" style="width:5%;margin-right:25px;">
			<div class="col mr-2"><div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
			' . $l->lowongan_judul . '</div>
			<div class="h6 mb-2 text-gray-800">' . $l->kategori_nama . '</div>
			<div class="h6 mb-0 font-weight-bold text-gray-800"><i class="fas fa-map-marker-alt mr-2"></i>' . $l->kabkota_nama . " - " . $l->prov_nama . '</li></div>
			</div><div class="col-auto"><a href="' . base_url() . 'job/detail/' . $l->lowongan_id . '" class="btn btn-sm rounded  mr-2 btn-success   item_detail_lowongan" data="' . $l->lowongan_id . '"><i class="fa fa-eye mr-2"></i>Detail</a></div>
			</div></div></div>';

			// <a href="javascript:;" class="btn btn-sm rounded btn-danger item_hapus_lowongan" data="'.$l->lowongan_id.'"><i class="fa fa-trash"></i></a>
			$l->no = $no;
			$data[] = $l;
		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job_posting_all', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job_posting_all', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}


	public function aktivasi_job_provider()
	{

		$this->db->set('user_status', $this->input->post('isi_aktivasi'));
		$this->db->where('user_id', $this->input->post('kode_user_aktivasi'));
		$delete = $this->db->update('tbl_master_user');

		if ($delete) {
			if ($this->input->post('isi_aktivasi') == 0) {
				$data['title'] = 'Berhasil';
				$data['text'] = 'Job Provider Berhasil Dinonaktifkan';
				$data['icon'] = 'success';
			} else {
				$data['title'] = 'Berhasil';
				$data['text'] = 'Job Provider Berhasil Diaktifkan';
				$data['icon'] = 'success';
			}
		} else {
			$data['title'] = 'Error';
			$data['text'] = 'Status Gagal Diubah';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('user/job_provider', 'refresh');
	}

	public function aktivasi_job_seeker()
	{

		$this->db->set('user_status', $this->input->post('isi_aktivasi'));
		$this->db->where('user_id', $this->input->post('kode_user_aktivasi'));
		$delete = $this->db->update('tbl_master_user');

		if ($delete) {
			if ($this->input->post('isi_aktivasi') == 0) {
				$data['title'] = 'Berhasil';
				$data['text'] = 'Job Seeker Berhasil Dinonaktifkan';
				$data['icon'] = 'success';
			} else {
				$data['title'] = 'Berhasil';
				$data['text'] = 'Job Seeker Berhasil Diaktifkan';
				$data['icon'] = 'success';
			}
		} else {
			$data['title'] = 'Error';
			$data['text'] = 'Status Gagal Diubah';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('user/job_seeker', 'refresh');
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
		} catch (Exception $e) {
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
		$this->db->where('username', $this->input->get('username'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);
	}


	public function ubah()
	{


		if (!is_dir('assets/img/foto_user/')) {
			mkdir('assets/img/foto_user/');
		}


		$foto = $this->input->post('lampiran_user_lama');

		if ($_FILES['lampiran_user']['name'] != '') {
			$filename = trim($_FILES['lampiran_user']['name']);
			$location = 'assets/img/foto_user/logo' . time() . $filename;
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
			'status_user' => 1,
		);
		$this->db->where('id_user', $this->input->post('id_user'));
		$result = $this->db->update('tbl_master_user', $data_user);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Data user dengan id_user" . $this->input->post('id_user'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'User Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'User Gagal Diubah!';
			$data['icon'] = 'error';
		}

		$this->session->set_flashdata($data);
		redirect('user', 'refresh');
	}


	public function cek_email()
	{
		$this->db->where('user_email', $this->input->get('email'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);
	}



	public function reset_password()
	{
		$data_user = array(
			'password' 			=> md5('12345678'),

		);

		$this->db->where('id_user', $this->input->post('id_user_password'));
		$result = $this->db->update('tbl_master_user', $data_user);
		if ($result) {

			$data_history = array(
				'id_user' => $this->session->id_user,
				'ip_address' => get_ip(),
				'aktivitas' => "Mereset Password user dengan id_user" . $this->input->post('id_user_password'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Error';
			$data['text'] = 'Password Gagal Diubah';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('user', 'refresh');
	}

	public function insert_user()
	{
		$methode = "add";
		$this->_validate($methode);
		$x = $this->input->post('file_firebase');
		$data = array(
			'user_email' => $this->input->post('user_email'),
			'user_nama' => $this->input->post('user_nama'),
			'user_password' => md5($this->input->post('user_password')),
			'user_status'	=> 1,
			'perusahaan_id'	=> 1,
			'user_level'	=> 1,
			'user_login_status'	=> 1,
			'user_created_date'	=> date('Y-m-d H:i:s'),
			'user_telepon' => $this->input->post('user_telepon'),
		);

		if (!empty($_FILES['user_photo']['name'])) {
			$data['user_foto'] = $this->input->post('file_firebase');
		}
		$this->db->insert("tbl_master_user", $data);
		$insert_id = $this->db->insert_id();

		$role_id = count($this->input->post('role_id'));

		for ($i = 0; $i < $role_id; $i++) {
			$datas[$i] = array(
				'user_id'     => $insert_id,
				'role_id'     => $this->input->post('role_id[' . $i . ']'),
			);
			$this->db->insert("tbl_admin_role", $datas[$i]);
		}

		echo json_encode(array("status" => TRUE));
	}

	private function _validate($methode)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if ($methode == "add") {

			if ($this->input->post('user_nama') == '') {
				$data['inputerror'][] = 'user_nama';
				$data['error_string'][] = 'Nama wajib diisi';
				$data['status'] = FALSE;
			}

			$email = $this->input->post('user_email');
			$cek_data = $this->db->get_where('tbl_master_user', ['user_email' => $email])->row();
			if ($this->input->post('user_email') == '') {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Email wajib diisi';
				$data['status'] = FALSE;
			} elseif ($cek_data) {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Email sudah terdaftar';
				$data['status'] = FALSE;
			}

			if ($this->input->post('user_telepon') == '') {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon wajib diisi';
				$data['status'] = FALSE;
			} elseif (!is_numeric($this->input->post('user_telepon'))) {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon wajib angkat';
				$data['status'] = FALSE;
			} elseif (strlen($this->input->post('user_telepon')) < 11 || strlen($this->input->post('user_telepon')) > 14) {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon tidak boleh kurang dari 11 angka atau lebih dari 14 angka';
				$data['status'] = FALSE;
			}

			if ($this->input->post('user_password') == '') {
				$data['inputerror'][] = 'user_password';
				$data['error_string'][] = 'Password wajib diisi';
				$data['status'] = FALSE;
			} elseif (strlen($this->input->post('user_password')) < 6) {
				$data['inputerror'][] = 'user_password';
				$data['error_string'][] = 'Password tidak boleh kurang dari 6 karakter';
				$data['status'] = FALSE;
			}
		} else {
			if ($this->input->post('user_nama') == '') {
				$data['inputerror'][] = 'user_nama';
				$data['error_string'][] = 'Nama wajib diisi';
				$data['status'] = FALSE;
			}

			$email = $this->input->post('user_email');
			$cek_data = $this->db->get_where('tbl_master_user', ['user_email' => $email])->row();
			if ($this->input->post('user_email') == '') {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Email wajib diisi';
				$data['status'] = FALSE;
			} elseif ($cek_data) {
				if ($cek_data->user_email != $email) {
					$data['inputerror'][] = 'user_email';
					$data['error_string'][] = 'Email sudah terdaftar';
					$data['status'] = FALSE;
				}
			}

			if ($this->input->post('user_telepon') == '') {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon wajib diisi';
				$data['status'] = FALSE;
			} elseif (!is_numeric($this->input->post('user_telepon'))) {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon wajib angkat';
				$data['status'] = FALSE;
			} elseif (strlen($this->input->post('user_telepon')) < 11 || strlen($this->input->post('user_telepon')) > 14) {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon tidak boleh kurang dari 11 angka atau lebih dari 14 angka';
				$data['status'] = FALSE;
			}


			if ($this->input->post('user_password') != '') {
				if (strlen($this->input->post('user_password')) < 6) {
					$data['inputerror'][] = 'user_password';
					$data['error_string'][] = 'Password tidak boleh kurang dari 6 karakter';
					$data['status'] = FALSE;
				}
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}



	public function setStatus()
	{
		$user_id = $this->input->post('id');
		$getData = $this->db->get_where('tbl_master_user', ['user_id' => $user_id])->row_array();

		if (!$getData) {
			$response = [
				'status' => false,
				'errors' => 'Data Tidak Ditemukan.'
			];
		} else {
			if ($getData['user_status'] == 1) {
				$data = [
					'user_status' => 0,
				];
				$this->db->where('user_id', $user_id);
				$this->db->update('tbl_master_user', $data);
			} else {
				$data = [
					'user_status' => 1,
				];
				$this->db->where('user_id', $user_id);
				$this->db->update('tbl_master_user', $data);
			}
			$response = [
				'status'   => TRUE,
			];
		}

		echo json_encode($response);
	}

	public function get_data_user($id)
	{
		$isi = $this->db->get_where('tbl_master_user', ['user_id' => $id])->row();
		$menu = $this->db->query("SELECT mr.role_id FROM tbl_admin_role as ar JOIN tbl_master_role as mr ON ar.role_id = mr.role_id WHERE ar.user_id = $id")->result_array();
		$data = [
			'isi'	=> $isi,
			'menu'	=> $menu
		];

		echo json_encode($data);
	}

	public function update_user()
	{
		$methode = "update";
		$this->_validate($methode);
		$data = array(
			'user_email' => $this->input->post('user_email'),
			'user_nama' => $this->input->post('user_nama'),
			'user_status'	=> 1,
			'perusahaan_id'	=> 1,
			'user_level'	=> 1,
			'user_login_status'	=> 1,
			'user_updated_date'	=> date('Y-m-d H:i:s'),
			'user_telepon' => $this->input->post('user_telepon'),
		);

		if ($this->input->post('user_password')) // if remove photo checked
		{
			$data['user_password'] = md5($this->input->post('user_password'));
		}

		if (!empty($_FILES['user_photo']['name'])) {
			$data['user_foto'] = $this->input->post('file_firebase');
		}

		$this->db->where('user_id', $this->input->post('id'));
		$this->db->update('tbl_master_user', $data);

		$this->db->delete('tbl_admin_role', array('user_id' => $this->input->post('id')));
		$role_id = count($this->input->post('role_id'));

		for ($i = 0; $i < $role_id; $i++) {
			$datas[$i] = array(
				'user_id'     => $this->input->post('id'),
				'role_id'     => $this->input->post('role_id[' . $i . ']'),
			);
			$this->db->insert("tbl_admin_role", $datas[$i]);
		}

		echo json_encode(array("status" => TRUE));
	}
}