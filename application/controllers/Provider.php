<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provider extends CI_Controller
{


	public function index()
	{
		$this->db->where('slider_tipe', 'main');
		$this->db->where('slider_status', 1);
		$data['slider_main'] = $this->db->get('tbl_master_slider')->result();
		$this->db->where('kategori_status', 1);
		$this->db->limit(8);
		$this->db->order_by('kategori_nama', 'asc');
		$data['kategori_job'] = $this->db->get('tbl_master_kategori_job')->result();
		$this->db->where('slider_tipe', 'cv');
		$this->db->where('slider_status', 1);
		$data['slider_cv'] = $this->db->get('tbl_master_slider')->result();
		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		$this->db->where('slider_tipe', 'how');
		$this->db->where('slider_status', 1);
		$data['slider_how'] = $this->db->get('tbl_master_slider')->result();
		if ($this->session->login == FALSE) {
			$this->load->view('web/header', $data);
			$this->load->view('provider/tampilan_login', $data);
			$this->load->view('web/script_include', $data);
		} else {
			redirect('provider/dashboard', 'refresh');
		}
	}
	public function company()
	{
		$this->db->where('a.perusahaan_id', $this->session->perusahaan_id);
		$this->db->join('tbl_master_provinsi b', 'b.prov_id=a.perusahaan_prov', 'left');
		$this->db->join('tbl_master_kabkota c', 'c.kabkota_id=a.perusahaan_kabkota', 'left');
		$data['perusahaan'] = $this->db->get('tbl_perusahaan a')->result();
		$data['stp'] = $this->db->get('tbl_master_stp')->result();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('provider/tampilan_perusahaan', $data);
		$this->load->view('templates/footer');
	}

	public function ubah_sampul()
	{
		$this->db->where('perusahaan_id', $this->session->perusahaan_id);
		$result = $this->db->update('tbl_perusahaan', array('perusahaan_sampul' => $this->input->post('lampiran_sampul_lama')));
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Lini Masa Perusahaan Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Lini Masa Perusahaan Gagal Diubah!';
			$data['icon'] = 'error';
		}

		$this->session->set_flashdata($data);
		redirect('provider/company', 'refresh');
	}

	public function ubah_logo()
	{
		$this->db->where('perusahaan_id', $this->session->perusahaan_id);
		$result = $this->db->update('tbl_perusahaan', array('perusahaan_logo' => $this->input->post('lampiran_logo_lama')));
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Logo Perusahaan Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Logo Perusahaan Gagal Diubah!';
			$data['icon'] = 'error';
		}

		$this->session->set_flashdata($data);
		redirect('provider/company', 'refresh');
	}

	public function ubah_perusahaan()
	{
		$data_perusahaan = array(
			'perusahaan_nama' => $this->input->post('perusahaan_nama_edit'),
			'perusahaan_prov' => $this->input->post('perusahaan_prov_edit'),
			'perusahaan_kabkota' => $this->input->post('perusahaan_kabkota_edit'),
			'perusahaan_alamat' => $this->input->post('perusahaan_alamat_edit'),
			'perusahaan_telepon' => $this->input->post('perusahaan_telepon_edit'),
			'perusahaan_email' => $this->input->post('perusahaan_email_edit'),
			'perusahaan_website' => $this->input->post('perusahaan_website_edit'),
			'perusahaan_jml_karyawan' => $this->input->post('perusahaan_jml_karyawan_edit'),
			'perusahaan_sambutan' => $this->input->post('perusahaan_sambutan_edit'),
		);

		$this->db->where('perusahaan_id', $this->session->perusahaan_id);
		$result = $this->db->update('tbl_perusahaan', $data_perusahaan);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Data Profil Perusahaan",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Profil Perusahaan Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Profil Perusahaan Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('provider/company', 'refresh');
	}


	public function cek_login()
	{
		$email = $this->input->post('seeker_email');
		$password = md5($this->input->post('seeker_password'));
		$cek = $this->model_query->cek_provider($email, $password)->result();
		if ($cek != NULL) {

			foreach ($cek as $a) {
				if ($a->user_status == 1) {
					$stp = 	$this->db->get('tbl_master_stp')->result();
					foreach ($stp as $s) {
						$data['stp_id'] = $s->stp_id;
						$data['stp_nama'] = $s->stp_nama;
						$data['stp_pemilik'] = $s->stp_pemilik;
						$data['stp_logo'] = $s->stp_logo;
						$data['stp_brand_icon'] = $s->stp_brand_icon;
					}
					$data['user_id'] = $a->user_id;
					$data['user_nama'] = $a->user_nama;
					$data['user_email'] = $a->user_email;
					$data['user_level'] = $a->user_level;
					$data['user_foto'] = $a->user_foto;
					$data['user_telepon'] = $a->user_telepon;
					$data['perusahaan_id'] = $a->perusahaan_id;
					$data['login'] = TRUE;
					$this->session->set_userdata($data);
					$data = array(
						'user_login_status' => "1",
					);

					$this->db->where('user_id', $a->user_id);
					$this->db->update('tbl_master_user', $data);
					redirect('dashboard', 'refresh');
				} else {

					$data['title'] = 'Login Gagal';
					$data['text'] = 'User Belum Diaktivasi!';
					$data['icon'] = 'error';
					$this->session->set_flashdata($data);
					redirect('landing/login', 'refresh');
				}
			}
		} else {
			$data['title'] = 'Login Gagal';
			$data['text'] = 'Silahkan Periksa Email & Password!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
			redirect('landing/login', 'refresh');
		}
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

	public function simpan_pendaftaran()
	{
		$data_perusahaan  = array(
			'perusahaan_nama' => $this->input->post('perusahaan_id'),
		);
		$simpan = $this->db->insert('tbl_perusahaan', $data_perusahaan);
		if ($simpan) {
			$this->db->where('perusahaan_nama', $this->input->post('perusahaan_id'));
			$this->db->limit(1);
			$this->db->order_by('perusahaan_id', 'desc');
			$perusahaan = $this->db->get('tbl_perusahaan')->result();
			foreach ($perusahaan as $pr) {
				$perusahaan_id = $pr->perusahaan_id;
				$foto = 'assets_admin/img/profile.svg';
				$data_seeker = array(
					'user_level' 			=> 3,
					'user_nama' 			=> $this->input->post('seeker_nama'),
					'user_telepon' 			=> $this->input->post('seeker_telepon'),
					'user_password' 		=> md5($this->input->post('seeker_password')),
					'user_email' 			=> $this->input->post('seeker_email'),
					'user_status'			=> 0,
					'perusahaan_id' 		=> $perusahaan_id,
					'user_foto' 			=> $foto,
					'user_created_date' 	=> date('Y-m-d H:i:s'),
				);

				$result = $this->db->insert('tbl_master_user', $data_seeker);

				if ($result) {

					$this->db->where('user_nama', $this->input->post('seeker_nama'));
					$this->db->where('user_level', 3);
					$this->db->order_by('user_id', 'desc');
					$this->db->limit(1);
					$user = $this->db->get('tbl_master_user')->result();
					foreach ($user as $key) {
						$user_id = $key->user_id;
						$token = $this->generateRandomString();
						$tanggal = date('Y-m-d H:i:s');
						$data_token  = array(
							'token_isi' => $token,
							'token_expired_date' => date('Y-m-d H:i:s', strtotime($tanggal . ' +1 day')),
							'token_keterangan' => 'Aktivasi Akun',
							'user_id' => $user_id,
						);
						$this->db->insert('tbl_token', $data_token);

						$this->load->library('Mailer');
						$email_penerima = $this->input->post('seeker_email');
						if ($email_penerima != '') {
							$subjek = "Aktivasi Akun Talent Hub - " . $this->input->post('seeker_nama');
							$password = $this->input->post('seeker_password');
							$pesan = $this->kirim_email($token, $email_penerima, $password);
							$content = $this->load->view('content', array('pesan' => $pesan), true);
							$sendmail = array(
								'email_penerima' => $email_penerima,
								'subjek' => $subjek,
								'content' => $content,
							);
							$send = $this->mailer->send($sendmail);
						}
					}

					$data['title'] = 'Pendaftaran Berhasil';
					$data['text'] = 'Silahkan Cek Email Untuk Aktivasi Akun!';
					$data['icon'] = 'success';
				} else {
					$data['title'] = 'Gagal';
					$data['text'] = 'Pendaftaran Gagal!';
					$data['icon'] = 'error';
				}
			}
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Pendaftaran Gagal!';
			$data['icon'] = 'error';
		}


		$this->session->set_flashdata($data);
		redirect('landing/register', 'refresh');
	}

	public function job_posting()
	{

		$this->db->where('kategori_status', 1);
		$this->db->limit(8);
		$this->db->order_by('kategori_nama', 'asc');
		$data['kategori_job'] = $this->db->get('tbl_master_kategori_job')->result();

		$this->db->where('kategori_status', 1);
		$this->db->order_by('kategori_nama', 'asc');
		$data['kategori'] = $this->db->get('tbl_master_kategori_job')->result();

		$this->db->where('skill_status', 1);
		$this->db->order_by('skill_nama', 'asc');
		$data['skill'] = $this->db->get('tbl_master_skill')->result();

		$this->db->where('joblevel_status', 1);
		$this->db->order_by('joblevel_nama', 'asc');
		$data['joblevel'] = $this->db->get('tbl_master_level_job')->result();

		$this->db->where('jabatan_status', 1);
		$this->db->order_by('jabatan_nama', 'asc');
		$data['jabatan'] = $this->db->get('tbl_master_jabatan')->result();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('provider/tampilan_job_posting', $data);
		$this->load->view('templates/footer');
	}


	public function kirim_email($id_user, $email, $password)
	{
		$data['id_user'] = $id_user;
		$data['email'] = $email;
		$data['password'] = $password;
		$content = $this->load->view('provider/body_email', $data, true);
		return $content;
	}

	public function logout()
	{
		$this->db->where('user_id', $this->session->user_id);
		$logout = $this->db->update('tbl_master_user', array('user_login_status' => 0,));
		if ($logout) {
			$this->session->sess_destroy();
			redirect('landing');
		}
	}

	public function tabel_job_posting()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'lowongan_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('job_posting', $sort, $order, $search);
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
			"recordsTotal"      => $this->model_tabel->count_all('job_posting', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job_posting', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}
	public function application()
	{
		$id = $this->session->perusahaan_id;
		$data["lowongan"] = $this->db->query("SELECT lowongan_id,perusahaan_logo,lowongan_judul,kabkota_nama FROM tbl_lowongan_pekerjaan JOIN tbl_perusahaan on tbl_lowongan_pekerjaan.perusahaan_id = tbl_perusahaan.perusahaan_id JOIN tbl_master_kabkota ON tbl_perusahaan.perusahaan_kabkota = tbl_master_kabkota.kabkota_id WHERE tbl_perusahaan.perusahaan_id = '$id' ")->result();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('provider/tampilan_application', $data);
		$this->load->view('templates/footer');
	}

	public function tabel_application($id)
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'lowongan_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('application_provider', $sort, $order, $search, $id);
		foreach ($list as $l) {
			$no++;
			if ($l->lamaran_status == 0) {
				$status = '<label class="badge badge-pill badge-success">In Review</label>';
			} elseif ($l->lamaran_status == 1) {
				$status = '<label class="badge badge-pill badge-success">Assesment</label>';
			} elseif ($l->lamaran_status == 2) {
				$status = '<label class="badge badge-pill badge-danger">Rejected</label>';
			} elseif ($l->lamaran_status == 3) {
				$status = '<label class="badge badge-pill badge-success">Accepted</label>';
			};

			if ($l->resume_lampiran) {
				$resume = '<a href="' . $l->resume_lampiran . '" class="btn" target="_blank">Download CV</a>';
			} else {
				$resume = "CV tidak ada";
			};

			$l->isi_lowongan = '<div class="card border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><img src="' . $l->resume_foto . '" style="width:5%;margin-right:25px;">
			<div class="col mr-2"><div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
			' . $l->resume_nama_lengkap . '</div>
			<div class="h6 mb-2 text-gray-800">' . $resume . '</div>
			<div class="h6 mb-2 font-weight-bold text-gray-800">
			<i class="fas fa-map-marker-alt mr-2"></i>' . $l->kabkota_nama . " - " . $l->prov_nama . '</i>
			</div>
			<div class="h6 mb-2 font-weight-bold text-gray-800">
			' . $status . '
			<label class="badge badge-pill ">' . date('d M Y, H:i:s', strtotime($l->lamaran_tanggal)) . '</label>
			</div>
			</div>
			<div class="col-auto">
			<ul style="list-style: none">
			<li class="p-2"><a href="javascript:;" onclick="cek_pelamar(' . $l->lamaran_id . ')" class="btn btn-lg rounded mr-2 btn-success shadow"><i class="fa fa-eye mr-2"></i>Cek</a>
			</li>
			<li class="p-2"><a href="' . base_url() . 'chat/index/' . md5($l->user_id) . '" class="btn btn-lg rounded  mr-2 btn text-danger shadow item_chat"><i class="fas fa-fw fa-comment mr-2"></i>Chat &nbsp;</a>
			</li>
			</ul>				
			</div>
			</div></div></div>';
			$l->no = $no;
			$data[] = $l;
		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('application_provider', $sort, $order, $search, $id),
			"recordsFiltered"   => $this->model_tabel->count_filtered('application_provider', $sort, $order, $search, $id),
			"data"              => $data,
		);
		echo json_encode($output);

		unset($_SESSION['status_lowongan']);
	}

	public function cek_pelamar($id)
	{
		$cek = $this->db->query("SELECT r.*,mu.user_email,mu.user_telepon,pp.pelamar_id FROM tbl_pelamar_pekerjaan as pp JOIN tbl_resume as r ON pp.pelamar_id = r.user_id JOIN tbl_master_user as mu on mu.user_id = pp.pelamar_id WHERE pp.lamaran_id = $id")->row();
		$skill = $this->db->query("SELECT skill_nama,skill_level_nama FROM tbl_skill_resume AS sr JOIN tbl_master_skill as ms on sr.skill_id = ms.skill_id JOIN tbl_skill_level AS sl ON sl.skill_level_id = sr.skill_level_id WHERE sr.user_id = $cek->pelamar_id ")->result();

		$data = [
			'resume' => $cek,
			'skill'	=> $skill
		];

		echo json_encode($data);
	}

	public function update_pekerjaan()
	{
		$id = $this->input->post('id');
		$data = [
			'lamaran_status' => $this->input->post('status_pelamar'),
		];
		$this->db->where('lamaran_id', $id);
		$this->db->update('tbl_pelamar_pekerjaan', $data);

		echo json_encode(['status' => true]);
	}

	public function get_filter()
	{
		$status = $this->input->post('status');
		$newdata = array(
			'status_lowongan'  => $status
		);

		$this->session->set_userdata($newdata);
		$x = $this->session->status_lowongan;
		echo json_encode(['status' => true, 'status_lowongan' => $x]);
	}

	public function edit_profile()
	{;
		$user_id = $this->session->user_id;
		$data['seeker'] = $this->db->get_where('tbl_master_user', ['user_id' => $user_id])->row();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('provider/edit_profile', $data);
		$this->load->view('templates/footer');
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
			'user_updated_date'	=> date('Y-m-d H:i:s'),
			'user_telepon' => $hp,
		);


		if (!empty($_FILES['user_photo']['name'])) {
			$data['user_foto'] = $this->input->post('file_firebase');
		}

		$this->db->where('user_id', $this->input->post('id_user'));
		$this->db->update('tbl_master_user', $data);

		if ($this->session->user_email != $this->input->post('user_email')) {
			# code...
			$user_id = $this->input->post('id_user');
			$token = $this->generateRandomString();
			$tanggal = date('Y-m-d H:i:s');
			$data_token  = array(
				'token_isi' => $token,
				'token_expired_date' => date('Y-m-d H:i:s', strtotime($tanggal . ' +1 day')),
				'token_keterangan' => 'Aktivasi Akun Ganti Email',
				'user_id' => $user_id,
			);
			$this->db->insert('tbl_token', $data_token);

			$this->load->library('Mailer');
			$email_penerima = $this->input->post('user_email');
			if ($email_penerima != '') {
				$subjek = "Aktivasi Perbahaui Email Akun Talent Hub - " . $this->input->post('user_nama');
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
		}

		unset($_SESSION['user_nama']);
		unset($_SESSION['user_foto']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_telepon']);
		$newdata = array(
			'user_nama'  => $this->input->post('user_nama'),
			'user_foto'  => $this->input->post('file_firebase'),
			'user_email'  => $this->input->post('user_email'),
			'user_telepon'  => $this->input->post('user_telepon')
		);

		$this->session->set_userdata($newdata);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate($methode)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

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
			} elseif ($cek_email) {
				$data['inputerror'][] = 'user_email';
				$data['error_string'][] = 'Email sudah terdaftar';
				$data['status'] = FALSE;
			}

			$cek_telepon = $this->db->get_where('tbl_master_user', ['user_telepon' => $hp])->row();
			if ($this->input->post('user_telepon') == '') {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon wajib diisi';
				$data['status'] = FALSE;
			} elseif ($cek_telepon) {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon sudah terdaftar';
				$data['status'] = FALSE;
			}

			if ($this->input->post('user_password') == '') {
				$data['inputerror'][] = 'user_password';
				$data['error_string'][] = 'Password wajib diisi';
				$data['status'] = FALSE;
			}
		} else {
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
			} elseif ($email != $this->session->user_email) {
				if ($cek_email) {
					$data['inputerror'][] = 'user_email';
					$data['error_string'][] = 'Email sudah terdaftar';
					$data['status'] = FALSE;
				}
			}
			$cek_telepon = $this->db->get_where('tbl_master_user', ['user_telepon' => $hp])->row();
			if ($this->input->post('user_telepon') == '') {
				$data['inputerror'][] = 'user_telepon';
				$data['error_string'][] = 'No telepon wajib diisi';
				$data['status'] = FALSE;
			} elseif ($hp != $this->session->user_telepon) {
				if ($cek_telepon) {
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
}
