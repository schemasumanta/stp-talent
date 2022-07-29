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


	public function index($id='')
	{
		$id_chat ='';
		if($id!='')
		{
			$this->db->where('chat_pengirim',$id);
			$this->db->where('chat_penerima',$this->session->user_id);
			$this->db->or_where('chat_pengirim',$this->session->user_id);
			$this->db->where('chat_penerima',$id);
			$chat = $this->db->get('tbl_chat');

			if ($chat->num_rows() == 0) {

				$id_chat = $this->generateRandomString(16);
				$data_chat = array(
					'chat_id' => $id_chat, 
					'chat_pengirim' => $this->session->user_id, 
					'chat_penerima' => $id, 
					'chat_tanggal' => date('Y-m-d H:i:s'), 
				);
				$this->db->insert('tbl_chat',$data_chat);

			}else{

				foreach ($chat->result() as $key) {
				$id_chat = $key->chat_id;
				}
			}



		}

		$data['id_chat'] = $id_chat;
		$this->db->where('chat_penerima',$this->session->user_id);
		$this->db->or_where('chat_pengirim',$this->session->user_id);
		$data['contact_chat'] = $this->db->get('tbl_chat')->result();

		$this->db->select('user_nama,user_foto,user_login_status,user_id');
		$this->db->where('user_id',$id);
		$data['penerima'] = $this->db->get('tbl_master_user')->result();
		if ($this->session->user_level==1) {
			

		}else{
			
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar'); 
			$this->load->view('web/tampilan_chat',$data); 
			$this->load->view('templates/footer');
		}

		
	}
}