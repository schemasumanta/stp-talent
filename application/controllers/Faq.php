<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
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
        $this->load->model('Model_faq', 'faq');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/tampilan_faq');
        $this->load->view('admin/footer');
    }

    public function tabel_faq()
    {
        $list = $this->faq->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            if ($person->faq_tipe == 1) {
                $tipe = "Seeker";
            } elseif ($person->faq_tipe == 2) {
                $tipe = "Provider";
            } else {
                $tipe = "All";
            }
            $row = array();
            $row[] = $no;
            $row[] = $tipe;
            $row[] = substr($person->faq_question, 0, 150) . ".....";
            $row[] = substr($person->faq_answer, 0, 150) . ".....";
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kp(' . "'" . $person->faq_id . "'" . ')"><i class="fas fa-edit"></i> Ubah</a>
                  ';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->faq->count_all(),
            "recordsFiltered" => $this->faq->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function edit_faq($id)
    {
        $data = $this->faq->get_by_id($id);
        echo json_encode($data);
    }

    public function faq_add()
    {
        $metod = "add";
        $this->_validate($metod);
        $data = array(
            'faq_question' => $this->input->post('faq_question'),
            'faq_answer' => $this->input->post('faq_answer'),
            'faq_tipe' => $this->input->post('faq_tipe'),
        );
        $this->faq->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function faq_update()
    {
        $metod = "update";
        $this->_validate($metod);
        $data = array(
            'faq_question' => $this->input->post('faq_question'),
            'faq_answer' => $this->input->post('faq_answer'),
            'faq_tipe' => $this->input->post('faq_tipe'),
        );

        $this->faq->update(array('faq_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function lihat_faq($id)
    {
        $data = $this->faq->get_by_id($id);
        echo json_encode($data);
    }

    private function _validate($metod)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('faq_tipe') == '') {
            $data['inputerror'][] = 'faq_tipe';
            $data['error_string'][] = 'Tipe wajib dipilih!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('faq_question')  == '') {
            $data['inputerror'][] = 'faq_question';
            $data['error_string'][] = 'Pertanyaan wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('faq_answer')  == '') {
            $data['inputerror'][] = 'faq_answer';
            $data['error_string'][] = 'Jawaban wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
