<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_query extends CI_Model
{

	public function cek_admin($email, $password)
	{
		$this->db->where('user_email', $email);
		$this->db->where('user_password', $password);
		$this->db->where('user_level', 1);
		return $this->db->get('tbl_master_user');
	}
	public function cek_seeker($email, $password)
	{
		$this->db->where('user_email', $email);
		$this->db->where('user_password', $password);
		$this->db->where('user_level', 2);
		return $this->db->get('tbl_master_user');
	}

	public function cek_email($email)
	{
		$this->db->where('user_email', $email);
		return $this->db->get('tbl_master_user');
	}

	public function cek_provider($email, $password)
	{
		$this->db->where('user_email', $email);
		$this->db->where('user_password', $password);
		$this->db->where('user_level', 3);
		return $this->db->get('tbl_master_user');
	}

	function get_kota($id_prov)
	{
		$r_kota = "<option value=''> Pilih Kota </pilih>";

		$this->db->order_by('kabkota_nama', 'ASC');
		$kota = $this->db->get_where('tbl_master_kabkota', array('prov_id' => $id_prov));
		// $r_kota = '';
		foreach ($kota->result_array() as $data) {
			$r_kota .= "<option value='$data[kabkota_id]'>$data[kabkota_nama]</option>";
		}
		return $r_kota;
	}
}
