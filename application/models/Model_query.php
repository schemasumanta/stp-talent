<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_query extends CI_Model {

	public function cek_admin($email,$password)
	{
		$this->db->where('user_email',$email);
		$this->db->where('user_password',$password);
		// $this->db->where('user_level',1);
		return $this->db->get('tbl_master_user');
	}
}
