<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') == FALSE) {
			redirect('landing', 'refresh');
		}
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->session->user_level == 1) {
			$data['job_posting'] = $this->db->get('tbl_lowongan_pekerjaan')->num_rows();

			$this->db->where('a.user_level', 2);
			$this->db->where('a.user_status', 1);
			$data['seeker'] = $this->db->get('tbl_master_user a')->num_rows();

			$this->db->where('a.user_level', 3);
			$this->db->where('a.user_status', 1);
			$data['provider'] = $this->db->get('tbl_master_user a')->num_rows();

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar', $data);
			$this->load->view('admin/tampilan_dashboard', $data);
			$this->load->view('admin/footer');
		}

		if ($this->session->user_level == 2) {
			$this->db->where('slider_status', 1);
			$this->db->where('slider_tipe', 'dashboard_seeker');
			$this->db->or_where('slider_tipe', 'all');

			$data['slider'] = $this->db->get('tbl_master_slider')->result();

			$this->db->where('user_id', $this->session->user_id);
			$data['saved_job'] = $this->db->get('tbl_lowongan_tersimpan')->num_rows();

			$this->db->where('a.pelamar_id', $this->session->user_id);
			$data['submission'] = $this->db->get('tbl_pelamar_pekerjaan a')->num_rows();

			$this->db->where('a.reported', $this->session->user_id);
			$this->db->where('a.report_status', 1);
			$data['reported'] = $this->db->get('tbl_report a')->num_rows();

			$this->db->select('a.resume_visitor');
			$this->db->where('a.user_id', $this->session->user_id);
			$resume = $this->db->get('tbl_resume a')->result();
			$visitor = 0;
			foreach ($resume as $key) {
				$visitor += floatval($key->resume_visitor);
			}

			$data['visitor'] = $visitor;


			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('seeker/tampilan_dashboard', $data);
			$this->load->view('templates/footer');
		}
		if ($this->session->user_level == 3) {
			$this->db->where('user_id', $this->session->user_id);
			$data['job_posting'] = $this->db->get('tbl_lowongan_pekerjaan')->num_rows();

			$this->db->where('a.user_id', $this->session->user_id);
			$this->db->join('tbl_pelamar_pekerjaan b', 'b.lowongan_id=a.lowongan_id');
			$data['submission'] = $this->db->get('tbl_lowongan_pekerjaan a')->num_rows();

			$this->db->where('a.reported', $this->session->user_id);
			$this->db->where('a.report_status', 1);
			$data['reported'] = $this->db->get('tbl_report a')->num_rows();

			$this->db->select('a.perusahaan_visitor');
			$this->db->where('a.perusahaan_id', $this->session->perusahaan_id);
			$perusahaan = $this->db->get('tbl_perusahaan a')->result();
			$visitor = 0;
			foreach ($perusahaan as $key) {
				$visitor += floatval($key->perusahaan_visitor);
			}

			$data['visitor'] = $visitor;

			$this->db->where('slider_status', 1);
			$this->db->where('slider_tipe', 'dashboard_provider');
			$this->db->or_where('slider_tipe', 'all');
			$this->db->where('slider_status', 1);
			$data['slider'] = $this->db->get('tbl_master_slider')->result();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('provider/tampilan_dashboard', $data);
			$this->load->view('templates/footer');
		}
	}

	public function ubah_password()
	{
		$data_password = array(
			'user_password' => md5($this->input->post('password_baru_user')),
		);

		$this->db->where('user_id', $this->session->user_id);
		$result = $this->db->update('tbl_master_user', $data_password);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah!';
			$data['icon'] = 'success';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Password Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('dashboard', 'refresh');
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

	public function get_postingan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		if ($bulan == "" and $tahun == "") {
			$month = date('m');
			$year = date('Y');

			$data = $this->db->query("SELECT count(view_id) as jml,CAST(view_tgl AS DATE) AS tgl FROM tbl_view WHERE view_id_lowongan is not null AND EXTRACT(YEAR FROM view_tgl) = '$year' AND
EXTRACT(MONTH FROM view_tgl) = '$month' GROUP BY CAST(view_tgl AS DATE)")->result();
		} else {
			$data = $this->db->query("SELECT count(view_id) as jml,CAST(view_tgl AS DATE) AS tgl FROM tbl_view WHERE view_id_lowongan is not null AND EXTRACT(YEAR FROM view_tgl) = '$tahun' AND
EXTRACT(MONTH FROM view_tgl) = '$bulan' GROUP BY CAST(view_tgl AS DATE)")->result();
		}

		echo json_encode($data);
	}

	public function get_tnc()
	{
		if ($this->session->user_level == 3) {
			$data = $this->db->query("SELECT * FROM tbl_tnc WHERE tnc_tipe = 2 ORDER BY tnc_id DESC")->row();
		} else {
			$data = $this->db->query("SELECT * FROM tbl_tnc WHERE tnc_tipe = 1 ORDER BY tnc_id DESC")->row();
		}
		echo json_encode($data);
	}
}
