<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url() . $profile_apk->stp_brand_icon; ?>">

    <title>Laporan Data User | Talent Hub</title>
    <!-- Latest compiled and minified CSS -->
    <link href="<?php echo base_url() ?>assets_admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }
        }



        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        /* page[size="A4"] {
            width: 21cm;
        } */

        page[size="A4"][layout="landscape"] {
            width: 39.7cm;
            /* height: 21cm; */
        }

        /* Red border */
        hr.new1 {
            border-top: 6px solid #e74a3b;
        }

        .footer {
            clear: both;
            position: relative;
            height: 200px;
            margin-top: -200px;
            page-break-before: always;
        }

        p.kecil {
            line-height: 100%;
        }

        .textkeatas {
            position: absolute;
            writing-mode: tb-rl;
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            transform: rotate(180deg);
            /* white-space: nowrap; */
            float: left;
        }

        .gambar-text {
            position: relative;
            text-align: left;
            font-size: 12px;
        }

        .bottom-right {
            position: absolute;
            bottom: 135px;
            right: -63px;
            transform: rotate(-90deg);
            width: 300px;
            font-size: 10px;
            text-align: center;
        }

        #myBtn_bottom {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: blue;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

        #myBtn_top {
            display: none;
            position: fixed;
            bottom: 100px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: blue;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

        #myBtn_bottom:hover {
            background-color: #555;
        }

        #myBtn_top:hover {
            background-color: #555;
        }
    </style>

</head>

<body>
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
    <a id="myBtn_bottom" href="#gotobotton" class="btn btn-primary" title="langsung ke bawah">
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
    </a>
    <button onclick="topFunction()" id="myBtn_top" title="langsung ke atas">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </button>
    <hr>
    <p class="text-center">
        <button id="btnPrint" type="button" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print/PDF</button>
        <!-- <a href="<?php echo base_url('bisa/dt_transaksi/laporan_excel'); ?>" class="btn btn-success"><i class="fas fa-file-excel" aria-hidden="true"></i> Export Excel</a> -->
        <a href="<?php echo base_url('user/laporan_excel_user'); ?>" class="btn btn-success"><i class="fas fa-file-excel" aria-hidden="true"></i> Export Excel</a>
        <a href="<?php echo base_url('user/laporan_user'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
    </p>
    <hr>

    <div id="printThis">
        <page class="sheet padding-10mm containers" size="A4" layout="landscape" style="margin-top: 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2 mt-4">
                        <img src="<?php echo base_url() . $profile_apk->stp_brand_icon; ?>" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col-sm-10 text-center mt-4">
                        <h4><b><?php echo $profile_apk->stp_pemilik . " - " . $profile_apk->stp_nama; ?></b></h4>
                        <h6 style="margin-top: -10px;">
                            <?php echo $profile_apk->stp_alamat; ?><br>
                            No. Telepon : <?php echo $profile_apk->stp_telepon; ?><br>
                            Email : <?php echo $profile_apk->stp_email; ?><br>
                        </h6>
                    </div>
                </div>
                <hr class="new1">

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
                                <td><?php echo $key->user_telepon; ?></td>
                                <td><?php echo $sebagai; ?></td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
                <br />
                <p id="gotobotton">Laporan ini dibuat pada tanggal <?php echo tgl_indo(date('Y-m-d')); ?></p>
                <br />
            </div>
        </page>
    </div>

    <script src="<?php echo base_url() ?>assets_admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printThis"));
        }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }

        //Get the button
        var mybutton_bottom = document.getElementById("myBtn_bottom");
        var mybutton_top = document.getElementById("myBtn_top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton_bottom.style.display = "block";
                mybutton_top.style.display = "block";
            } else {
                mybutton_bottom.style.display = "none";
                mybutton_top.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>

</html>