<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <h1 class="h3 mb-2 text-gray-800">Data FAQ</h1>
    <p class="mb-4"></p>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <button class="btn btn-danger" onclick="add_faq()"><i class="fas fa-plus-circle"></i> Tambah</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
                    <hr>
                    <div class="table-responsive">
                        <table id="tabel_faq" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-danger text-light text-center">
                                    <th>No</th>
                                    <th>Tipe</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
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
<div class="modal fade" id="modal_faq" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_faq" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label ">Tipe</label>
                            <div class="">
                                <select name="faq_tipe" id="faq_tipe" class="form-control">
                                    <option value="">--Pilih Tipe--</option>
                                    <option value="0">All</option>
                                    <option value="1">Seeker</option>
                                    <option value="2">Provider</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Masukan Pertanyaan</label>
                            <div class="">
                                <input type="text" class="form-control" name="faq_question" id="faq_question">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Masukan Jawaban</label>
                            <div class="">
                                <textarea type="text" class="form-control summernote" name="faq_answer" id="faq_answer" rows="5"></textarea>
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
<div class="modal fade" id="modal_faq_lihat" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">header</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="faq_question_lihat"></div>

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
        table = $('#tabel_faq').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('faq/tabel_faq') ?>",
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



    function add_faq() {
        save_method = 'add';
        $('#form_faq')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_faq').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah FAQ'); // Set Title to Bootstrap modal title
        $('[name="faq_answer"]').summernote('code', "");

    }

    function edit_kp(id) {
        save_method = 'update';
        $('#form_faq')[0].reset(); // reset form on modals
        $('.form-contorl').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('faq/edit_faq') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.faq_id);
                $('[name="faq_tipe"]').val(data.faq_tipe);
                $('[name="faq_answer"]').summernote('code', data.faq_answer);
                $('[name="faq_question"]').val(data.faq_question);
                $('#modal_faq').modal('show'); // show bootstrap modal when complete loaded
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
            url = "<?php echo site_url('faq/faq_add') ?>";
        } else {
            url = "<?php echo site_url('faq/faq_update') ?>";
        }

        var formData = new FormData($('#form_faq')[0]);
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
                    $('#modal_faq').modal('hide');
                    reload_table();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    })
                } else {
                    $('#faq_tipe').removeClass("is-invalid");
                    if ($('#faq_tipe').val() != "") {
                        $('#faq_tipe').addClass("is-valid");
                    }
                    $('#faq_question').removeClass("is-invalid");
                    if ($('#faq_question').val() != "") {
                        $('#faq_question').addClass("is-valid");
                    }
                    $('#faq_answer').removeClass("is-invalid");
                    if ($('#faq_answer').val() != "") {
                        $('#faq_answer').addClass("is-valid");
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
            url: "<?php echo site_url('faq/lihat_faq/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal_faq_lihat').modal('show');
                $('.modal-title').text('Kebijakan Privasi'); // Set title to Bootstrap modal title
                $('#faq_question_lihat').html(data.kp_isi);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>