<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tabel extends CI_Model
{

    function get_datatables($type = null, $sort = null, $order = null, $search = null, $id = null)
    {
        $this->_get_datatables_query($type, $sort, $order, $search, $id);
        if ($type != 'laporan_pasien') {
            if ($_GET['length'] != -1) {
                $this->db->limit($_GET['length'], $_GET['start']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }
    private function _get_datatables_query($type = null, $sort = null, $order = null, $search = null, $id = null)
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
                case 'report':
                $this->db->select('
                a.*,
                b.user_nama as reporter_nama,
                c.user_nama as reported_nama,
                d.perusahaan_nama as reporter_perusahaan,
                e.perusahaan_nama as reported_perusahaan,
                ');
                $this->db->join('tbl_master_user b', 'b.user_id=a.reporter');
                $this->db->join('tbl_master_user c', 'c.user_id=a.reported');
                $this->db->join('tbl_perusahaan d', 'd.perusahaan_id=b.perusahaan_id','left');
                $this->db->join('tbl_perusahaan e', 'e.perusahaan_id=c.perusahaan_id','left');
                $this->db->from('tbl_report a');
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('a.report_id', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('b.reported_nama', $search);
                    $this->db->or_like('c.reported_nama', $search);
                    $this->db->or_like('a.report_keterangan', $search);
                }

                break;



            case 'application':
                $this->db->select('
                pp.*,
                lp.lowongan_judul,
                lp.user_id,
                lp.lowongan_gaji_min,
                lp.lowongan_gaji_max,
                lp.lowongan_gaji_secret,
                lp.lowongan_created_date,
                lp.perusahaan_id,
                p.perusahaan_nama,
                p.perusahaan_logo,
                pr.prov_nama,
                kk.kabkota_nama,
                kj.kategori_nama,
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

            case 'lowongan_pekerjaan':
                $this->db->select('
                lp.lowongan_id,
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
                $this->db->join('tbl_perusahaan p', 'p.perusahaan_id=lp.perusahaan_id');
                $this->db->join('tbl_master_provinsi pr', 'pr.prov_id=p.perusahaan_prov');
                $this->db->join('tbl_master_kabkota kk', 'kk.kabkota_id=p.perusahaan_kabkota');
                $this->db->join('tbl_master_kategori_job kj', 'kj.kategori_id=lp.kategori_id');
                $this->db->from('tbl_lowongan_pekerjaan lp');
                $kategori = $this->session->kategori_job;
                if ($kategori) {
                    $this->db->where('lp.kategori_id', $kategori);
                }
                $prov = $this->session->prov_job;
                if ($prov) {
                    $this->db->where('p.perusahaan_prov', $prov);
                }
                $kota = $this->session->kota_job;
                if ($kota) {
                    $this->db->where('p.perusahaan_kabkota', $kota);
                }
                $dari_gaji = $this->session->kota_job;
                if ($dari_gaji) {
                    $this->db->where('lp.lowongan_gaji_min >=', $dari_gaji);
                }
                $dari_gaji = $this->session->dari_gaji_job;
                if ($dari_gaji) {
                    $this->db->where('lp.lowongan_gaji_min >=', $dari_gaji);
                }
                $ke_gaji = $this->session->ke_gaji_job;
                if ($ke_gaji) {
                    $this->db->where('lp.lowongan_gaji_max <=', $ke_gaji);
                }
                $nm_lowongan = $this->session->nama_lowongan;
                if ($nm_lowongan) {
                    $this->db->like('lp.lowongan_judul', $nm_lowongan);
                }
                $sort_by = $this->session->sort_by;
                if ($sort_by) {
                    $this->db->order_by('lp.lowongan_created_date', $sort_by);
                }
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('lp.lowongan_created_date', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('lp.lowongan_judul', $search);
                    $this->db->or_like('lp.lowongan_deskripsi', $search);
                }

                break;
            case 'application_provider':
                $this->db->select('
                user_email,user_telepon,lamaran_id,lamaran_status,lamaran_tanggal,resume_foto,resume_nama_lengkap,resume_lampiran,kabkota_nama,prov_nama,r.user_id');
                $this->db->join('tbl_lowongan_pekerjaan lp', 'lp.lowongan_id = pp.lowongan_id');
                $this->db->join('tbl_master_user mu', 'mu.user_id = pp.pelamar_id');
                $this->db->join('tbl_resume r', 'r.user_id = mu.user_id');
                $this->db->join('tbl_resume_lampiran rl', 'rl.user_id = mu.user_id', 'LEFT');
                $this->db->join('tbl_master_kabkota kk', 'kk.kabkota_id = r.kabkota_id');
                $this->db->join('tbl_master_provinsi pr', 'pr.prov_id = r.prov_id');
                $this->db->from('tbl_pelamar_pekerjaan pp');
                $filter = $this->session->status_lowongan;
                if ($filter != null) {
                    $this->db->where('pp.lamaran_status', $filter);
                }
                $this->db->where('lp.lowongan_id', $id);
                if ($_GET['order'][0]['column'] == 0) {
                    $this->db->order_by('pp.lamaran_tanggal', $order);
                } else {
                    $this->db->order_by($sort, $order);
                }

                if ($search != null && $search != '') {
                    $this->db->like('r.nama_lengkap', $search);
                    $this->db->where('lp.lowongan_id', $id);
                    $this->db->or_like('kk.kabkota_nama', $search);
                    $this->db->where('lp.lowongan_id', $id);
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

    function count_filtered($type = null, $sort = null, $order = null, $search = null, $id = null)
    {

        $this->_get_datatables_query($type, $sort, $order, $search, $id);
        return $this->db->get()->num_rows();
        // return $query->num_rows();


    }

    public function count_all($type = null, $sort = null, $order = null, $search = null, $id = null)
    {
        $this->_get_datatables_query($type, $sort, $order, $search, $id);
        return $this->db->get()->num_rows();
        // $results = $db_results->result();
        // $num_rows = $db_results->num_rows();
        // return $num_rows;
    }
}
