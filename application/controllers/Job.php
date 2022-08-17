<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Model_query', 'm_query');
	}



	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_job');
		$this->load->view('admin/footer');
	}

	public function bookmark()

	{
		$status = $this->input->post('status');
		$lowongan_id = $this->input->post('job');
		if ($status == 1) {
			$data_save_job = array(
				'user_id' => $this->session->user_id,
				'lowongan_id' => $lowongan_id,
			);
			$result = $this->db->insert('tbl_lowongan_tersimpan', $data_save_job);
		} else {
			$this->db->where('lowongan_id', $lowongan_id);
			$this->db->where('user_id', $this->session->user_id);
			$result = $this->db->delete('tbl_lowongan_tersimpan');
		}

		if ($result) {
			echo json_encode($status);
		} else {
			echo json_encode('Gagal');
		}
	}

	public function simpan_lamaran()
	{
		$lamaran = array(
			'pelamar_id' 		=> $this->session->user_id,
			'lowongan_id' 		=> $this->input->post('lowongan_id'),
			'lamaran_deskripsi' => $this->input->post('lamaran_deskripsi'),
			'lamaran_tanggal'	=> date('Y-m-d H:i:s'),
			'Lamaran_status'		=> "In Review",
		);

		$simpan = $this->db->insert('tbl_pelamar_pekerjaan', $lamaran);

		if ($simpan) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Lamaran Berhasil Dikirim!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Lowongan Gagal Dikirim!';
			$data['icon'] = 'error';
		}

		$this->session->set_flashdata($data);
		redirect('job/detail/' . $this->input->post('lowongan_id'), 'refresh');
	}
	public function simpan_post()
	{
		// cek and tambah kategori
		$this->db->where('kategori_id', $this->input->post('kategori_id'));
		$cek_kategori = $this->db->get('tbl_master_kategori_job')->num_rows();

		if ($cek_kategori > 0) {
			$kategori_id = $this->input->post('kategori_id');
		} else {
			$data_kategori  = array(
				'kategori_nama' => $this->input->post('kategori_id'),
				'kategori_status' => 1,
				'kategori_icon' => 'assets/img/icon_kategori/icon1658301518Vectorre.svg'
			);
			$this->db->insert('tbl_master_kategori_job', $data_kategori);
			$kategori_id = $this->db->insert_id();
		}

		// cek and tambah joblevel
		$this->db->where('joblevel_id', $this->input->post('joblevel_id'));
		$cek_joblevel = $this->db->get('tbl_master_level_job')->num_rows();

		if ($cek_joblevel > 0) {
			$joblevel_id = $this->input->post('joblevel_id');
		} else {

			$data_joblevel  = array(
				'joblevel_nama' => $this->input->post('joblevel_id'),
				'joblevel_status' => 1,
			);
			$this->db->insert('tbl_master_level_job', $data_joblevel);
			$joblevel_id = $this->db->insert_id();
		}

		// cek and tambah jabatan
		$this->db->where('jabatan_id', $this->input->post('jabatan_id'));
		$cek_jabatan = $this->db->get('tbl_master_jabatan')->num_rows();
		if ($cek_jabatan > 0) {
			$jabatan_id = $this->input->post('jabatan_id');
		} else {
			$data_jabatan  = array(
				'jabatan_nama' => $this->input->post('jabatan_id'),
				'jabatan_status' => 1,
			);
			$this->db->insert('tbl_master_jabatan', $data_jabatan);
			$jabatan_id = $this->db->insert_id();
		}


		$data_posting = array(
			'joblevel_id'			=> $joblevel_id,
			'kategori_id' 			=> $kategori_id,
			'perusahaan_id' 		=> $this->session->perusahaan_id,
			'user_id' 				=> $this->session->user_id,
			'jabatan_id' 			=> $jabatan_id,
			'lowongan_judul' 		=> $this->input->post('lowongan_judul'),
			'lowongan_gaji_min' 	=> str_replace('.', '', $this->input->post('lowongan_gaji_min')),
			'lowongan_gaji_max' 	=> str_replace('.', '', $this->input->post('lowongan_gaji_max')),
			'lowongan_gaji_secret' 	=> $this->input->post('rahasiakan'),
			'lowongan_created_date' => date('Y-m-d H:i:s'),
			'lowongan_end_date' 	=> $this->input->post('tanggal_akhir_lowongan'),
			'lowongan_deskripsi' 	=> $this->input->post('lowongan_deskripsi'),
			'lowongan_status' 		=> 1,
		);

		$result = $this->db->insert('tbl_lowongan_pekerjaan', $data_posting);
		$lowongan_id =  $this->db->insert_id();

		if ($result) {
			$skill = $this->input->post('lowongan_skill');
			if ($skill != NULL) {
				for ($i = 0; $i < count($skill); $i++) {
					$this->db->where('skill_id', $skill[$i]);
					$cek_skill = $this->db->get('tbl_master_skill')->num_rows();
					if ($cek_skill > 0) {
						$skill_id = $skill[$i];
					} else {
						$data_skill = array(
							'skill_nama' 	=> $skill[$i],
							'skill_status' 	=> 1,

						);
						$this->db->insert('tbl_master_skill', $data_skill);
						$skill_id = $this->db->insert_id();
					}
					$data_skill_posting = array(
						'lowongan_id' => $lowongan_id,
						'skill_id' => $skill_id,
					);
					$this->db->insert('tbl_lowongan_skill', $data_skill_posting);
				}
			}

			$data['title'] = 'Berhasil';
			$data['text'] = 'Lowongan Pekerjaan Berhasil Diposting!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Lowongan Pekerjaan Gagal Diposting!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('provider/job_posting', 'refresh');
	}

	public function cek_perusahaan()
	{
		$this->db->where('perusahaan_id', $this->input->get('perusahaan_id'));
		$data = $this->db->get('tbl_perusahaan')->result();
		echo json_encode($data);
	}

	public function get_kabkota()
	{
		$this->db->where('prov_id', $this->input->get('prov_id'));
		$data = $this->db->get('tbl_master_kabkota')->result();
		echo json_encode($data);
	}

	public function get_perusahaan()
	{
		$this->db->where('perusahaan_id', $this->input->get('perusahaan_id'));
		$data['perusahaan'] = $this->db->get('tbl_perusahaan')->result();

		$data['provinsi'] = $this->db->get('tbl_master_provinsi')->result();
		$data['kabkota'] = $this->db->get('tbl_master_kabkota')->result();
		echo json_encode($data);
	}




	public function kategori()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_job_kategori');
		$this->load->view('admin/footer');
	}

	public function detail($id)
	{
		$data['stp'] = $this->db->get('tbl_master_stp')->result();

		$this->db->where('pelamar_id', $this->session->user_id);
		$this->db->where('lowongan_id', $id);
		$data['lamaran'] = $this->db->get('tbl_pelamar_pekerjaan')->num_rows();

		$this->db->where('a.lowongan_id', $id);
		$this->db->join('tbl_perusahaan b', 'b.perusahaan_id=a.perusahaan_id');
		$this->db->join('tbl_master_kategori_job c', 'c.kategori_id=a.kategori_id');
		$this->db->join('tbl_master_provinsi d', 'd.prov_id=b.perusahaan_prov');
		$this->db->join('tbl_master_kabkota e', 'e.kabkota_id=b.perusahaan_kabkota');
		$data['lowongan'] = $this->db->get('tbl_lowongan_pekerjaan a')->result();

		$this->db->where('a.lowongan_id', $id);
		$this->db->join('tbl_master_skill b', 'b.skill_id=a.skill_id', 'left');
		$data['skill'] = $this->db->get('tbl_lowongan_skill a')->result();

		$this->db->where('a.lowongan_id', $id);
		$data['applicants'] = $this->db->get('tbl_pelamar_pekerjaan a')->num_rows();

		$this->load->view('web/header', $data);

		$this->load->view('job/tampilan_detail_job', $data);

		$this->load->view('web/script_include', $data);
	}

	public function job_listing()
	{
		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		$data['prov'] = $this->db->order_by('prov_nama', 'asc')->get('tbl_master_provinsi')->result();
		$data['kategori'] = $this->db->get_where('tbl_master_kategori_job', ['kategori_status' => 1])->result();

		$this->load->view('web/header', $data);
		$this->load->view('job/tampilan_job_listing', $data);
		$this->load->view('web/script_include', $data);
	}

	public function level()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_job_level');
		$this->load->view('admin/footer');
	}

	public function simpan()
	{
		$data_job = array(
			'job_nama' => $this->input->post('job_nama'),
			'job_status' => 1,
		);

		$result = $this->db->insert('tbl_master_job', $data_job);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Data job Baru " . $this->input->post('job_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'job Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'job Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('job', 'refresh');
	}

	public function ubah()
	{
		$data_job = array(
			'job_nama' => $this->input->post('job_nama'),
		);
		$this->db->where('job_id', $this->input->post('job_id'));
		$result = $this->db->update('tbl_master_job', $data_job);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Data job " . $this->input->post('job_nama'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data job Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Data job Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('job', 'refresh');
	}


	public function simpan_kategori()
	{
		if (!is_dir('assets/img/icon_kategori/')) {
			mkdir('assets/img/icon_kategori/');
		}


		$icon = '';

		if ($_FILES['lampiran_kategori']['name'] != '') {
			$filename = trim($_FILES['lampiran_kategori']['name']);
			$location = 'assets/img/icon_kategori/icon' . time() . $filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif", "svg");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_kategori']['tmp_name'], $location)) {
					$icon = $location;
				}
			}
		}

		$data_kategori = array(
			'kategori_nama' => $this->input->post('kategori_nama'),
			'kategori_status' => 1,
			'kategori_icon' => $icon,
		);
		$result = $this->db->insert('tbl_master_kategori_job', $data_kategori);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Data Kategori Pekerjaan Baru dengan nama " . $this->input->post('kategori_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Kategori Pekerjaan Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Kategori Pekerjaan Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('job/kategori', 'refresh');
	}




	public function ubah_kategori()
	{
		if (!is_dir('assets/img/icon_kategori/')) {
			mkdir('assets/img/icon_kategori/');
		}


		$icon = $this->input->post('lampiran_kategori_lama');

		if ($_FILES['lampiran_kategori']['name'] != '') {
			$filename = trim($_FILES['lampiran_kategori']['name']);
			$location = 'assets/img/icon_kategori/icon' . time() . $filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif", "svg");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_kategori']['tmp_name'], $location)) {
					$icon = $location;
				}
			}
		}

		$data_kategori = array(
			'kategori_nama' => $this->input->post('kategori_nama'),
			'kategori_icon' => $icon,
		);
		$this->db->where('kategori_id', $this->input->post('kategori_id'));
		$result = $this->db->update('tbl_master_kategori_job', $data_kategori);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Data Kategori Pekerjaan dengan nama " . $this->input->post('kategori_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Kategori Pekerjaan Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Kategori Pekerjaan Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('job/kategori', 'refresh');
	}


	public function simpan_level()
	{
		$data_level = array(
			'joblevel_nama' => $this->input->post('joblevel_nama'),
			'joblevel_status' => 1,
		);
		$result = $this->db->insert('tbl_master_level_job', $data_level);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Data Level Pekerjaan Baru dengan nama " . $this->input->post('joblevel_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level Pekerjaan Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Level Pekerjaan Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('job/level', 'refresh');
	}

	public function ubah_level()
	{
		$data_level = array(
			'joblevel_nama' => $this->input->post('joblevel_nama'),
		);
		$this->db->where('joblevel_id', $this->input->post('joblevel_id'));
		$result = $this->db->update('tbl_master_level_job', $data_level);
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->id_user,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Data Level Pekerjaan dengan nama " . $this->input->post('joblevel_nama'),
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Level Pekerjaan Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Level Pekerjaan Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('job/level', 'refresh');
	}




	public function tabel_job()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'job_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job', $sort, $order, $search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi = '
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job" data="' . $l->job_id . '"><i class="fa fa-edit"></i></a>';


			if ($l->job_status == 1) {
				$opsi .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job" data="' . $l->job_id . '"><i class="fa fa-times-circle"></i></a>';
			} else {
				$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job" data="' . $l->job_id . '"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .= '</div>';

			$l->opsi = $opsi;

			if ($l->job_status > 0) {
				$l->job_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			} else {
				$l->job_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}



	public function tabel_job_kategori()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'kategori_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job_kategori', $sort, $order, $search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi = '
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job_kategori" data="' . $l->kategori_id . '"><i class="fa fa-edit"></i></a>';


			if ($l->kategori_status == 1) {
				$opsi .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job_kategori" data="' . $l->kategori_id . '"><i class="fa fa-times-circle"></i></a>';
			} else {
				$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job_kategori" data="' . $l->kategori_id . '"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .= '</div>';

			$l->opsi = $opsi;

			if ($l->kategori_status > 0) {
				$l->kategori_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			} else {
				$l->kategori_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}

			if ($l->kategori_icon != '') {
				$l->kategori_icon = '<img src="' . base_url() . $l->kategori_icon . '" width="50px">';
			}

			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job_kategori', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job_kategori', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}




	public function tabel_job_level()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'joblevel_nama';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('job_level', $sort, $order, $search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi = '
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success   item_edit_job_level" data="' . $l->joblevel_id . '"><i class="fa fa-edit"></i></a>';


			if ($l->joblevel_status == 1) {
				$opsi .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_job_level" data="' . $l->joblevel_id . '"><i class="fa fa-times-circle"></i></a>';
			} else {
				$opsi .= '<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_job_level" data="' . $l->joblevel_id . '"><i class="fa fa-check-circle"></i></a>';
			}


			$opsi .= '</div>';

			$l->opsi = $opsi;

			if ($l->joblevel_status > 0) {
				$l->joblevel_status = '<button type="button" class="btn btn-success btn-sm btn-round ">Aktif</button>';
			} else {
				$l->joblevel_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Non Aktif</button>';
			}



			$data[] = $l;
		}



		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('job_level', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('job_level', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);
	}


	public function detail_job()
	{
		$this->db->where('job_id', $this->input->get('job_id'));
		$data = $this->db->get('tbl_master_job')->result();
		echo json_encode($data);
	}
	public function detail_kategori()
	{
		$this->db->where('kategori_id', $this->input->get('kategori_id'));
		$data = $this->db->get('tbl_master_kategori_job')->result();
		echo json_encode($data);
	}

	public function detail_level()
	{
		$this->db->where('joblevel_id', $this->input->get('joblevel_id'));
		$data = $this->db->get('tbl_master_level_job')->result();
		echo json_encode($data);
	}
	public function aktivasi()
	{
		$this->db->set('job_status', $this->input->post('isi'));
		$this->db->where('job_id', $this->input->post('kode'));
		$data = $this->db->update('tbl_master_job');
		echo json_encode($data);
	}
	public function aktivasi_kategori()
	{
		$this->db->set('kategori_status', $this->input->post('isi'));
		$this->db->where('kategori_id', $this->input->post('kode'));
		$data = $this->db->update('tbl_master_kategori_job');
		echo json_encode($data);
	}

	public function tabel_lowongan()
	{
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'lowongan_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']) : null;
		$no = $this->input->get('start');
		$list = $this->model_tabel->get_datatables('lowongan_pekerjaan', $sort, $order, $search);
		foreach ($list as $l) {
			$no++;

				if ($l->lowongan_gaji_max > 0) {
				$gaji = 'Rp ' . number_format($l->lowongan_gaji_min, 0, ',', '.')  . ' - Rp ' . number_format($l->lowongan_gaji_max, 0, ',', '.');
			} else {
				if ($l->lowongan_gaji_min > 0) {
				$gaji = 'Rp ' . number_format($l->lowongan_gaji_min, 0, ',', '.');
				}
				else
				{
					$gaji = 'Gaji Dirahasiakan';
				}
			}

			$l->isi_lowongan = '<div class="single-job-items mb-20">
                 <div class="job-items">
                   <div class="company-img">
                     <a href="#"><img src="' . $l->perusahaan_logo . '" alt="" /></a>
                   </div>
                   <div class="job-tittle job-tittle2">
                     <a href="#">
                       <h4>' . $l->lowongan_judul . '</h4>
                     </a>
                     <ul>
                       <li>' . $l->kategori_nama . '</li>
                       <li>
                         <i class="fas fa-map-marker-alt"></i>' . $l->kabkota_nama . ' - ' .  $l->prov_nama . '
                       </li>
                     </ul>
                     <br>
					 <h6>' . $gaji . '</h6>
                     <br>
					 
					 <label>' . date('d-M-Y H:i:s', strtotime($l->lowongan_created_date)) . '</label>
                   </div>
                 </div>
                 <div class="items-link items-link2 f-right">
                   <a href="' . base_url('job/detail/') . $l->lowongan_id . '">Detail</a>
                 </div>
               </div>
            ';
			$l->no = $no;
			$data[] = $l;
		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('lowongan_pekerjaan', $sort, $order, $search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('lowongan_pekerjaan', $sort, $order, $search),
			"data"              => $data,
		);
		echo json_encode($output);

		$array_items = array('kategori_job', 'prov_job', 'kota_job', 'dari_gaji_job', 'ke_gaji_job', 'nama_lowongan', 'sort_by');

		$this->session->unset_userdata($array_items);
	}

	public function ambil_data_kota()
	{
		if ($this->input->is_ajax_request()) {
			$id    = $this->input->post('id');
			$modul = $this->input->post('modul');
			if ($modul == 'kota') {
				echo $this->m_query->get_kota($id);
			}
		} else {
			redirect("_404", "refresh");
		}
	}

	public function filter_lowongan()
	{
		$newdata = array(
			'kategori_job'  => $this->input->post('kategori_id'),
			'prov_job'  => $this->input->post('id_prov'),
			'kota_job'  => $this->input->post('id_kabkota'),
			'dari_gaji_job'  => $this->input->post('dari_gaji'),
			'ke_gaji_job'  => $this->input->post('ke_gaji'),
		);

		$this->session->set_userdata($newdata);
		echo json_encode(['status' => true]);
	}

	public function cari_job()
	{
		$newdata = array(
			'kota_job'  => $this->input->post('id_kota_cari'),
			'nama_lowongan'  => $this->input->post('nama_lowongan'),
		);

		$this->session->set_userdata($newdata);
		echo json_encode(['status' => true]);
	}

	public function ambil_data_sortby()
	{
		$sort_by = $this->input->post('id');
		$newdata = array(
			'sort_by'  => $sort_by,
		);

		$this->session->set_userdata($newdata);
		echo json_encode(['status' => true]);
	}
}
