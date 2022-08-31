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
		$this->load->model('Model_laporan_user', 'lap_user');
	}

	public function detail_user()
	{
		$this->db->where('user_id', $this->input->get('user_id'));
		$data = $this->db->get('tbl_master_user')->result();
		echo json_encode($data);
	}

	public function get_user()
	{
		$this->db->select('a.user_id');
		$penerima = $this->input->get('penerima');
		$this->db->where('a.user_status', 1);
		if ($penerima == "Job Seeker") {
			$this->db->where('a.user_level', 2);
		}

		if ($penerima == "Job Provider") {
			$this->db->where('a.user_level', 3);
		}
		$data = $this->db->get('tbl_master_user a')->result();
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
				} elseif ($l->user_status == 2) {
					$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm" onclick="approve_provider(' . $l->user_id . ')"><i class="fa fa-check-circle"></i>Approve Perusahaan</a>';
				} else {
					$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_user" data="' . $l->user_id . '"><i class="fa fa-check-circle"></i></a>';
				}
			}
			$opsi .= '</div>';
			$l->opsi = $opsi;
			if ($l->user_status == 1) {
				$l->user_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			} elseif ($l->user_status == 2) {
				$l->user_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Belum di Approve</button>';
			} else {
				$l->user_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}
			if ($l->user_foto != '') {
				$l->user_foto = '<img src="' . $l->user_foto . '" width="50px">';
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
				$l->user_foto = '<img src="' . $l->user_foto . '" width="50px">';
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
			$jml_view = $this->db->query("SELECT count(view_id_lowongan) as jml FROM tbl_view WHERE view_id_lowongan = $l->lowongan_id ")->row();

			$no++;
			$l->isi_lowongan = '<div class="card border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><img src="' . $l->perusahaan_logo . '" style="width:5%;margin-right:25px;">
			<div class="col mr-2"><div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
			' . $l->lowongan_judul . '</div>
			<div class="h6 mb-2 text-gray-800">' . $l->kategori_nama . '</div>
			<div class="h6 mb-2 font-weight-bold text-gray-800"><i class="fas fa-map-marker-alt mr-2"></i>' . $l->kabkota_nama . " - " . $l->prov_nama . '</i></div>
			<div class="h6 mb-0 font-weight-bold text-gray-800">Dilihat ' . $jml_view->jml . 'x</div>
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

		// try {
		// 	$storage = new StorageClient([
		// 		'projectId' => 'etraining-solo',
		// 		'keyFilePath' => 'assets/json/solo-digital-tech-9a8c6ffab50b.json',
		// 	]);
		// 	$bucketName = 'artisansweb-bucket';
		// 	$bucket = $storage->defaultBucket();
		// 	echo "Your Bucket $bucket .";
		// } catch (Exception $e) {
		// 	echo $e->getMessage();
		// }


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
		$no_hp = $this->input->post('user_telepon');
		// Ubah no HP dari 08 ke +62
		// kadang ada penulisan no hp 0811 239 345
		$no_hp = str_replace(" ", "", $no_hp);
		// kadang ada penulisan no hp (0274) 778787
		$no_hp = str_replace("(", "", $no_hp);
		// kadang ada penulisan no hp (0274) 778787
		$no_hp = str_replace(")", "", $no_hp);
		// kadang ada penulisan no hp 0811.239.345
		$no_hp = str_replace(".", "", $no_hp);

		// cek apakah no hp mengandung karakter + dan 0-9
		if (!preg_match('/[^+0-9]/', trim($no_hp))) {
			// cek apakah no hp karakter 1-3 adalah +62
			if (substr(trim($no_hp), 0, 3) == '+62') {
				$hp = trim($no_hp);
			}
			// cek apakah no hp karakter 1 adalah 0
			elseif (substr(trim($no_hp), 0, 1) == '0') {
				$hp = '+62' . substr(trim($no_hp), 1);
			}
		}

		$data = array(
			'user_email' => $this->input->post('user_email'),
			'user_nama' => $this->input->post('user_nama'),
			'user_password' => md5($this->input->post('user_password')),
			'user_status'	=> 1,
			'perusahaan_id'	=> 1,
			'user_level'	=> 1,
			'user_login_status'	=> 1,
			'user_created_date'	=> date('Y-m-d H:i:s'),
			'user_telepon' => $hp,
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


		$no_hp = $this->input->post('user_telepon');
		if ($no_hp != "") {
			if (is_numeric($no_hp)) {
				// Ubah no HP dari 08 ke +62
				// kadang ada penulisan no hp 0811 239 345
				$no_hp = str_replace(" ", "", $no_hp);
				// kadang ada penulisan no hp (0274) 778787
				$no_hp = str_replace("(", "", $no_hp);
				// kadang ada penulisan no hp (0274) 778787
				$no_hp = str_replace(")", "", $no_hp);
				// kadang ada penulisan no hp 0811.239.345
				$no_hp = str_replace(".", "", $no_hp);

				// cek apakah no hp mengandung karakter + dan 0-9
				if (!preg_match('/[^+0-9]/', trim($no_hp))) {
					// cek apakah no hp karakter 1-3 adalah +62
					if (substr(trim($no_hp), 0, 3) == '+62') {
						$hp = trim($no_hp);
					}
					// cek apakah no hp karakter 1 adalah 0
					elseif (substr(trim($no_hp), 0, 1) == '0') {
						$hp = '+62' . substr(trim($no_hp), 1);
					}
				}
				$cek_telepon = $this->db->get_where('tbl_master_user', ['user_telepon' => $hp])->row();
			}
		}

		if ($methode == "add") {

			if ($this->input->post('user_nama') == '') {
				$data['inputerror'][] = 'user_nama';
				$data['error_string'][] = 'Nama wajib diisi';
				$data['status'] = FALSE;
			}

			$email = $this->input->post('user_email');

			$cek_email = $this->db->get_where('tbl_master_user', ['user_email' => $email])->row();
			if ($this->input->post('user_email') == '') {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Email wajib diisi';
				$data['status'] = FALSE;
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Masukan email dengan benar';
				$data['status'] = FALSE;
			} elseif ($cek_email) {
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
				$data['error_string'][] = 'No telepon wajib angka!';
				$data['status'] = FALSE;
			} elseif ($cek_telepon) {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No Telepon sudah terdaftar';
				$data['status'] = FALSE;
			}

			// $password = $this->input->post('user_password');
			// $uppercase = preg_match('@[A-Z]@', $password);
			// $lowercase = preg_match('@[a-z]@', $password);
			// $number    = preg_match('@[0-9]@', $password);

			// if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
			// tell the user something went wrong

			if ($this->input->post('user_password') == '') {
				$data['inputerror'][] = 'user_password';
				$data['error_string'][] = 'Password wajib diisi';
				$data['status'] = FALSE;
			} elseif (strlen($this->input->post('user_password')) < 6) {
				$data['inputerror'][] = 'user_password';
				$data['error_string'][] = 'Password wajib 6 digit';
				$data['status'] = FALSE;
				# code...
			}

			if ($this->input->post('role_id') == '') {
				$data['inputerror'][] = 'role_id';
				$data['error_string'][] = 'Silahkan Pilih Role Min. 1';
				$data['status'] = FALSE;
			}
		} else {
			if ($this->input->post('user_nama') == '') {
				$data['inputerror'][] = 'user_nama';
				$data['error_string'][] = 'Nama wajib diisi';
				$data['status'] = FALSE;
			}

			$email = $this->input->post('user_email');
			$id = $this->input->post('id');
			$cek = $this->db->get_where('tbl_master_user', ['user_id' => $id])->row();
			if ($this->input->post('user_email') == '') {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Email wajib diisi';
				$data['status'] = FALSE;
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Masukan email dengan benar';
				$data['status'] = FALSE;
			} elseif ($cek->user_email != $email) {
				$cek_email = $this->db->get_where('tbl_master_user', ['user_email' => $email])->row();
				if ($cek_email) {
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
				$data['error_string'][] = 'No telepon wajib angka!';
				$data['status'] = FALSE;
			} elseif ($cek->user_telepon != $hp) {
				$cek_tlp = $this->db->get_where('tbl_master_user', ['user_telepon' => $hp])->row();
				if ($cek_tlp) {
					$data['inputerror'][] = 'user_telepon';
					$data['error_string'][] = 'No Telepon sudah terdaftar';
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

		$no_hp = $this->input->post('user_telepon');
		// Ubah no HP dari 08 ke +62
		// kadang ada penulisan no hp 0811 239 345
		$no_hp = str_replace(" ", "", $no_hp);
		// kadang ada penulisan no hp (0274) 778787
		$no_hp = str_replace("(", "", $no_hp);
		// kadang ada penulisan no hp (0274) 778787
		$no_hp = str_replace(")", "", $no_hp);
		// kadang ada penulisan no hp 0811.239.345
		$no_hp = str_replace(".", "", $no_hp);

		// cek apakah no hp mengandung karakter + dan 0-9
		if (!preg_match('/[^+0-9]/', trim($no_hp))) {
			// cek apakah no hp karakter 1-3 adalah +62
			if (substr(trim($no_hp), 0, 3) == '+62') {
				$hp = trim($no_hp);
			}
			// cek apakah no hp karakter 1 adalah 0
			elseif (substr(trim($no_hp), 0, 1) == '0') {
				$hp = '+62' . substr(trim($no_hp), 1);
			}
		}


		$data = array(
			'user_email' => $this->input->post('user_email'),
			'user_nama' => $this->input->post('user_nama'),
			'user_status'	=> 1,
			'perusahaan_id'	=> 1,
			'user_level'	=> 1,
			'user_login_status'	=> 1,
			'user_updated_date'	=> date('Y-m-d H:i:s'),
			'user_telepon' => $hp,
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

	public function approve_provider($id)
	{
		$data = [
			'user_status' => 1,
		];
		$this->db->where('user_id', $id);
		$this->db->update('tbl_master_user', $data);

		$akun = $this->db->get_where('tbl_master_user', ['user_id' => $id])->row();
		$token = $this->generateRandomString();
		$tanggal = date('Y-m-d H:i:s');
		$data_token  = array(
			'token_isi' => $token,
			'token_expired_date' => date('Y-m-d H:i:s', strtotime($tanggal . ' +1 day')),
			'token_keterangan' => 'Selamat akun anda telah bisa di gunakan',
			'user_id' => $id,
		);
		$this->db->insert('tbl_token', $data_token);

		$this->load->library('Mailer');
		$email_penerima = $akun->user_email;
		if ($email_penerima != '') {
			$subjek = "Approve Akun Provider Talent Hub - " . $akun->user_nama;
			$password = "Password dirahasiakan";
			$pesan = $this->kirim_email($token, $email_penerima, $password);
			$content = $this->load->view('content', array('pesan' => $pesan), true);
			$sendmail = array(
				'email_penerima' => $email_penerima,
				'subjek' => $subjek,
				'content' => $content,
			);
			$send = $this->mailer->send($sendmail);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function kirim_email($id_user, $email, $password)
	{
		$data['id_user'] = $id_user;
		$data['email'] = $email;
		$data['password'] = "Dirahasiakan";
		$content = $this->load->view('provider/body_email_approve', $data, true);
		return $content;
	}

	public function laporan_user()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_laporan_user');
		$this->load->view('admin/footer');
	}

	public function tabel_laporan_user()
	{
		$list = $this->lap_user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			if ($person->user_level == 1) {
				$sebagai = "Admin";
			} elseif ($person->user_level == 2) {
				$sebagai = "Seeker";
			} elseif ($person->user_level == 3) {
				$sebagai = "Provider";
			};

			$row = array();
			$row[] = $no;
			$row[] = date("d-M-Y H:i:s", strtotime($person->user_created_date));
			$row[] = $person->user_nama;
			$row[] = $person->user_email;
			$row[] = $person->user_telepon;
			$row[] = $sebagai;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->lap_user->count_all(),
			"recordsFiltered" => $this->lap_user->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function laporan_user_print()
	{

		$dari_tgl = $this->input->post('dari_tgl');
		$sampai_tgl = $this->input->post('sampai_tgl');
		$sebagai = $this->input->post('sebagai');

		$array = array(
			'dari_tgl_user' => $dari_tgl,
			'sampai_tgl_user' => $sampai_tgl,
			'sebagai_user' => $sebagai,
		);

		$this->session->set_userdata($array);


		$this->form_validation->set_rules(
			'dari_tgl',
			'Dari_tgl',
			'required|callback_daritgl',
			array('required' => 'Dari tanggal wajib di isi!')
		);
		$this->form_validation->set_rules(
			'sampai_tgl',
			'Sampai_tgl',
			'required',
			array('required' => 'Sampai tanggal wajib di isi!')
		);

		if ($this->form_validation->run() == FALSE) {
			$this->laporan_user();
		} else {
			$data['profile_apk']     = $this->db->get('tbl_master_stp')->row();
			$data['dari_tgl']        = $dari_tgl;
			$data['sampai_tgl']      = $sampai_tgl;

			if ($sebagai == "all") {
				$data['laporan'] = $this->db->query("SELECT tbl_master_user.*,tbl_perusahaan.perusahaan_nama,tbl_resume.resume_nama_lengkap FROM tbl_master_user LEFT JOIN tbl_perusahaan ON tbl_master_user.perusahaan_id = tbl_perusahaan.perusahaan_id LEFT JOIN tbl_resume ON tbl_resume.user_id = tbl_master_user.user_id WHERE user_created_date BETWEEN '$dari_tgl' AND '$sampai_tgl' AND user_status != 0 ORDER BY user_created_date ASC")->result();
			} else {
				$data['laporan'] = $this->db->query("SELECT tbl_master_user.*,tbl_perusahaan.perusahaan_nama,tbl_resume.resume_nama_lengkap FROM tbl_master_user LEFT JOIN tbl_perusahaan ON tbl_master_user.perusahaan_id = tbl_perusahaan.perusahaan_id LEFT JOIN tbl_resume ON tbl_resume.user_id = tbl_master_user.user_id WHERE user_created_date BETWEEN '$dari_tgl' AND '$sampai_tgl' AND user_level = '$sebagai' AND user_status != 0 ORDER BY user_created_date ASC")->result();
			}
			$this->load->view('admin/tampilan_laporan_user_pdf', $data);
		}
	}

	public function daritgl()
	{
		$dari_tgl = $this->input->post('dari_tgl');
		$sampai_tgl = $this->input->post('sampai_tgl');

		if ($dari_tgl > $sampai_tgl) {
			$this->form_validation->set_message('daritgl', 'Tanggal ini harus sebelum tanggal selanjutnya');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function laporan_excel_user()
	{
		// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Laporan_data_user_TalentHub.xls");

		$dari_tgl        = $this->session->userdata('dari_tgl_user');
		$sampai_tgl      = $this->session->userdata('sampai_tgl_user');
		$sebagai 		 = $this->session->userdata('sebagai_user');

		$data['profile_apk']     = $this->db->get('tbl_master_stp')->row();
		$data['dari_tgl']        = $dari_tgl;
		$data['sampai_tgl']      = $sampai_tgl;

		if ($sebagai == "all") {
			$data['laporan'] = $this->db->query("SELECT tbl_master_user.*,tbl_perusahaan.perusahaan_nama,tbl_resume.resume_nama_lengkap FROM tbl_master_user LEFT JOIN tbl_perusahaan ON tbl_master_user.perusahaan_id = tbl_perusahaan.perusahaan_id LEFT JOIN tbl_resume ON tbl_resume.user_id = tbl_master_user.user_id WHERE user_created_date BETWEEN '$dari_tgl' AND '$sampai_tgl' AND user_status != 0 ORDER BY user_created_date ASC")->result();
		} else {
			$data['laporan'] = $this->db->query("SELECT tbl_master_user.*,tbl_perusahaan.perusahaan_nama,tbl_resume.resume_nama_lengkap FROM tbl_master_user LEFT JOIN tbl_perusahaan ON tbl_master_user.perusahaan_id = tbl_perusahaan.perusahaan_id LEFT JOIN tbl_resume ON tbl_resume.user_id = tbl_master_user.user_id WHERE user_created_date BETWEEN '$dari_tgl' AND '$sampai_tgl' AND user_level = '$sebagai' AND user_status != 0 ORDER BY user_created_date ASC")->result();
		}

		$this->load->view('admin/excel_data_user', $data);
	}
}
