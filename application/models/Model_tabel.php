<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tabel extends CI_Model {

    function get_datatables($type=null,$sort=null,$order=null,$search=null)
    {
        $this->_get_datatables_query($type,$sort,$order,$search);
        if($type != 'laporan_pasien'){
            if($_GET['length'] != -1){
                $this->db->limit($_GET['length'], $_GET['start']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }


    private function _get_datatables_query($type=null,$sort=null,$order=null,$search=null)
    {         
        switch ($type) {
            case 'agama':
            $this->db->select('a.*');
            $this->db->from('tbl_master_agama a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.agama_nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.agama_id',$search);
                $this->db->or_like('a.agama_nama',$search);
            }
            
            break;


             case 'user':
            $this->db->select('a.*,b.*');
            $this->db->from('tbl_master_user a');
            $this->db->join('tbl_master_level b','b.level_id=a.user_level');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.user_nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.user_nama',$search);
                $this->db->or_like('a.user_email',$search);
                $this->db->or_like('a.user_telepon',$search);
                $this->db->or_like('b.level_nama',$search);
            }
            
            break;

             case 'pendidikan':
            $this->db->select('a.*');
            $this->db->from('tbl_master_pendidikan a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pendidikan_nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.pendidikan_id',$search);
                $this->db->or_like('a.pendidikan_nama',$search);
            }
            
            break;

            case 'skill':
            $this->db->select('a.*');
            $this->db->from('tbl_master_skill a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.skill_nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.skill_id',$search);
                $this->db->or_like('a.skill_nama',$search);
            }
            
            break;

            case 'level':
            $this->db->select('a.*');
            $this->db->from('tbl_master_level a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.level_nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.level_id',$search);
                $this->db->or_like('a.level_nama',$search);
            }
            
            break;

            case 'produk':
            $this->db->select('a.*,b.nama_kategori');
            $this->db->join('tbl_kategori_produk b','b.id_kategori=a.id_kategori');
            $this->db->from('tbl_master_produk a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.nama_produk',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.id_produk',$search);
                $this->db->or_like('b.nama_kategori',$this->session->kode);
                $this->db->or_like('a.nama_produk',$this->session->kode);
                $this->db->or_like('a.keterangan_produk',$this->session->kode);
            }

            break;


            default:

            break;
        }
    }

    function count_filtered($type=null,$sort=null,$order=null,$search=null)
    {

        $this->_get_datatables_query($type,$sort,$order,$search);
        return $this->db->get()->num_rows();
        // return $query->num_rows();


    }



    public function count_all($type=null,$sort=null,$order=null,$search=null)
    {
        $this->_get_datatables_query($type,$sort,$order,$search);
        return $this->db->get()->num_rows();
        // $results = $db_results->result();
        // $num_rows = $db_results->num_rows();
        // return $num_rows;
    }

}
