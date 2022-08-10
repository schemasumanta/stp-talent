<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('landing','refresh');
		}
		
		date_default_timezone_set('Asia/Jakarta');	
	}
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function cek_status()
	{
		$this->db->select('a.user_login_status');
		$this->db->where('a.user_id',$this->input->get('user_id'));
		$data = $this->db->get('tbl_master_user a')->result();
		echo json_encode($data);
	}
	public function index($id='')
	{
		if (isset($_COOKIE['chat_key'])) {
			unset($_COOKIE['chat_key']); 
		}



		$id_chat ='';

		$data = array();

		if($id!='')
		{

			$this->db->select('a.user_nama,a.user_foto,a.user_login_status,a.user_id,a.perusahaan_id,b.perusahaan_nama');
			$this->db->where('md5(a.user_id)',$id);
			$this->db->join('tbl_perusahaan b','b.perusahaan_id=a.perusahaan_id','left');
			$data['penerima'] = $this->db->get('tbl_master_user a')->result();
		}
		if ($this->session->user_level==1) {

		}else{
			setcookie('chat_id','null');
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar'); 
			$this->load->view('web/tampilan_chat',$data); 
			$this->load->view('templates/footer');
		}
	}
}