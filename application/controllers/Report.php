<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('landing','refresh');
		}

		if ($this->session->user_level!=1) {
			redirect('landing','refresh');
		}

		date_default_timezone_set('Asia/Jakarta');	
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar'); 
		$this->load->view('admin/tampilan_report'); 
		$this->load->view('admin/footer');


	}


	public function tabel_report(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'report_id';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('report',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">';

			if ($l->report_status == 0) {
				$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm rounded-left item_approval_report mr-2" data-status="2" data-id="'.$l->report_id.'"><i class="fa fa-times-circle mr-2"></i>Tolak</a>';
				$opsi .='<a href="javascript:;" class="btn btn-success btn-sm rounded-right item_approval_report" data-status="1" data-id="'.$l->report_id.'"><i class="fa fa-check-circle  mr-2"></i>Setujui</a>';
			}else{
				$opsi .='<a href="javascript:;" class="btn btn-primary btn-sm rounded-right item_approval_report" data-status="0" data-id="'.$l->report_id.'"><i class="fa fa-undo  mr-2"></i>Reset</a>';
			}

			if ($l->reporter_perusahaan!='') {
				$l->reporter_nama = $l->reporter_nama." <br><b>".$l->reporter_perusahaan."</b>";
			}

			if ($l->reported_perusahaan!='') {
				$l->reported_nama = $l->reported_nama." <br><b>".$l->reported_perusahaan."</b>";
			}

			if ($l->report_status == 0) {
				$l->report_status = '<button type="button" class="btn btn-primary btn-sm btn-round ">Pending</button>';
			}

			if ($l->report_status == 1) {
				$l->report_status = '<button type="button" class="btn btn-success btn-sm btn-round ">DiSetujui</button>';
			}

			if ($l->report_status == 2) {
				$l->report_status = '<button type="button" class="btn btn-danger btn-sm btn-round ">Ditolak</button>';
			}

			$opsi .='</div>';

			$l->opsi = $opsi;

			$data[] = $l;

		}

		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('report',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('report',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}

	

	public function approval()
	{
		$this->db->set('report_status',$this->input->post('isi'));
		$this->db->where('report_id',$this->input->post('kode'));
		$data = $this->db->update('tbl_report');
		echo json_encode($data);

	}

}
