<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cv extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('seeker','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}


	public function index()
	{
		$this->db->where('slider_tipe','main');
		$this->db->where('slider_status',1);
		$data['slider_main'] = $this->db->get('tbl_master_slider')->result();
		$this->db->where('kategori_status',1);
		$this->db->limit(8);
		$this->db->order_by('kategori_nama','asc');
		$data['kategori_job'] = $this->db->get('tbl_master_kategori_job')->result();
		$this->db->where('slider_tipe','cv');
		$this->db->where('slider_status',1);
		$data['slider_cv'] = $this->db->get('tbl_master_slider')->result();
		$data['stp'] = $this->db->get('tbl_master_stp')->result();
		$this->db->where('slider_tipe','how');
		$this->db->where('slider_status',1);
		$data['slider_how'] = $this->db->get('tbl_master_slider')->result();

		$this->db->where('a.user_id',$this->session->user_id);
		$this->db->join('tbl_master_agama b','b.agama_id=a.agama_id','left');
		$this->db->join('tbl_master_pendidikan c','c.pendidikan_id=a.pendidikan_id','left');
		$data['resume'] = $this->db->get('tbl_resume a')->result();

		$this->db->where('a.user_id',$this->session->user_id);
		$data['upload_resume'] = $this->db->get('tbl_resume_lampiran a')->result();

		$this->db->where('pendidikan_status',1);
		$data['pendidikan'] = $this->db->get('tbl_master_pendidikan')->result();

		$this->db->where('a.user_id',$this->session->user_id);
		$data['pengalaman'] = $this->db->get('tbl_pengalaman_resume a')->result();

		$this->db->where('a.user_id',$this->session->user_id);
		$data['skill_resume'] = $this->db->get('tbl_skill_resume a')->result();

		$this->db->where('agama_status',1);
		$data['agama'] = $this->db->get('tbl_master_agama')->result();

		$this->db->where('skill_status',1);
		$data['skill'] = $this->db->get('tbl_master_skill')->result();

		$this->db->where('skill_level_status',1);
		$data['skill_level'] = $this->db->get('tbl_skill_level')->result();
		
		$data['provinsi'] = $this->db->get('tbl_master_provinsi')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar'); 
		$this->load->view('seeker/tampilan_cv',$data);
		$this->load->view('templates/footer');
	}

	



	public function upload_resume()
	{
		$this->db->where('user_id',  $this->session->user_id);
		$this->db->delete('tbl_resume_lampiran');
		$data_upload = array(
			'resume_lampiran' => $this->input->post('lampiran_cv'),
			'user_id' => $this->session->user_id,
			'lampiran_created_date' =>date('Y-m-d H:i:s')
		);
		$result= $this->db->insert('tbl_resume_lampiran', $data_upload);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengupload CV ",
			);

			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'CV Berhasil Diupload!';
			$data['icon'] = 'success';

		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'CV Gagal Diupload!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('cv','refresh');
	}
	public function generate_cv($id)
	{
		$this->db->where('a.user_id',$id);
		$this->db->join('tbl_master_user b','b.user_id=a.user_id');
		$this->db->join('tbl_master_agama c','c.agama_id=a.agama_id');
		$this->db->join('tbl_master_provinsi d','d.prov_id=a.prov_id');
		$this->db->join('tbl_master_kabkota e','e.kabkota_id=a.kabkota_id');
		$data['resume']	=$this->db->get('tbl_resume a')->result();
		$this->db->where('a.user_id',$id);
		$this->db->join('tbl_master_skill b','b.skill_id=a.skill_id');
		$this->db->join('tbl_skill_level c','c.skill_level_id=a.skill_level_id');
		$data['skill']	=$this->db->get('tbl_skill_resume a')->result();
		$this->db->where('user_id',$id);
		$data['pengalaman']	=$this->db->get('tbl_pengalaman_resume')->result();
		$this->load->library('dompdf_gen');
		$this->load->view('seeker/generate_cv',$data);
		$customPaper = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->load->library('pdfgenerator');
		$this->pdfgenerator->generate_view($html, strtoupper("CV ".$id), TRUE, $customPaper, $orientation);
	}

	public function simpan_resume()
	{
		$data_resume = array( 
			'user_id' => $this->session->user_id,
			'pendidikan_id' =>$this->input->post('pendidikan_id'),
			'prov_id' =>$this->input->post('resume_prov'),
			'kabkota_id' =>$this->input->post('resume_kabkota'),
			'agama_id' =>$this->input->post('resume_agama'),
			'resume_nama_pendidikan_terakhir' =>$this->input->post('resume_nama_pendidikan_terakhir'),
			'resume_pendidikan_tahun_lulus' =>$this->input->post('resume_pendidikan_tahun_lulus'),
			'resume_nama_lengkap' => $this->input->post('resume_nama_lengkap'),
			'resume_foto' =>$this->input->post('lampiran_pas_photo_lama'),
			'resume_nik' => $this->input->post('resume_nik'),
			'resume_alamat_lengkap' => $this->input->post('resume_alamat'),
			'resume_jenis_kelamin' => $this->input->post('resume_jenis_kelamin'),
			'resume_tempat_lahir' => $this->input->post('resume_tempat_lahir'),
			'resume_tanggal_lahir' => $this->input->post('resume_tanggal_lahir'),
			'resume_created_date' =>date('Y-m-d H:i:s'),
		);

		$result= $this->db->insert('tbl_resume', $data_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Biodata ".$this->input->post('resume_nama_lengkap'),
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Biodata Berhasil Ditambahkan!';
			$data['icon'] = 'success';


		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Biodata Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('cv','refresh');
	}


	public function ubah_resume()
	{
		$data_resume = array( 
			'pendidikan_id' =>$this->input->post('pendidikan_id'),
			'prov_id' =>$this->input->post('resume_prov'),
			'kabkota_id' =>$this->input->post('resume_kabkota'),
			'agama_id' =>$this->input->post('resume_agama'),
			'resume_nama_pendidikan_terakhir' =>$this->input->post('resume_nama_pendidikan_terakhir'),
			'resume_pendidikan_tahun_lulus' =>$this->input->post('resume_pendidikan_tahun_lulus'),
			'resume_nama_lengkap' => $this->input->post('resume_nama_lengkap'),
			'resume_foto' =>$this->input->post('lampiran_pas_photo_lama'),
			'resume_nik' => $this->input->post('resume_nik'),
			'resume_alamat_lengkap' => $this->input->post('resume_alamat'),
			'resume_jenis_kelamin' => $this->input->post('resume_jenis_kelamin'),
			'resume_tempat_lahir' => $this->input->post('resume_tempat_lahir'),
			'resume_tanggal_lahir' => $this->input->post('resume_tanggal_lahir'),
		);
		$this->db->where('resume_id',$this->input->post('resume_id'));
		$result= $this->db->update('tbl_resume', $data_resume);

		if ($result) {
			$data_history = array(
				'id_user' => $this->session->user_id, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Mengubah Biodata ".$this->input->post('resume_nama_lengkap'),
			);

			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Biodata Berhasil Diubah!';
			$data['icon'] = 'success';
		}else{

			$data['title'] = 'Gagal';
			$data['text'] = 'Biodata Gagal Diubah!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('cv','refresh');
	}

}
