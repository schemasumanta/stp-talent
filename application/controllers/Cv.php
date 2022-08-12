<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cv extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') == FALSE) {
			redirect('landing/login', 'refresh');
		}
		date_default_timezone_set('Asia/Jakarta');
	}


	public function index()
	{
		$this->db->select('a.resume_about');
		$this->db->where('a.user_id', $this->session->user_id);
		$data['about'] = $this->db->get('tbl_resume a')->result();
		$this->db->where('a.user_id', $this->session->user_id);
		$this->db->join('tbl_master_agama b', 'b.agama_id=a.agama_id', 'left');
		$this->db->join('tbl_master_pendidikan c', 'c.pendidikan_id=a.pendidikan_id', 'left');
		$data['resume'] = $this->db->get('tbl_resume a')->result();

		$this->db->where('a.user_id', $this->session->user_id);
		$data['upload_resume'] = $this->db->get('tbl_resume_lampiran a')->result();

		$this->db->where('pendidikan_status', 1);
		$data['pendidikan'] = $this->db->get('tbl_master_pendidikan')->result();

		$this->db->where('a.user_id', $this->session->user_id);
		$this->db->join('tbl_perusahaan b', 'b.perusahaan_id=a.perusahaan_id');
		$this->db->join('tbl_master_level_job c', 'c.joblevel_id=a.joblevel_id');
		$this->db->join('tbl_master_jabatan d', 'd.jabatan_id=a.jabatan_id');
		$this->db->order_by('a.pengalaman_tanggal_awal', 'asc');
		$data['pengalaman'] = $this->db->get('tbl_pengalaman_resume a')->result();
		$this->db->where('a.user_id', $this->session->user_id);
		$this->db->join('tbl_master_skill b', 'b.skill_id=a.skill_id');
		$this->db->join('tbl_skill_level c', 'c.skill_level_id=a.skill_level_id');
		$data['skill_resume'] = $this->db->get('tbl_skill_resume a')->result();


		$this->db->where('a.user_id', $this->session->user_id);
		$this->db->join('tbl_master_bahasa b', 'b.bahasa_id=a.bahasa_id');
		$data['bahasa_resume'] = $this->db->get('tbl_bahasa_resume a')->result();

		$this->db->where('agama_status', 1);
		$data['agama'] = $this->db->get('tbl_master_agama')->result();

		$this->db->where('jabatan_status', 1);
		$data['jabatan'] = $this->db->get('tbl_master_jabatan')->result();

		$this->db->where('joblevel_status', 1);
		$data['joblevel'] = $this->db->get('tbl_master_level_job')->result();


		$this->db->where('skill_status', 1);
		$data['skill'] = $this->db->get('tbl_master_skill')->result();

		$this->db->where('bahasa_status', 1);
		$data['bahasa'] = $this->db->get('tbl_master_bahasa')->result();


		$this->db->where('skill_level_status', 1);
		$data['skill_level'] = $this->db->get('tbl_skill_level')->result();

		$data['provinsi'] = $this->db->get('tbl_master_provinsi')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('seeker/tampilan_cv', $data);
		$this->load->view('templates/footer');
	}

	public function get_pengalaman()
	{
		$this->db->where('pengalaman_id', $this->input->get('pengalaman_id'));
		$data['pengalaman'] = $this->db->get('tbl_pengalaman_resume')->result();

		foreach ($data['pengalaman'] as $key) {
			$this->db->select('perusahaan_id,perusahaan_nama');
			$this->db->where('perusahaan_id', $key->perusahaan_id);
			$data['perusahaan'] = $this->db->get('tbl_perusahaan')->result();
		}
		echo json_encode($data);
	}

	public function get_list_perusahaan()
	{
		$json = [];
		if (!empty($this->input->get("q"))) {
			$this->db->like('perusahaan_nama', $this->input->get("q"));
			$query = $this->db->select('perusahaan_id as id,perusahaan_nama as text')
				->limit(10)
				->get("tbl_perusahaan");
			$json = $query->result();
		}
		echo json_encode($json);
	}



	public function get_skill_resume()
	{
		$this->db->where('user_id', $this->session->user_id);
		$data = $this->db->get('tbl_skill_resume')->result();
		echo json_encode($data);
	}


	public function get_bahasa_resume()
	{
		$this->db->where('user_id', $this->session->user_id);
		$data = $this->db->get('tbl_bahasa_resume')->result();
		echo json_encode($data);
	}




	public function simpan_skill()
	{

		$skill = $this->input->post('skill_id');
		$level = $this->input->post('skill_level_id');
		$cek = 0;
		for ($i = 0; $i < count($skill); $i++) {
			$this->db->where('skill_id', $skill[$i]);
			$cek = $this->db->get('tbl_master_skill')->num_rows();
			if ($cek == 0) {
				$data_skill = array(
					'skill_nama' => $skill,
					'skill_status' => 1,

				);
				$this->db->insert('tbl_master_skill', $data_skill);
				$skill_id = $this->db->insert_id();
			} else {
				$skill_id = $skill[$i];
			}

			$data_skill_resume = array(
				'skill_id' => $skill_id,
				'skill_level_id' => $level[$i],
				'user_id' => $this->session->user_id,
			);
			$this->db->insert('tbl_skill_resume', $data_skill_resume);
			$cek++;
		}
		if ($cek > 0) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Skill",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Skill Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Skill Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function simpan_bahasa()
	{

		$bahasa = $this->input->post('bahasa_id');
		$level = $this->input->post('bahasa_level');
		$cek = 0;

		for ($i = 0; $i < count($bahasa); $i++) {

			$this->db->where('bahasa_id', $bahasa[$i]);

			$cek = $this->db->get('tbl_master_bahasa')->num_rows();

			if ($cek == 0) {

				$data_bahasa = array(
					'bahasa_nama' => $bahasa,
					'bahasa_status' => 1,
				);
				$this->db->insert('tbl_master_bahasa', $data_bahasa);
				$bahasa_id = $this->db->insert_id();
			} else {
				$bahasa_id = $bahasa[$i];
			}

			$data_bahasa_resume = array(
				'bahasa_id' 			=> $bahasa_id,
				'resume_bahasa_level' 	=> $level[$i],
				'user_id' 				=> $this->session->user_id,
			);
			$this->db->insert('tbl_bahasa_resume', $data_bahasa_resume);
			$cek++;
		}
		if ($cek > 0) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Bahasa",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Bahasa Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Bahasa Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function simpan_pengalaman()
	{

		$jabatan = $this->input->post('jabatan_id');
		$this->db->where('jabatan_id', $jabatan);
		$cek = $this->db->get('tbl_master_jabatan')->num_rows();
		if ($cek == 0) {

			$data_jabatan = array(
				'jabatan_nama' => $jabatan,
				'jabatan_status' => 1,

			);
			$this->db->insert('tbl_master_jabatan', $data_jabatan);
			$jabatan_id = $this->db->insert_id();
		} else {
			$jabatan_id = $jabatan;
		}

		$perusahaan = $this->input->post('perusahaan_id');
		$this->db->where('perusahaan_id', $perusahaan);
		$cek = $this->db->get('tbl_perusahaan')->num_rows();
		if ($cek == 0) {

			$data_perusahaan = array(
				'perusahaan_nama' => $perusahaan,
			);

			$this->db->insert('tbl_perusahaan', $data_perusahaan);
			$perusahaan_id = $this->db->insert_id();
		} else {
			$perusahaan_id = $perusahaan;
		}

		$data_pengalaman_resume = array(
			'user_id' 					=> $this->session->user_id,
			'perusahaan_id' 			=> $perusahaan_id,
			'joblevel_id' 				=> $this->input->post('joblevel_id'),
			'pengalaman_deskripsi' 		=> $this->input->post('pengalaman_deskripsi'),
			'jabatan_id' 				=> $jabatan_id,
			'pengalaman_tanggal_awal' 	=> $this->input->post('pengalaman_tanggal_awal'),
			'pengalaman_tanggal_akhir' 	=> $this->input->post('pengalaman_tanggal_akhir'),
			'masih_bekerja' 			=> $this->input->post('masih_bekerja'),
		);
		$result = $this->db->insert('tbl_pengalaman_resume', $data_pengalaman_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Data Pengalaman",
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pengalaman Kerja Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pengalaman Kerja Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function simpan_about()
	{

		$resume_about = $this->input->post('resume_about');
		$this->db->where('user_id', $this->session->user_id);
		$cek = $this->db->get('tbl_resume')->num_rows();
		if ($cek == 0) {
			$data_resume = array(
				'user_id' => $this->session->user_id,
				'resume_about' => $resume_about,
			);
			$result = $this->db->insert('tbl_resume', $data_resume);
		} else {
			$data_resume = array(
				'resume_about' => $resume_about,
			);
			$this->db->where('user_id', $this->session->user_id);
			$result = $this->db->update('tbl_resume', $data_resume);
		}

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Data Tentang Saya",
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Deskripsi Tentang Anda Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Deskripsi Tentang Anda Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function ubah_pengalaman()
	{

		$jabatan = $this->input->post('jabatan_id');
		$this->db->where('jabatan_id', $jabatan);
		$cek = $this->db->get('tbl_master_jabatan')->num_rows();
		if ($cek == 0) {
			$data_jabatan = array(
				'jabatan_nama' => $jabatan,
				'jabatan_status' => 1,

			);
			$this->db->insert('tbl_master_jabatan', $data_jabatan);
			$jabatan_id = $this->db->insert_id();
		} else {
			$jabatan_id = $jabatan;
		}

		$perusahaan = $this->input->post('perusahaan_id');
		$this->db->where('perusahaan_id', $perusahaan);
		$cek = $this->db->get('tbl_perusahaan')->num_rows();
		if ($cek == 0) {

			$data_perusahaan = array(
				'perusahaan_nama' => $perusahaan,
			);

			$this->db->insert('tbl_perusahaan', $data_perusahaan);
			$perusahaan_id = $this->db->insert_id();
		} else {
			$perusahaan_id = $perusahaan;
		}

		$data_pengalaman_resume = array(
			'perusahaan_id' 			=> $perusahaan_id,
			'joblevel_id' 				=> $this->input->post('joblevel_id'),
			'pengalaman_deskripsi' 		=> $this->input->post('pengalaman_deskripsi'),
			'jabatan_id' 				=> $jabatan_id,
			'pengalaman_tanggal_awal' 	=> $this->input->post('pengalaman_tanggal_awal'),
			'pengalaman_tanggal_akhir' 	=> $this->input->post('pengalaman_tanggal_akhir'),
			'masih_bekerja' 			=> $this->input->post('masih_bekerja'),
		);
		$this->db->where('pengalaman_id', $this->input->post('pengalaman_id'));
		$result = $this->db->update('tbl_pengalaman_resume', $data_pengalaman_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Data Pengalaman",
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pengalaman Kerja Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pengalaman Kerja Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function hapus_pengalaman()
	{
		$this->db->where('pengalaman_id', $this->input->post('pengalaman_id_hapus'));
		$result = $this->db->delete('tbl_pengalaman_resume');
		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menghapus Data Pengalaman",
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pengalaman Kerja Berhasil Dihapus!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pengalaman Kerja Gagal Dihapus!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}
	public function ubah_skill()
	{
		$this->db->where('user_id', $this->session->user_id);
		$this->db->delete('tbl_skill_resume');

		$skill = $this->input->post('skill_id');
		$level = $this->input->post('skill_level_id');
		$cek = 0;
		for ($i = 0; $i < count($skill); $i++) {
			$this->db->where('skill_id', $skill[$i]);
			$cek = $this->db->get('tbl_master_skill')->num_rows();
			if ($cek == 0) {
				$data_skill = array(
					'skill_nama' => $skill,
					'skill_status' => 1,

				);
				$this->db->insert('tbl_master_skill', $data_skill);
				$skill_id = $this->db->insert_id();
			} else {
				$skill_id = $skill[$i];
			}

			$data_skill_resume = array(
				'skill_id' => $skill_id,
				'skill_level_id' => $level[$i],
				'user_id' => $this->session->user_id,
			);
			$this->db->insert('tbl_skill_resume', $data_skill_resume);
			$cek++;
		}
		if ($cek > 0) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Skill",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Skill Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Skill Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function ubah_bahasa()
	{
		$this->db->where('user_id', $this->session->user_id);
		$this->db->delete('tbl_bahasa_resume');

		$bahasa = $this->input->post('bahasa_id');
		$level = $this->input->post('bahasa_level');
		$cek = 0;
		for ($i = 0; $i < count($bahasa); $i++) {
			$this->db->where('bahasa_id', $bahasa[$i]);
			$cek = $this->db->get('tbl_master_bahasa')->num_rows();
			if ($cek == 0) {
				$data_bahasa = array(
					'bahasa_nama' => $bahasa,
					'bahasa_status' => 1,

				);
				$this->db->insert('tbl_master_bahasa', $data_bahasa);
				$bahasa_id = $this->db->insert_id();
			} else {
				$bahasa_id = $bahasa[$i];
			}

			$data_bahasa_resume = array(
				'bahasa_id' 			=> $bahasa_id,
				'resume_bahasa_level' 	=> $level[$i],
				'user_id' 				=> $this->session->user_id,
			);
			$this->db->insert('tbl_bahasa_resume', $data_bahasa_resume);
			$cek++;
		}
		if ($cek > 0) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Bahasa",
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Bahasa Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Bahasa Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function upload_resume()
	{
		$this->db->where('user_id',  $this->session->user_id);
		$this->db->delete('tbl_resume_lampiran');
		$data_upload = array(
			'resume_lampiran' => $this->input->post('lampiran_cv'),
			'user_id' => $this->session->user_id,
			'lampiran_created_date' => date('Y-m-d H:i:s')
		);
		$result = $this->db->insert('tbl_resume_lampiran', $data_upload);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengupload CV ",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'CV Berhasil Diupload!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'CV Gagal Diupload!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}
	public function generate_cv($id)
	{
		$this->db->where('a.user_id', $id);
		$this->db->join('tbl_master_user b', 'b.user_id=a.user_id');
		$this->db->join('tbl_master_agama c', 'c.agama_id=a.agama_id');
		$this->db->join('tbl_master_provinsi d', 'd.prov_id=a.prov_id');
		$this->db->join('tbl_master_kabkota e', 'e.kabkota_id=a.kabkota_id');
		$data['resume']	= $this->db->get('tbl_resume a')->result();
		$this->db->where('a.user_id', $id);
		$this->db->join('tbl_master_skill b', 'b.skill_id=a.skill_id');
		$this->db->join('tbl_skill_level c', 'c.skill_level_id=a.skill_level_id');
		$data['skill']	= $this->db->get('tbl_skill_resume a')->result();
		$data['pengalaman']	= $this->db->query("SELECT tbl_pengalaman_resume.*,perusahaan_nama,jabatan_nama FROM tbl_pengalaman_resume JOIN tbl_perusahaan ON tbl_pengalaman_resume.perusahaan_id = tbl_perusahaan.perusahaan_id JOIN tbl_master_jabatan ON tbl_master_jabatan.jabatan_id = tbl_pengalaman_resume.jabatan_id WHERE tbl_pengalaman_resume.user_id = '$id'")->result();
		$this->load->library('dompdf_gen');
		$this->load->view('seeker/generate_cv', $data);
		$customPaper = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->load->library('pdfgenerator');
		$this->pdfgenerator->generate_view($html, strtoupper("CV " . $id), TRUE, $customPaper, $orientation);
	}

	public function simpan_resume()
	{
		$data_resume = array(
			'user_id' => $this->session->user_id,
			'pendidikan_id' => $this->input->post('pendidikan_id'),
			'prov_id' => $this->input->post('resume_prov'),
			'kabkota_id' => $this->input->post('resume_kabkota'),
			'agama_id' => $this->input->post('resume_agama'),
			'resume_nama_pendidikan_terakhir' => $this->input->post('resume_nama_pendidikan_terakhir'),
			'resume_pendidikan_tahun_lulus' => $this->input->post('resume_pendidikan_tahun_lulus'),
			'resume_nama_lengkap' => $this->input->post('resume_nama_lengkap'),
			'resume_foto' => $this->input->post('lampiran_pas_photo_lama'),
			'resume_nik' => $this->input->post('resume_nik'),
			'resume_alamat_lengkap' => $this->input->post('resume_alamat'),
			'resume_jenis_kelamin' => $this->input->post('resume_jenis_kelamin'),
			'resume_tempat_lahir' => $this->input->post('resume_tempat_lahir'),
			'resume_tanggal_lahir' => $this->input->post('resume_tanggal_lahir'),
			'resume_created_date' => date('Y-m-d H:i:s'),
		);

		$result = $this->db->insert('tbl_resume', $data_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Menambah Biodata " . $this->input->post('resume_nama_lengkap'),
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Biodata Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Biodata Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}


	public function ubah_resume()
	{
		$data_resume = array(
			'pendidikan_id' => $this->input->post('pendidikan_id'),
			'prov_id' => $this->input->post('resume_prov'),
			'kabkota_id' => $this->input->post('resume_kabkota'),
			'agama_id' => $this->input->post('resume_agama'),
			'resume_nama_pendidikan_terakhir' => $this->input->post('resume_nama_pendidikan_terakhir'),
			'resume_pendidikan_tahun_lulus' => $this->input->post('resume_pendidikan_tahun_lulus'),
			'resume_nama_lengkap' => $this->input->post('resume_nama_lengkap'),
			'resume_foto' => $this->input->post('lampiran_pas_photo_lama'),
			'resume_nik' => $this->input->post('resume_nik'),
			'resume_alamat_lengkap' => $this->input->post('resume_alamat'),
			'resume_jenis_kelamin' => $this->input->post('resume_jenis_kelamin'),
			'resume_tempat_lahir' => $this->input->post('resume_tempat_lahir'),
			'resume_tanggal_lahir' => $this->input->post('resume_tanggal_lahir'),
		);
		$this->db->where('resume_id', $this->input->post('resume_id'));
		$result = $this->db->update('tbl_resume', $data_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id,
				'ip_address' => get_ip(),
				'aktivitas' => "Mengubah Biodata " . $this->input->post('resume_nama_lengkap'),
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Biodata Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {

			$data['title'] = 'Gagal';
			$data['text'] = 'Biodata Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('cv', 'refresh');
	}
}
