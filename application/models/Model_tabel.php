<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tabel extends CI_Model
{

    function get_datatables($type = null, $sort = null, $order = null, $search = null)
    {
        $this->_get_datatables_query($type, $sort, $order, $search);
        if ($type != 'laporan_pasien') {
            if ($_GET['length'] != -1) {
                $this->db->limit($_GET['length'], $_GET['start']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }
    private function _get_datatables_query($type = null, $sort = null, $order = null, $search = null)
    {
        switch ($type) {
            case 'agama':
                $this->db->select('a.*');
                $this->db->from('tbl_master_agama a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.agama_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.agama_id', $search);
                    $this->db->or_like('a.agama_nama', $search);
                }

                break;

                case 'notifikasi':
                $this->db->select('a.*');
                $this->db->from('tbl_notifikasi a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.notifikasi_tanggal', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.notifikasi_judul', $search);
                    $this->db->or_like('a.notifikasi_isi', $search);
                }

                break;

            case 'lowongan_tersimpan':
                $this->db->select('
                a.*,
                b.lowongan_judul,
                b.lowongan_gaji_min,
                b.lowongan_gaji_max,
                b.lowongan_gaji_secret,
                b.lowongan_created_date,
                b.perusahaan_id,
                c.perusahaan_nama,
                c.perusahaan_logo,
                d.prov_nama,
                e.kabkota_nama,
                f.kategori_nama,

                ');
                $this->db->join('tbl_lowongan_pekerjaan b', 'b.lowongan_id=a.lowongan_id');
                $this->db->join('tbl_perusahaan c', 'c.perusahaan_id=b.perusahaan_id');
                $this->db->join('tbl_master_provinsi d', 'd.prov_id=c.perusahaan_prov');
                $this->db->join('tbl_master_kabkota e', 'e.kabkota_id=c.perusahaan_kabkota');
                $this->db->join('tbl_master_kategori_job f', 'f.kategori_id=b.kategori_id');

                $this->db->from('tbl_lowongan_tersimpan a');
                $this->db->where('a.user_id', $this->session->user_id);
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.lowongan_tersimpan_id', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('b.lowongan_judul', $search);
                    $this->db->where('a.user_id', $this->session->user_id);
                    $this->db->or_like('b.lowongan_deskripsi', $search);
                    $this->db->where('a.user_id', $this->session->user_id);
                }

                break;

            case 'application':
                $this->db->select('
                pp.*,
                lp.lowongan_judul,
                lp.lowongan_gaji_min,
                lp.lowongan_gaji_max,
                lp.lowongan_gaji_secret,
                lp.lowongan_created_date,
                lp.perusahaan_id,
                p.perusahaan_nama,
                p.perusahaan_logo,
                pr.prov_nama,
                kk.kabkota_nama,
                kj.kategori_nama
                ');
                $this->db->join('tbl_lowongan_pekerjaan lp', 'lp.lowongan_id=pp.lowongan_id');
                $this->db->join('tbl_perusahaan p', 'p.perusahaan_id=lp.perusahaan_id');
                $this->db->join('tbl_master_provinsi pr', 'pr.prov_id=p.perusahaan_prov');
                $this->db->join('tbl_master_kabkota kk', 'kk.kabkota_id=p.perusahaan_kabkota');
                $this->db->join('tbl_master_kategori_job kj', 'kj.kategori_id=lp.kategori_id');
                $this->db->from('tbl_pelamar_pekerjaan pp');
                $this->db->where('pp.pelamar_id', $this->session->user_id);
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('pp.lamaran_id', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('lp.lowongan_judul', $search);
                    $this->db->where('pp.pelamar_id', $this->session->user_id);
                    $this->db->or_like('lp.lowongan_deskripsi', $search);
                    $this->db->where('pp.pelamar_id', $this->session->user_id);
                }

                break;

            case 'job_posting':
                $this->db->select('
                a.*,
                c.perusahaan_nama,
                c.perusahaan_logo,
                d.prov_nama,
                e.kabkota_nama,
                f.kategori_nama,
                ');
                $this->db->join('tbl_perusahaan c', 'c.perusahaan_id=a.perusahaan_id');
                $this->db->join('tbl_master_provinsi d', 'd.prov_id=c.perusahaan_prov');
                $this->db->join('tbl_master_kabkota e', 'e.kabkota_id=c.perusahaan_kabkota');
                $this->db->join('tbl_master_kategori_job f', 'f.kategori_id=a.kategori_id');

                $this->db->from('tbl_lowongan_pekerjaan a');
                $this->db->where('a.user_id', $this->session->user_id);
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.lowongan_id', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('a.lowongan_judul', $search);
                    $this->db->where('a.user_id', $this->session->user_id);
                    $this->db->or_like('a.lowongan_deskripsi', $search);
                    $this->db->where('a.user_id', $this->session->user_id);
                }

                break;

            case 'job_posting_all':
                $this->db->select('
                a.*,
                c.perusahaan_nama,
                c.perusahaan_logo,
                d.prov_nama,
                e.kabkota_nama,
                f.kategori_nama,
                ');
                $this->db->join('tbl_perusahaan c', 'c.perusahaan_id=a.perusahaan_id');
                $this->db->join('tbl_master_provinsi d', 'd.prov_id=c.perusahaan_prov');
                $this->db->join('tbl_master_kabkota e', 'e.kabkota_id=c.perusahaan_kabkota');
                $this->db->join('tbl_master_kategori_job f', 'f.kategori_id=a.kategori_id');
                $this->db->from('tbl_lowongan_pekerjaan a');
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.lowongan_id', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('a.lowongan_judul', $search);
                    $this->db->or_like('a.lowongan_deskripsi', $search);
                    $this->db->or_like('e.kabkota_nama', $search);
                    $this->db->or_like('d.prov_nama', $search);
                    $this->db->or_like('f.kategori_nama', $search);
                }

                break;



            case 'bahasa':
                $this->db->select('a.*');
                $this->db->from('tbl_master_bahasa a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.bahasa_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.bahasa_id', $search);
                    $this->db->or_like('a.bahasa_nama', $search);
                }

                break;

            case 'slider':
                $this->db->select('a.*');
                $this->db->from('tbl_master_slider a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.slider_id', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.slider_id', $search);
                    $this->db->or_like('a.slider_tipe', $search);
                }

                break;

            case 'jabatan':
                $this->db->select('a.*');
                $this->db->from('tbl_master_jabatan a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.jabatan_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.jabatan_id', $search);
                    $this->db->or_like('a.jabatan_nama', $search);
                }

                break;


            case 'user':
                $this->db->select('a.*,b.*');
                $this->db->from('tbl_master_user a');
                $this->db->where('a.user_level', 1);

                $this->db->join('tbl_master_level b', 'b.level_id=a.user_level');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.user_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.user_nama', $search);
                    $this->db->or_like('a.user_email', $search);
                    $this->db->or_like('a.user_telepon', $search);
                    $this->db->or_like('b.level_nama', $search);
                }

                break;

            case 'user_job_provider':
                $this->db->select('a.*,b.*');
                $this->db->from('tbl_master_user a');
                $this->db->where('a.user_level', 3);
                $this->db->join('tbl_master_level b', 'b.level_id=a.user_level');
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.user_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('a.user_nama', $search);
                    $this->db->where('a.user_level', 3);

                    $this->db->or_like('a.user_email', $search);
                    $this->db->where('a.user_level', 3);

                    $this->db->or_like('a.user_telepon', $search);
                    $this->db->where('a.user_level', 3);

                    $this->db->or_like('b.level_nama', $search);
                    $this->db->where('a.user_level', 3);
                }

                break;

            case 'user_job_seeker':
                $this->db->select('a.*,b.*');
                $this->db->from('tbl_master_user a');
                $this->db->where('a.user_level', 2);
                $this->db->join('tbl_master_level b', 'b.level_id=a.user_level');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.user_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.user_nama', $search);
                    $this->db->where('a.user_level', 2);

                    $this->db->or_like('a.user_email', $search);
                    $this->db->where('a.user_level', 2);

                    $this->db->or_like('a.user_telepon', $search);
                    $this->db->where('a.user_level', 2);

                    $this->db->or_like('b.level_nama', $search);
                    $this->db->where('a.user_level', 2);
                }

                break;

            case 'pendidikan':
                $this->db->select('a.*');
                $this->db->from('tbl_master_pendidikan a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.pendidikan_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.pendidikan_id', $search);
                    $this->db->or_like('a.pendidikan_nama', $search);
                }

                break;

            case 'skill':
                $this->db->select('a.*');
                $this->db->from('tbl_master_skill a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.skill_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.skill_id', $search);
                    $this->db->or_like('a.skill_nama', $search);
                }

                break;

            case 'skill_level':
                $this->db->select('a.*');
                $this->db->from('tbl_skill_level a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.skill_level_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.skill_level_id', $search);
                    $this->db->or_like('a.skill_level_nama', $search);
                }

                break;

            case 'level':
                $this->db->select('a.*');
                $this->db->from('tbl_master_level a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.level_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.level_id', $search);
                    $this->db->or_like('a.level_nama', $search);
                }

                break;

            case 'stp':
                $this->db->select('a.*');
                $this->db->from('tbl_master_stp a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.stp_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.stp_id', $search);
                    $this->db->or_like('a.stp_nama', $search);
                    $this->db->or_like('a.stp_pemilik', $search);
                    $this->db->or_like('a.stp_email', $search);
                    $this->db->or_like('a.stp_telepon', $search);
                }

                break;



            case 'job_kategori':
                $this->db->select('a.*');
                $this->db->from('tbl_master_kategori_job a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.kategori_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.kategori_id', $search);
                    $this->db->or_like('a.kategori_nama', $search);
                }

                break;

            case 'job_level':
                $this->db->select('a.*');
                $this->db->from('tbl_master_level_job a');

                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.joblevel_nama', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }
                if ($search != null && $search != '') {
                    $this->db->like('a.joblevel_id', $search);
                    $this->db->or_like('a.joblevel_nama', $search);
                }

                break;
            case 'produk':
                $this->db->select('a.*,b.nama_kategori');
                $this->db->join('tbl_kategori_produk b', 'b.id_kategori=a.id_kategori');
                $this->db->from('tbl_master_produk a');
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.nama_produk', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('a.id_produk', $search);
                    $this->db->or_like('b.nama_kategori', $this->session->kode);
                    $this->db->or_like('a.nama_produk', $this->session->kode);
                    $this->db->or_like('a.keterangan_produk', $this->session->kode);
                }

                break;


            default:

                break;
        }
    }

    function count_filtered($type = null, $sort = null, $order = null, $search = null)
    {

        $this->_get_datatables_query($type, $sort, $order, $search);
        return $this->db->get()->num_rows();
        // return $query->num_rows();


    }



    public function count_all($type = null, $sort = null, $order = null, $search = null)
    {
        $this->_get_datatables_query($type, $sort, $order, $search);
        return $this->db->get()->num_rows();
        // $results = $db_results->result();
        // $num_rows = $db_results->num_rows();
        // return $num_rows;
    }
}
