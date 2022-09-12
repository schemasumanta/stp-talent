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
				} elseif ($a->user_status == 2) {
					$stp = 	$this->db->get('tbl_master_stp')->row();
					$data['user_email'] = $a->user_email;
					$data['stp_brand_icon'] = $stp->stp_brand_icon;
					$this->session->set_userdata($data);
					redirect('landing/lock_akun', 'refresh');
				} else {
					if ($this->session->langguage == "in") {
						$data['title'] = 'Login Gagal';
						$data['text'] = 'User Belum Diaktivasi!';
						$data['icon'] = 'error';
						$this->session->set_flashdata($data);
					} else {
						$data['title'] = 'Login Failed';
						$data['text'] = 'User Not Activated!';
						$data['icon'] = 'error';
						$this->session->set_flashdata($data);
					}
					redirect('landing/login', 'refresh');
				}
			}
		} else {
			if ($this->session->langguage == "in") {
				$data['title'] = 'Login Gagal';
				$data['text'] = 'Silahkan Periksa Email & Password!';
				$data['icon'] = 'error';
				$this->session->set_flashdata($data);
			} else {
				$data['title'] = 'Login Failed';
				$data['text'] = 'Please Check Email & Password!';
				$data['icon'] = 'error';
				$this->session->set_flashdata($data);
			}
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
			'perusahaan_nama' => $this->input->post('perusahaan_nama'),
			'perusahaan_website' => $this->input->post('perusahaan_website'),
			'perusahaan_email' => $this->input->post('seeker_email'),
		);
		if (!empty($_FILES['file_npwp']['name'])) {
			$upload = $this->_do_upload_npwp();
			$data_perusahaan['perusahaan_npwp'] = $upload;
		};

		if (!empty($_FILES['file_nib']['name'])) {
			$upload = $this->_do_upload_nib();
			$data_perusahaan['perusahaan_nib'] = $upload;
		};

		$simpan = $this->db->insert('tbl_perusahaan', $data_perusahaan);
		$perusahaan_id = $this->db->insert_id();
		if ($simpan) {
			$this->db->where('perusahaan_id', $perusahaan_id);
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
				$user_id = $this->db->insert_id();

				if ($result) {

					$this->db->where('user_id', $user_id);
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

	private function _do_upload_npwp()
	{
		$config['upload_path']          = 'assets/dokumen/npwp/';
		$config['allowed_types']        = 'pdf';
		$config['max_size']             = 2048; //set max size allowed in Kilobyte
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
		$this->upload->initialize($config);
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_npwp')) //upload and validate
		{
			$data['title'] = 'File NPWP ada error nih';
			$data['text'] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
		}
		return $this->upload->data('file_name');
	}

	private function _do_upload_nib()
	{
		$config['upload_path']          = 'assets/dokumen/nib/';
		$config['allowed_types']        = 'pdf';
		$config['max_size']             = 2048; //set max size allowed in Kilobyte
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
		$this->upload->initialize($config);
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_nib')) //upload and validate
		{
			$data['title'] = 'File NIB ada error nih';
			$data['text'] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
		}
		return $this->upload->data('file_name');
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

		$data['premium_user'] = $this->db->get_where('tbl_langganan_premium', ['user_id' => $this->session->user_id])->row();

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
			$jml_view = $this->db->query("SELECT count(view_id_lowongan) as jml FROM tbl_view WHERE view_id_lowongan = $l->lowongan_id ")->row();

			if ($l->lowongan_status == 1) {
				$status = "Aktif";
			} elseif ($l->lowongan_status == 2) {
				$status = "Tidak Aktif";
			} elseif ($l->lowongan_status == 3) {
				$status = "Sold Out";
			}

			$no++;
			$l->isi_lowongan = '<div class="card border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><img src="' . $l->perusahaan_logo . '" style="width:5%;margin-right:25px;">
			<div class="col mr-2"><div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
			' . $l->lowongan_judul . '</div>
			<div class="h6 mb-2 text-gray-800">' . $l->kategori_nama . '</div>
			<div class="h6 mb-2 font-weight-bold text-gray-800"><i class="fas fa-map-marker-alt mr-2"></i>' . $l->kabkota_nama . " - " . $l->prov_nama . '</div>
			<div class="h6 mb-0 font-weight-bold text-gray-800">Dilihat ' . $jml_view->jml . 'x</div>
			</div>
			<div class="col-auto"><a href="' . base_url() . 'job/detail/' . $l->lowongan_id . '" class="btn btn-sm rounded  mr-2 btn-success   item_detail_lowongan" data="' . $l->lowongan_id . '"><i class="fa fa-eye mr-2"></i>Detail</a></div>
			<div class="col-auto"><button type="button" onclick="status_lowongan(' . $l->lowongan_id . ')" class="btn btn-sm rounded mr-2 btn-danger">' . $status . '</button></div>
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
			<div class="h6 mb-2 text-gray-800">' . $resume . '<label class="badge badge-pill badge-success">' . $l->user_telepon . '</label><label class="badge badge-pill badge-success">' . $l->user_email . '</label></div>
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
	{
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

	public function status_lowongan($id)
	{
		$data = $this->db->get_where('tbl_lowongan_pekerjaan', ['lowongan_id' => $id])->row();
		echo json_encode($data);
	}

	public function update_status_lowongan()
	{
		$this->_validate_status();
		$data = array(
			'lowongan_status' => $this->input->post('lowongan_status'),
		);
		$this->db->where('lowongan_id', $this->input->post('id_lowongan'));
		$this->db->update('tbl_lowongan_pekerjaan', $data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate_status()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('lowongan_status') == 1) {
			$premium_user = $this->db->get_where('tbl_langganan_premium', ['user_id' => $this->session->user_id])->row();
			if ($premium_user == false) {
				$perusahaan_id = $this->session->perusahaan_id;
				$cek = $this->db->get_where('tbl_lowongan_pekerjaan', ['perusahaan_id' => $perusahaan_id, 'lowongan_status' => 1])->row();
				if ($cek) {
					$data['inputerror'][] = 'lowongan_status';
					$data['error_string'][] = 'Ada Lowongan aktif yang lain, tidak bisa merubah status silahkan Upgrade ke Akun Premium';
					$data['status'] = FALSE;
				}	# code...
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function premium()
	{
		$user_id = $this->session->user_id;

		$data['premium'] = $this->db->get_where('tbl_premium', ['premium_status' => 1, 'premium_tipe' => 2])->row();
		$data['user_premium'] = $this->db->get_where('tbl_langganan_premium', ['user_id' => $user_id])->row();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('provider/tampilan_premium', $data);
		$this->load->view('templates/footer');
	}

	function payment()
	{
		$id_premium = $this->input->post('id');
		$price = $this->input->post('price') * 12;
		$user_id = $this->session->user_id;

		$data = $this->db->where('premium_id', $id_premium)->get('tbl_premium')->row_array();
		$users = $this->db->query("SELECT tbl_master_user.*,tbl_perusahaan.perusahaan_alamat FROM tbl_master_user LEFT JOIN tbl_perusahaan ON tbl_master_user.perusahaan_id = tbl_perusahaan.perusahaan_id WHERE tbl_master_user.user_id = $user_id")->row_array();
		// echo json_encode($price); die();
		$nama_premium = $data['premium_nama'];
		$items = [
			'name' =>  $nama_premium,
			'price' => (int)$price,
			'quantity' => (int)1,
		];


		$inv_number = 'INV-' . rand(1, 10000);
		$itemsss[] = $items;

		//save to table trasaction course
		// $save_to_sql = [
		// 	'participant_id' => $this->session->userdata('id'),
		// 	'course_id'		=> $id_premium,
		// 	'invoice_number' => $inv_number,
		// 	'tot_price'	=> $price,
		// 	'paid_status' => "1",
		// 	'create_date' => date('Y-m-d H:s:s'),
		// ];

		// $this->db->insert('transaction_course', $save_to_sql);
		// sctipt doku
		$requestBody = [
			'order' => [
				'amount'            => (int)$price,
				'invoice_number'    => $inv_number,
				'currency'          => 'IDR',
				'callback_url'      => base_url('provider/payment_sukses'),
				'line_items'        => $itemsss,
			],
			'payment'               => [
				'payment_due_date'  => 60  //expired pay
			],
			'customer'              => [
				'id'        => 'CUST-' . rand(1, 1000), // Change to your customer ID mapping
				'name'      => $users['user_nama'],
				'email'     => $users['user_email'],
				'phone'     => $users['user_telepon'],
				'address'   => $users['perusahaan_alamat'],
				'country'   => 'ID',
			]
		];

		// echo json_encode($requestBody);die();
		$requestId = rand(1, 100000); // Change to UUID or anything that can generate unique value
		$dateTime = gmdate("Y-m-d H:i:s");
		$isoDateTime = date(DATE_ISO8601, strtotime($dateTime));
		$dateTimeFinal = substr($isoDateTime, 0, 19) . "Z";
		$clientId = 'BRN-0223-1658821341264'; // Change with your Client ID
		$secretKey = 'SK-oCGRoGuyCVTCxno3kf8n'; // Change with your Secret Key

		$getUrl = 'https://api-sandbox.doku.com';

		$targetPath = '/checkout/v1/payment';
		$url = $getUrl . $targetPath;

		// Generate digest
		$digestValue = base64_encode(hash('sha256', json_encode($requestBody), true));

		// Prepare signature component
		$componentSignature = "Client-Id:" . $clientId . "\n" .
			"Request-Id:" . $requestId . "\n" .
			"Request-Timestamp:" . $dateTimeFinal . "\n" .
			"Request-Target:" . $targetPath . "\n" .
			"Digest:" . $digestValue;

		// Generate signature
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));

		// Execute request
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Client-Id:' . $clientId,
			'Request-Id:' . $requestId,
			'Request-Timestamp:' . $dateTimeFinal,
			'Signature:' . "HMACSHA256=" . $signature,
		));

		// Set response json
		$responseJson = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);


		// Echo the response
		if (is_string($responseJson) && $httpCode == 200) {
			$newdata = array(
				'client_id'  	 => $clientId,
				'request_id'     => $requestId,
				'inv_number'	 => $inv_number,
				'digi'			 => $digestValue,
				'ammount'		 => $price,
				'id_premium_prov' => $id_premium
			);

			$this->session->set_userdata($newdata);

			echo $responseJson;
			return json_decode($responseJson, true);
		} else {
			echo $responseJson;
			return null;
		}
	}


	public function get_status()
	{
		$header = array();

		$requestId = $this->session->request_id;
		$targetPath = "/orders/v1/status/" . $this->session->inv_number;
		$dateTime = gmdate("Y-m-d H:i:s");
		$dateTime = date(DATE_ISO8601, strtotime($dateTime));
		$dateTimeFinal = substr($dateTime, 0, 19) . "Z";

		$getUrl = 'https://api-sandbox.doku.com';

		$url = $getUrl . $targetPath;

		$shared_key = 'SK-oCGRoGuyCVTCxno3kf8n';

		$header['Client-Id'] = $this->session->client_id;
		$header['Request-Id'] = $requestId;
		$header['Request-Timestamp'] = $dateTimeFinal;
		$header['Request-Target'] = $targetPath;

		$signature = $this->generateSignatureCheckStatus($header, $shared_key);

		echo $this->session->client_id . '<br/>';
		echo $requestId . '<br/>';
		echo $dateTimeFinal . '<br/>';
		echo $signature . '<br/>';
		echo $url . '<br/>';

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Client-Id: ' . $this->session->client_id,
				'Request-Id: ' . $requestId,
				'Request-Timestamp: ' . $dateTimeFinal,
				'Signature: ' . $signature
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	public function generateSignatureCheckStatus($headers, $secret)
	{
		$rawSignature = "Client-Id:" . $headers['Client-Id'] . "\n"
			. "Request-Id:" . $headers['Request-Id'] . "\n"
			. "Request-Timestamp:" . $headers['Request-Timestamp'] . "\n"
			. "Request-Target:" . $headers['Request-Target'];

		$signature = base64_encode(hash_hmac('sha256', $rawSignature, htmlspecialchars_decode($secret), true));
		return 'HMACSHA256=' . $signature;
	}

	public function payment_sukses()
	{
		$next_date = date('Y-m-d', strtotime("+365 days"));

		$data = array(
			'user_id' => $this->session->user_id,
			'premium_id' => $this->session->id_premium_prov,
			'premium_masa_aktif' => $next_date,
		);

		$this->db->insert('tbl_langganan_premium', $data);
		$insert_id = $this->db->insert_id();

		$data = array(
			'transaksi_inv' => $this->session->inv_number,
			'transaksi_client_id' => $this->session->client_id,
			'transaksi_request_id' => $this->session->request_id,
			'transaksi_ammount' => $this->session->ammount,
			'transaksi_langganan_id' => $insert_id
		);

		$this->db->insert('tbl_transaksi_premium', $data);

		$data['title'] = 'Berhasil';
		$data['text'] = 'Pembayaran berhasil, akun anda sekarang premium';
		$data['icon'] = 'success';
		$this->session->set_flashdata($data);

		redirect('/dashboard', 'refresh');
	}

	public function tabel_premium()
	{
		$this->load->model('Model_user_premium', 'premium');

		$list = $this->premium->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $person->transaksi_inv;
			$row[] = "Rp " . number_format($person->transaksi_ammount, 0, ',', '.');
			$row[] = date('d-M-Y', strtotime($person->premium_masa_aktif));
			$row[] = "<label class='badge bg-danger text-white'>Aktif</label>";
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tnc(' . "'" . $person->langganan_id . "'" . ')"><i class="fas fa-money-bill"></i> Perpanjang</a>
                  ';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->premium->count_all(),
			"recordsFiltered" => $this->premium->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function cek_status_pay()
	{
		$clientId = 'BRN-0223-1658821341264'; // Change with your Client ID
		$secretKey = 'SK-oCGRoGuyCVTCxno3kf8n'; // Change with your Secret Key
		$dateTime = gmdate("Y-m-d H:i:s");
		$isoDateTime = date(DATE_ISO8601, strtotime($dateTime));
		$dateTimeFinal = substr($isoDateTime, 0, 19) . "Z";
		$requestId = $this->session->request_id;
		$inv = $this->session->inv_number;
		$targetPath = "/orders/v1/status/" . $inv;

		// Prepare signature component
		$componentSignature = "Client-Id:" . $clientId . "\n" .
			"Request-Id:" . $requestId . "\n" .
			"Request-Timestamp:" . $dateTimeFinal . "\n" .
			"Request-Target:" . $targetPath;

		// Generate signature
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));


		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api-sandbox.doku.com/orders/v1/status/' . $inv,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Client-Id: ' . $clientId,
				'Request-Id: ' . $requestId,
				'Request-Timestamp: ' . $dateTimeFinal,
				'Signature: ' . $signature
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	public function kebijakan_privasi()
	{
		$data['kp_provider'] = $this->db->get_where('tbl_kebijakan_privasi', ['kp_tipe' => 2])->row();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('provider/kebijakan_privasi', $data);
		$this->load->view('templates/footer');
	}
}
