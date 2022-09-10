<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <h1 class="h3 mb-2 text-gray-800">Data Kebijakan Privasi</h1>
    <p class="mb-4"></p>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php
                    if ($kp_all == false || $kp_seeker == false || $kp_provider == false) { ?>
                        <button class="btn btn-danger" onclick="add_kp()"><i class="fas fa-plus-circle"></i> Tambah</button>
                    <?php }
                    ?>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
                    <hr>
                    <div class="table-responsive">
                        <table id="tabel_kp" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-danger text-light text-center">
                                    <th>No</th>
                                    <th>Tipe</th>
                                    <th>Isi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_kp" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_kp" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label ">Tipe</label>
                            <div class="">
                                <select name="kp_tipe" id="kp_tipe" class="form-control">
                                    <option value="">--Pilih Tipe--</option>
                                    <option value="0">All</option>
                                    <option value="1">Seeker</option>
                                    <option value="2">Provider</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Masukan Kebijakan Privasi</label>
                            <div class="">
                                <textarea type="text" class="form-control summernote" name="kp_text" id="kp_text" rows="5"></textarea>
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
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_kp_lihat" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">header</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="kp_text_lihat"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        $('.summernote').summernote({
            placeholder: 'Deskripsi',
            tabsize: 2,
            height: 350,
            toolbar: [
                ['para', ['ul', 'ol', 'paragraph']],
            ],
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage('misi', image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        });
        //datatables
        table = $('#tabel_kp').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('kebijakan_privasi/tabel_kp') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //last column
                "orderable": false, //set not orderable
            }, {
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }, ],

        });

    });



    function add_kp() {
        save_method = 'add';
        $('#form_kp')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_kp').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Kebijakan Privasi'); // Set Title to Bootstrap modal title
        $('[name="kp_text"]').summernote('code', "");

    }

    function edit_kp(id) {
        save_method = 'update';
        $('#form_kp')[0].reset(); // reset form on modals
        $('.form-contorl').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('kebijakan_privasi/edit_kp/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.kp_id);
                $('[name="kp_tipe"]').val(data.kp_tipe);
                $('[name="kp_text"]').summernote('code', data.kp_isi);
                $('#modal_kp').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Kebijakan Privasi'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function save() {
        $('#btnSave').text('sedang meyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('kebijakan_privasi/kp_add') ?>";
        } else {
            url = "<?php echo site_url('kebijakan_privasi/kp_update') ?>";
        }

        var formData = new FormData($('#form_kp')[0]);
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
                    $('#modal_kp').modal('hide');
                    reload_table();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    })
                } else {
                    $('#kp_tipe').removeClass("is-invalid");
                    if ($('#kp_tipe').val() != "") {
                        $('#kp_tipe').addClass("is-valid");
                    }
                    $('#kp_text').removeClass("is-invalid");
                    if ($('#kp_text').val() != "") {
                        $('#kp_text').addClass("is-valid");
                    }
                    $('.help-block').empty(); //select span help-block class set text error string

                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oopss...',
                            text: 'Ada data yang belum disi atau tidak sesuia',
                        })
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }


    function lihat_kp(id) {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('kebijakan_privasi/lihat_kp/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal_kp_lihat').modal('show');
                $('.modal-title').text('Kebijakan Privasi'); // Set title to Bootstrap modal title
                $('#kp_text_lihat').html(data.kp_isi);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>