<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seeker extends CI_Controller
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
			$this->load->view('seeker/tampilan_login', $data);
			$this->load->view('web/script_include', $data);
		} else {
			redirect('seeker/dashboard', 'refresh');
		}
	}

	public function cek_email()
	{
		$this->db->where('user_email', $this->input->get('seeker_email'));
		$data = $this->db->get('tbl_master_user')->num_rows();
		echo json_encode($data);
	}

	public function hapus_bookmark()
	{
		$this->db->where('lowongan_tersimpan_id', $this->input->post('lowongan_tersimpan_id_hapus'));
		$result = $this->db->delete('tbl_lowongan_tersimpan');
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Bookmark Berhasil Dihapus!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Bookmark Gagal Dihapus!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('seeker/saved_job', 'refresh');
	}

	public function get_resume()
	{
		$this->db->where('a.user_id', $this->session->user_id);

		$data = $this->db->get('tbl_resume a')->result();
		echo json_encode($data);
	}

	public function kirim_email($id_user, $email, $password)
	{
		$data['id_user'] = $id_user;
		$data['email'] = $email;
		$data['password'] = $password;
		$content = $this->load->view('seeker/body_email', $data, true);
		return $content;
	}

	public function getkabkota()
	{
		$this->db->where('prov_id', $this->input->get('prov_id'));
		$data = $this->db->get('tbl_master_kabkota')->result();
		echo json_encode($data);
	}

	public function aktivasi($token)
	{

		$this->db->where('token_isi', $token);
		$data_token = $this->db->get('tbl_token');
		if ($data_token->num_rows() > 0) {
			foreach ($data_token->result() as $key) {
				$tanggal = date('Y-m-d H:i:s');
				if ($key->token_expired_date < $tanggal) {
					$data['title'] = 'Error';
					$data['text'] = 'Link Expired!';
					$data['icon'] = 'error';
					$this->session->set_flashdata($data);
					redirect('landing/login', 'refresh');
				} else {
					$this->db->where('user_id', $key->user_id);
					$result = $this->db->update('tbl_master_user', array('user_status' => 1));
					if ($result) {
						$this->db->where('token_isi', $key->token_isi);
						$result = $this->db->delete('tbl_token');
						$data['title'] = 'Aktivasi Berhasil';
						$data['text'] = 'Silahkan Login!';
						$data['icon'] = 'success';
						$this->session->set_flashdata($data);
						redirect('landing/login', 'refresh');
					}
				}
			}
		} else {
			$data['title'] = 'Error';
			$data['text'] = 'Link Tidak Valid!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
			redirect('landing/login', 'refresh');
		}
	}
	public function simpan_pendaftaran()
	{
		$foto = 'assets_admin/img/profile.svg';
		$data_seeker = array(
			'user_level' 			=> 2,
			'user_nama' 			=> $this->input->post('seeker_nama'),
			'user_telepon' 			=> $this->input->post('seeker_telepon'),
			'user_password' 		=> md5($this->input->post('seeker_password')),
			'user_email' 			=> $this->input->post('seeker_email'),
			'user_status'			=> 0,
			'user_foto' 			=> $foto,
			'user_created_date' 	=> date('Y-m-d H:i:s'),
		);

		$result = $this->db->insert('tbl_master_user', $data_seeker);
		if ($result) {

			$this->db->where('user_nama', $this->input->post('seeker_nama'));
			$this->db->where('user_level', 2);
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

		$this->session->set_flashdata($data);
		redirect('landing/register', 'refresh');
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

	public function cek_login()
	{
		$job = $this->uri->segment(3);
		$email = $this->input->post('seeker_email');
		$password = md5($this->input->post('seeker_password'));
		$cek = $this->model_query->cek_seeker($email, $password)->result();
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
					$data['login'] = TRUE;
					$this->session->set_userdata($data);

					$data = array(

						'user_login_status' => "1",
					);

					$this->db->where('user_id', $a->user_id);
					$this->db->update('tbl_master_user', $data);
					if ($job > 0) {
						redirect('job/detail/' . $job, 'refresh');
					}
					redirect('dashboard', 'refresh');
				} else {

					$data['title'] = 'Login Gagal';
					$data['text'] = 'User Belum Diaktivasi!';
					$data['icon'] = 'error';
					$this->session->set_flashdata($data);
					redirect('landing/login/' . $job, 'refresh');
				}
			}
		} else {
			$data['title'] = 'Login Gagal';
			$data['text'] = 'Silahkan Periksa Email & Password!';
			$data['icon'] = 'error';
			$this->session->set_flashdata($data);
			redirect('landing/login/' . $job, 'refresh');
		}
	}

	public function saved_job()
	{
		$this->db->where('slider_tipe', 'main');
		$this->db->where('slider_status', 1);
		$data['slider_main'] = $this->db->get('tbl_master_slider')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('seeker/saved_job', $data);
		$this->load->view('templates/footer');
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

	public function tabel_saved_job()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'lowongan_tersimpan_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('lowongan_tersimpan', $sort, $order, $search);
		foreach ($list as $l) {

			$no++;
			$l->isi_lowongan = '<div class="card border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><img src="' . $l->perusahaan_logo . '" style="width:5%;margin-right:25px;">
			<div class="col mr-2"><div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
			' . $l->lowongan_judul . '</div>
			<div class="h6 mb-2 text-gray-800">' . $l->kategori_nama . '</div>
			<div class="h6 mb-0 font-weight-bold text-gray-800"><i class="fas fa-map-marker-alt mr-2"></i>' . $l->kabkota_nama . " - " . $l->prov_nama . '</li></div>
			</div><div class="col-auto"><a href="' . base_url() . 'job/detail/' . $l->lowongan_id . '" class="btn btn-sm rounded  mr-2 btn-success   item_detail_lowongan" data="' . $l->lowongan_tersimpan_id . '"><i class="fa fa-eye mr-2"></i>Detail</a><a href="javascript:;" class="btn btn-sm rounded btn-danger item_hapus_lowongan" data="' . $l->lowongan_tersimpan_id . '"><i class="fa fa-trash"></i></a></div>
			</div></div></div>';
			$l->no = $no;
			$data[] = $l;
		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('lowongan_tersimpan', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('lowongan_tersimpan', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function application()
	{
		$this->db->where('slider_tipe', 'main');
		$this->db->where('slider_status', 1);
		$data['slider_main'] = $this->db->get('tbl_master_slider')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('seeker/application', $data);
		$this->load->view('templates/footer');
	}

	public function tabel_application()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'lamaran_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('application', $sort, $order, $search);
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


			$l->isi_lowongan = '<div class="card border-left-success shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><img src="' . $l->perusahaan_logo . '" style="width:5%;margin-right:25px;">
			<div class="col mr-2"><div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
			' . $l->lowongan_judul . '</div>
			<div class="h6 mb-2 text-gray-800">' . $l->kategori_nama . '</div>
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
				<li class="p-2"><a href="' . base_url() . 'job/detail/' . $l->lowongan_id . '" class="btn btn-lg rounded mr-2 btn-success shadow item_detail_lowongan" data="' . $l->lamaran_id . '"><i class="fa fa-eye mr-2"></i>Detail</a>
				</li>
				<li class="p-2"><a href="' . base_url() . 'chat/' . $l->perusahaan_id . '" class="btn btn-lg rounded  mr-2 btn text-danger shadow item_chat" data="' . $l->perusahaan_id . '"><i class="fas fa-fw fa-comment mr-2"></i>Chat &nbsp;</a>
				</li>
			</ul>				
			</div>
			</div></div></div>';
			$l->no = $no;
			$data[] = $l;
		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('application', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('application', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}
}
