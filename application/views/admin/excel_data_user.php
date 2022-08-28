<?php
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

// echo tgl_indo(date('Y-m-d')); // 21 Oktober 2017

?>
<h4 class="text-center">Laporan Data User</h4>
<p class="text-center">Tanggal <?php echo tgl_indo($dari_tgl); ?> - <?php echo tgl_indo($sampai_tgl); ?></p>
<table class="table table-bordered table-sm">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Tanggal Pendaftaran</th>
            <th>Nama</th>
            <th>Nama Perusahaan/ Nama Lengkap</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Sebagai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($laporan as $key) {
            $no++;

            if ($key->user_level == 1) {
                $sebagai = '<span class="badge badge-success">Admin</span>';
            } elseif ($key->user_level == 2) {
                $sebagai = '<span class="badge badge-info">Seeker</span>';
            } elseif ($key->user_level == 3) {
                $sebagai = '<span class="badge badge-danger">Provider</span>';
            }

            if ($key->perusahaan_nama) {
                $nama = $key->perusahaan_nama;
            } elseif ($key->resume_nama_lengkap) {
                # code...
                $nama = $key->resume_nama_lengkap;
            } else {
                $nama = "Admin";
            }
        ?>
            <tr>
                <th class="text-center" scope="row"><?php echo $no; ?></th>
                <td><?php echo date('d-F-Y H:i:s', strtotime($key->user_created_date)); ?></td>
                <td><?php echo $key->user_nama; ?></td>
                <td><?php echo $nama; ?></td>
                <td><?php echo $key->user_email; ?></td>
                <td>'<?php echo $key->user_telepon; ?></td>
                <td><?php echo $sebagai; ?></td>
            </tr>
        <?php }; ?>
    </tbody>
</table>

<br />
<p>Laporan ini dibuat pada tanggal <?php echo tgl_indo(date('Y-m-d')); ?></p>
<br />