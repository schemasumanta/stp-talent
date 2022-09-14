<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Premium extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') == FALSE) {
			redirect('landing', 'refresh');
		}

		if ($this->session->user_level != 1) {
			redirect('landing', 'refresh');
		}
		$this->load->model('Model_premium', 'premium');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tampilan_premium');
		$this->load->view('admin/footer');
	}

	public function tabel_premium()
	{
		$list = $this->premium->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			if ($person->premium_tipe == 1) {
				$tipe = "Seeker";
			} else {
				$tipe = "Provider";
			}
			$row = array();
			$row[] = $no;
			$row[] = $person->premium_nama;
			$row[] = $tipe;
			$row[] = "Rp " . number_format($person->premium_harga, 0, ',', '.');
			$row[] = $person->premium_bulan . " Bulan";
			$row[] = '<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" onclick="changeStatus(\'' . $person->premium_id . '\')" id="set_active' . $person->premium_id . '" ' . isChecked($person->premium_status) . '>
							<label class="custom-control-label" for="set_active' . $person->premium_id . '">' . isLabelChecked($person->premium_status) . '</label>
					   </div>';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_premium(' . "'" . $person->premium_id . "'" . ')"><i class="fas fa-edit"></i> Ubah</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_premium(' . "'" . $person->premium_id . "'" . ')"><i class="fas fa-trash"></i> Hapus</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->premium->count_all(),
			"recordsFiltered" => $this->premium->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function setStatus()
	{
		$premium_id = $this->input->post('id');
		$getData = $this->db->get_where('tbl_premium', ['premium_id' => $premium_id])->row_array();

		if (!$getData) {
			$response = [
				'status' => false,
				'errors' => 'Data Tidak Ditemukan.'
			];
		} else {
			if ($getData['premium_status'] == 1) {
				$data = [
					'premium_status' => 0,
				];
				$this->db->where('premium_id', $premium_id);
				$this->db->update('tbl_premium', $data);
			} else {
				$data = [
					'premium_status' => 1,
				];
				$this->db->where('premium_id', $premium_id);
				$this->db->update('tbl_premium', $data);
			}
			$response = [
				'status'   => TRUE,
			];
		}

		echo json_encode($response);
	}

	public function edit_premium($id)
	{
		$data = $this->premium->get_by_id($id);
		echo json_encode($data);
	}

	public function premium_add()
	{
		$this->_validate();
		$x = $this->input->post('premium_harga');
		$xx = preg_replace("/[Rp.,]/", "", $x);
		$data = array(
			'premium_nama' => $this->input->post('premium_nama'),
			'premium_tipe' => $this->input->post('premium_tipe'),
			'premium_harga' => (int) $xx,
			'premium_bulan' => $this->input->post('premium_bulan'),
			'premium_status' => 1,
		);
		$this->premium->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function premium_update()
	{
		$this->_validate();
		$x = $this->input->post('premium_harga');
		$xx = preg_replace("/[Rp.,]/", "", $x);
		$data = array(
			'premium_nama' => $this->input->post('premium_nama'),
			'premium_tipe' => $this->input->post('premium_tipe'),
			'premium_harga' => (int) $xx,
			'premium_bulan' => $this->input->post('premium_bulan'),
			'premium_status' => 1,
		);
		$this->premium->update(array('premium_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function premium_delete($id)
	{
		$this->premium->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('premium_nama') == '') {
			$data['inputerror'][] = 'premium_nama';
			$data['error_string'][] = 'Nama Wajib diisi!';
			$data['status'] = FALSE;
		}

		if ($this->input->post('premium_tipe') == '') {
			$data['inputerror'][] = 'premium_tipe';
			$data['error_string'][] = 'Tipe wajib diisi!';
			$data['status'] = FALSE;
		}

		if ($this->input->post('premium_harga') == '') {
			$data['inputerror'][] = 'premium_harga';
			$data['error_string'][] = 'Harga wajib diisi!';
			$data['status'] = FALSE;
		}

		if ($this->input->post('premium_bulan') == '') {
			$data['inputerror'][] = 'premium_bulan';
			$data['error_string'][] = 'Berlaku selama berapa bulan wajib diisi!';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
