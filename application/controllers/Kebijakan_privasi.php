<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kebijakan_privasi extends CI_Controller
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
        $this->load->model('Model_kebijakan_privasi', 'kp');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['kp_all'] = $this->db->get_where('tbl_kebijakan_privasi', ['kp_tipe' => 0])->row();
        $data['kp_seeker'] = $this->db->get_where('tbl_kebijakan_privasi', ['kp_tipe' => 1])->row();
        $data['kp_provider'] = $this->db->get_where('tbl_kebijakan_privasi', ['kp_tipe' => 2])->row();

        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/tampilan_kebijakan_privasi', $data);
        $this->load->view('admin/footer');
    }

    public function tabel_kp()
    {
        $list = $this->kp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            if ($person->kp_tipe == 1) {
                $tipe = "Seeker";
            } elseif ($person->kp_tipe == 2) {
                $tipe = "Provider";
            } else {
                $tipe = "All";
            }
            $row = array();
            $row[] = $no;
            $row[] = $tipe;
            $row[] = substr($person->kp_isi, 0, 150) . ".....";
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kp(' . "'" . $person->kp_id . "'" . ')"><i class="fas fa-edit"></i> Ubah</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Lihat" onclick="lihat_kp(' . "'" . $person->kp_id . "'" . ')"><i class="fas fa-eye"></i> Lihat</a>
                  ';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kp->count_all(),
            "recordsFiltered" => $this->kp->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function edit_kp($id)
    {
        $data = $this->kp->get_by_id($id);
        echo json_encode($data);
    }

    public function kp_add()
    {
        $metod = "add";
        $this->_validate($metod);
        $data = array(
            'kp_isi' => $this->input->post('kp_text'),
            'kp_tipe' => $this->input->post('kp_tipe'),
        );
        $this->kp->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function kp_update()
    {
        $metod = "update";
        $this->_validate($metod);
        $data = array(
            'kp_isi' => $this->input->post('kp_text'),
            'kp_tipe' => $this->input->post('kp_tipe'),
        );

        $this->kp->update(array('kp_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function lihat_kp($id)
    {
        $data = $this->kp->get_by_id($id);
        echo json_encode($data);
    }

    private function _validate($metod)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('kp_tipe') == '') {
            $data['inputerror'][] = 'kp_tipe';
            $data['error_string'][] = 'Tipe wajib dipilih!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('kp_text')  == '') {
            $data['inputerror'][] = 'kp_text';
            $data['error_string'][] = 'Text Kebijkan Privasi wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
