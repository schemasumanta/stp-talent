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
                <div class="card align-items-center d-flex justify-content-center mb-2 mr-2" id="on_klik<?= $key->lowongan_id; ?>">
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
    <hr>
    <div class="table-responsive">

        <table id="tabel_application" class="table " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
            <tbody id="show_data">

            </tbody>
        </table>
    </div>

</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_pelamar" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="javascript:;" id="form_pelamar" class="form-horizontal">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="..." alt="..." id="foto_pelamar" class="img-fluid rounded mb-2 ml-2">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title" id="nama_pelamar">Card title</h5>
                                    <p class="card-text" id="nik_pelamar"></p>
                                    <p class="card-text" id="tempat_tgl_lhr_pelamar"></p>
                                    <p class="card-text" id="jk_pelamar"></p>
                                    <p class="card-text" id="email_pelamar"></p>
                                    <p class="card-text" id="telp_pelamar"></p>
                                    <p class="card-text" id="pendidikan_pelamar"></p>
                                    <p class="card-text" id="alamat_pelamar"></p>
                                    <div id="skill_pelamar">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="" name="id" id="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-4">Pilih</label>
                            <div class="col-md-12">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Assesment</option>
                                    <option value="2">Rejected</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" class="btn btn-primary" onclick="save()">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

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
            bDestroy: true,
            filter: false,
            autoWidth: false,
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            ajax: {
                url: '<?php echo base_url('provider/tabel_application') ?>/' + id,
                type: 'get',
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

    function reload_table() {
        dataTable.ajax.reload(null, true);
    }

    function cek_pelamar(id) {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('provider/cek_pelamar') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(id);
                $('#foto_pelamar').attr('src', data.resume.resume_foto);
                $('#nama_pelamar').text(data.resume.resume_nama_lengkap);
                $('#nik_pelamar').text(data.resume.resume_nik);
                $('#pendidikan_pelamar').text(data.resume.resume_nama_pendidikan_terakhir);
                $('#alamat_pelamar').text(data.resume.resume_alamat_lengkap);
                $('#email_pelamar').text(data.resume.user_email);
                $('#telp_pelamar').text(data.resume.user_telepon);
                $('#tempat_tgl_lhr_pelamar').text(data.resume.resume_tempat_lahir + ", " + data.resume.resume_tanggal_lahir);
                $('#skill_pelamar').empty();
                $.each(data.skill, function(i, v) {
                    $('#skill_pelamar').append(`
                    <span class="badge badge-pill badge-success">` + v.skill_nama + ` - ` + v.skill_level_nama + `</span>
                    `);
                });
                $('#modal_pelamar').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail Pelamar'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        url = "<?php echo site_url('provider/update_pekerjaan') ?>";

        // ajax adding data to database

        var formData = new FormData($('#form_pelamar')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil diupdate'
                    })

                    $('#modal_pelamar').modal('hide');
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: data.error_string[i]
                        })
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "error dicoding silahkan kontak developer"
                });
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
</script>