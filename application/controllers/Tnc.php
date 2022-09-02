<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tnc extends CI_Controller
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
        $this->load->model('Model_tnc', 'tnc');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/tampilan_tnc');
        $this->load->view('admin/footer');
    }

    public function tabel_tnc()
    {
        $list = $this->tnc->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            if ($person->tnc_tipe == 1) {
                $tipe = "Seeker";
            } else {
                $tipe = "Provider";
            }
            $row = array();
            $row[] = $no;
            $row[] = date('d-M-Y', strtotime($person->tnc_terbit_pada));
            $row[] = $tipe;
            $row[] = '<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" onclick="changeStatus(\'' . $person->tnc_id . '\')" id="set_active' . $person->tnc_id . '" ' . isChecked($person->tnc_status) . '>
							<label class="custom-control-label" for="set_active' . $person->tnc_id . '">' . isLabelChecked($person->tnc_status) . '</label>
					   </div>';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tnc(' . "'" . $person->tnc_id . "'" . ')"><i class="fas fa-edit"></i> Ubah</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Lihat" onclick="lihat_tnc(' . "'" . $person->tnc_id . "'" . ')"><i class="fas fa-eye"></i> Lihat</a>
                  ';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tnc->count_all(),
            "recordsFiltered" => $this->tnc->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function setStatus()
    {
        $tnc_id = $this->input->post('id');
        $getData = $this->db->get_where('tbl_tnc', ['tnc_id' => $tnc_id])->row_array();

        if (!$getData) {
            $response = [
                'status' => false,
                'errors' => 'Data Tidak Ditemukan.'
            ];
        } else {
            if ($getData['tnc_status'] == 1) {
                $data = [
                    'tnc_status' => 0,
                ];
                $this->db->where('tnc_id', $tnc_id);
                $this->db->update('tbl_tnc', $data);
            } else {
                $data = [
                    'tnc_status' => 1,
                ];
                $this->db->where('tnc_id', $tnc_id);
                $this->db->update('tbl_tnc', $data);
            }
            $response = [
                'status'   => TRUE,
            ];
        }

        echo json_encode($response);
    }

    public function edit_tnc($id)
    {
        $data = $this->tnc->get_by_id($id);
        echo json_encode($data);
    }

    public function tnc_add()
    {
        $metod = "add";
        $this->_validate($metod);
        $data = array(
            'tnc_tipe' => $this->input->post('tnc_tipe'),
            'tnc_text' => $this->input->post('tnc_text'),
            'tnc_terbit_pada' => $this->input->post('tnc_terbit'),
            'tnc_status' => 1,
        );
        $this->tnc->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function tnc_update()
    {
        $metod = "update";
        $this->_validate($metod);
        $data = array(
            'tnc_tipe' => $this->input->post('tnc_tipe'),
            'tnc_text' => $this->input->post('tnc_text'),
            'tnc_terbit_pada' => $this->input->post('tnc_terbit'),
            'tnc_status' => 1,
        );

        $this->tnc->update(array('tnc_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function tnc_delete($id)
    {
        $tnc_seeker = $this->db->order_by("tnc_terbit_pada", "DESC")->get_where('tbl_tnc', ['tnc_tipe' => 1])->row();
        $tnc_provider = $this->db->order_by("tnc_terbit_pada", "DESC")->get_where('tbl_tnc', ['tnc_tipe' => 2])->row();
        if ($tnc_seeker) {
            $this->tnc->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        } elseif ($tnc_provider) {
            $this->tnc->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        } else {
            echo json_encode(array("status" => false, "notif" => "Karena tidak ada data lain lagi untuk di tampilkan"));
        }
    }

    public function lihat_tnc($id)
    {
        $data = $this->tnc->get_by_id($id);
        echo json_encode($data);
    }

    private function _validate($metod)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($metod == "update") {
            if ($this->input->post('tnc_terbit') == '') {
                $data['inputerror'][] = 'tnc_terbit';
                $data['error_string'][] = 'Tanggal Terbit Wajib diisi!';
                $data['status'] = FALSE;
            }

            if ($this->input->post('tnc_tipe') == '') {
                $data['inputerror'][] = 'tnc_tipe';
                $data['error_string'][] = 'Tipe wajib diisi!';
                $data['status'] = FALSE;
            }    # code...
            if ($this->input->post('tnc_text')  == '') {
                $data['inputerror'][] = 'tnc_text';
                $data['error_string'][] = 'Syarat dan ketentuan wajib diisi!';
                $data['status'] = FALSE;
            }
        } else {
            if ($this->input->post('tnc_terbit') == '') {
                $data['inputerror'][] = 'tnc_terbit';
                $data['error_string'][] = 'Tanggal Terbit Wajib diisi!';
                $data['status'] = FALSE;
            }

            if ($this->input->post('tnc_tipe') == '') {
                $data['inputerror'][] = 'tnc_tipe';
                $data['error_string'][] = 'Tipe wajib diisi!';
                $data['status'] = FALSE;
            }

            if ($this->input->post('tnc_text')  == '') {
                $data['inputerror'][] = 'tnc_text';
                $data['error_string'][] = 'Syarat dan ketentuan wajib diisi!';
                $data['status'] = FALSE;
            }
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
