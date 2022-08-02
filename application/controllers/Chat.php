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
		$this->db->select('a.*,
			b.user_nama as nama_penerima,
			b.user_foto as foto_penerima,
			b.user_login_status as status_penerima,
			b.user_id as id_penerima,
			b.perusahaan_id as perusahaan_id_penerima,
			c.user_nama as nama_pengirim,
			c.user_foto as foto_pengirim,
			c.user_login_status as status_pengirim,
			c.user_id as id_pengirim,
			c.perusahaan_id as perusahaan_id_pengirim,
			d.perusahaan_nama as nama_perusahaan_penerima,
			e.perusahaan_nama as nama_perusahaan_pengirim,

			');
		$this->db->where('a.chat_penerima',$this->session->user_id);
		$this->db->or_where('a.chat_pengirim',$this->session->user_id);
		$this->db->join('tbl_master_user b','b.user_id=a.chat_penerima');
		$this->db->join('tbl_master_user c','c.user_id=a.chat_pengirim');
		$this->db->join('tbl_perusahaan d','d.perusahaan_id=b.perusahaan_id','left');
		$this->db->join('tbl_perusahaan e','e.perusahaan_id=c.perusahaan_id','left');
		$data['contact_chat'] = $this->db->get('tbl_chat a')->result();


		$this->db->select('a.user_nama,a.user_foto,a.user_login_status,a.user_id,a.perusahaan_id,b.perusahaan_nama');
		$this->db->where('a.user_id',$id);
		$this->db->join('tbl_perusahaan b','b.perusahaan_id=a.perusahaan_id','left');
		$data['penerima'] = $this->db->get('tbl_master_user a')->result();
		if ($this->session->user_level==1) {
			

		}else{
			
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar'); 
			$this->load->view('web/tampilan_chat',$data); 
			$this->load->view('templates/footer');
		}

		
	}
}