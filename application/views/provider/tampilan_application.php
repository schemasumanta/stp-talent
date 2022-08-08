<style>
    .tombol {
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        outline: none;
    }

    .card {
        padding: 1.5em .5em .5em;
        border-radius: 2em;
        text-align: center;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }

    .carousel-wrap {
        width: 1000px;
        margin: auto;
        position: relative;
    }

    .owl-carousel .owl-nav {
        overflow: hidden;
        height: 0px;
    }

    .owl-theme .owl-dots .owl-dot.active span,
    .owl-theme .owl-dots .owl-dot:hover span {
        background: #2caae1;
    }


    .owl-carousel .item {
        text-align: center;
    }

    .owl-carousel .nav-btn {
        height: 47px;
        position: absolute;
        width: 26px;
        cursor: pointer;
        top: 100px !important;
    }

    .owl-carousel .owl-prev.disabled,
    .owl-carousel .owl-next.disabled {
        pointer-events: none;
        opacity: 0.2;
    }

    .owl-carousel .prev-slide {
        left: -33px;
    }

    .owl-carousel .next-slide {
        right: -33px;
    }

    .owl-carousel .prev-slide:hover {
        background-position: 0px -53px;
    }

    .owl-carousel .next-slide:hover {
        background-position: -24px -53px;
    }

    span.img-text {
        text-decoration: none;
        outline: none;
        transition: all 0.4s ease;
        -webkit-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        cursor: pointer;
        width: 100%;
        font-size: 23px;
        display: block;
        text-transform: capitalize;
    }

    span.img-text:hover {
        color: #2caae1;
    }
</style>


<!-- Begin Page Content -->
<div class="container-fluid p-5 flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <h1 class="h3 mb-0 text-gray-800">Application Job</h1>
    </div>
    <!-- Set up your HTML -->
    <div class="card-group">
        <div class="owl-carousel">
            <?php
            foreach ($lowongan as $key) { ?>
                <div class="card align-items-center d-flex justify-content-center mb-2 mr-2" id="on_klik<?= $key->lowongan_id; ?>" style="height: 250px;">
                    <img src="<?= $key->perusahaan_logo; ?>" alt="logo perusahaan" style="height: 100px; width: 150px;">
                    <div class="card-body">
                        <a href="javascript:;" class="btn" onclick="cek_lowongan(<?= $key->lowongan_id; ?>)">
                            <h5><?= $key->lowongan_judul; ?></h5>
                            <label>
                                <i class="fa fa-map-marker" style="font-size:24px;color:red"></i> <?= $key->kabkota_nama; ?>
                            </label>
                        </a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <div class="table-responsive">

        <table id="tabel_application" class="table " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
            <tbody id="show_data">

            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->
<script type="text/javascript">
    $(document).ready(function() {
        const notif = $('.flashdatart').data('title');
        if (notif) {
            Swal.fire({
                title: notif,
                text: $('.flashdatart').data('text'),
                icon: $('.flashdatart').data('icon'),
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.close();

                }
            });
        }





        function table_data() {
            dataTable.ajax.reload(null, true);
        }


        $(".refresh").click(function() {
            location.reload();
        });

    });

    function cek_lowongan(id) {

        dataTable = $('#tabel_application').DataTable({
            paginationType: 'full_numbers',
            processing: true,
            serverSide: true,
            searching: true,

            filter: false,
            autoWidth: false,
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            ajax: {
                url: '<?php echo base_url('provider/tabel_application') ?>',
                type: 'post',
                data: {
                    id: id
                },
                data: function(data) {}
            },
            language: {
                sProcessing: 'Sedang memproses...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ditemukan data yang sesuai',
                sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
                sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
                sInfoPostFix: '',
                sSearch: 'Cari:',
                sUrl: '',
                oPaginate: {
                    sFirst: '<<',
                    sPrevious: '<',
                    sNext: '>',
                    sLast: '>>'
                }
            },
            // order: [1, 'asc'],
            columns: [
                // {'data':'no'},
                {
                    'data': 'isi_lowongan',
                    orderable: false
                },
            ],
            //   columnDefs: [
            //   {
            //     targets: [0,2,-1],
            //     className: 'text-center'
            // },
            // ]

        });
    }
    $('#show_data').on('click', '.item_hapus_lowongan', function() {
        let id = $(this).attr('data');
        $('#ModalHapusBookmark').modal('show');
        $('#lowongan_tersimpan_id_hapus').val(id);
    });
</script>