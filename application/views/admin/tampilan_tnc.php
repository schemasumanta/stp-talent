<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <h1 class="h3 mb-2 text-gray-800">Data T&C</h1>
    <p class="mb-4"></p>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6 class="m-0 font-weight-bold text-primary">Data T&C Pendaftaran</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn btn-danger" onclick="add_tnc()"><i class="fas fa-plus-circle"></i> Tambah</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
                    <hr>
                    <div class="table-responsive">
                        <table id="tabel_tnc" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-danger text-light text-center">
                                    <th>No</th>
                                    <th>Diterbitkan pada</th>
                                    <th>Tipe</th>
                                    <th>Link</th>
                                    <th>Status</th>
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
<div class="modal fade" id="modal_tnc" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_tnc" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipe</label>
                            <div class="col-md-9">
                                <select name="tnc_tipe" id="tnc_tipe" class="form-control">
                                    <option value="">--Pilih Tipe--</option>
                                    <option value="1">Seeker</option>
                                    <option value="2">Provider</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Terbit</label>
                            <div class="col-md-9">
                                <input type="date" name="tnc_terbit" id="tnc_terbit" class="form-control" value="" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">File</label>
                            <div class="col-md-9">
                                <input type="file" name="tnc_file" id="tnc_file" class="form-control" value="" />
                                <input type="hidden" name="tnc_firebase" id="tnc_firebase" class="form-control" value="" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tabel_tnc').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tnc/tabel_tnc') ?>",
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

    document.getElementById('btnSave').addEventListener('click', function() {
        var file = document.getElementById('tnc_file').files[0];
        console.log(file)
        if (file != null) {
            console.log(file.name);
            var storage = firebase.storage().ref('talent_hub/tnc/' + file.name);
            var upload = storage.put(file);

            upload.on('state_changed', function(snapshot) {
                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                console.log("upload is " + progress + " done");
            }, function(error) {
                console.log(error.message);
            }, function() {
                upload.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                    console.log(downloadURL);
                    if (save_method == "add") {
                        $('#tnc_firebase').val(downloadURL);
                    } else {
                        let file_tnc = $('#tnc_firebase').val();
                        if (file_tnc != '') {
                            const myfile = firebase.storage();
                            myfile.refFromURL(file_tnc).delete()
                        }
                        $('#tnc_firebase').val(downloadURL);
                    }
                    save();
                })
            })
        } else {
            save();
        }
    })


    function changeStatus(id) {
        var isChecked = $('#set_active' + id);
        $.ajax({
            type: "POST",

            url: '<?php echo site_url('tnc/setStatus') ?>',

            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
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

                if (response.status) {
                    isChecked.next().text($(isChecked).is(':checked') ? 'Aktif' : 'Nonaktif');
                    Toast.fire({
                        icon: 'success',
                        title: 'Ubah status berhasil'
                    })
                } else {
                    isChecked.prop('checked', isChecked.is(':checked') ? null : 'checked');
                    Toast.fire({
                        icon: 'warning',
                        title: 'Ubah status gagal'
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                isChecked.prop('checked', isChecked.is(':checked') ? null : 'checked');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "error dicoding silahkan kontak developer"
                });
            },
        });
    }

    function add_tnc() {
        save_method = 'add';
        $('#form_tnc')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_tnc').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah tnc'); // Set Title to Bootstrap modal title
    }

    function edit_tnc(id) {
        save_method = 'update';
        $('#form_tnc')[0].reset(); // reset form on modals
        $('.form-contorl').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('tnc/edit_tnc/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.tnc_id);
                $('[name="tnc_terbit"]').val(data.tnc_terbit_pada);
                $('[name="tnc_tipe"]').val(data.tnc_tipe);
                $('#modal_tnc').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit T&N'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('tnc/tnc_add') ?>";
        } else {
            url = "<?php echo site_url('tnc/tnc_update') ?>";
        }

        var formData = new FormData($('#form_tnc')[0]);
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
                    $('#modal_tnc').modal('hide');
                    reload_table();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    })
                } else {
                    $('#tnc_terbit').removeClass("is-invalid");
                    if ($('#tnc_terbit').val() != "") {
                        $('#tnc_terbit').addClass("is-valid");
                    }
                    $('#tnc_tipe').removeClass("is-invalid");
                    if ($('#tnc_tipe').val() != "") {
                        $('#tnc_tipe').addClass("is-valid");
                    }
                    $('#tnc_file').removeClass("is-invalid");
                    if ($('#tnc_file').val() != "") {
                        $('#tnc_file').addClass("is-valid");
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

    function delete_tnc(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak datap dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('tnc/tnc_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == true) {
                            //if success reload ajax table
                            reload_table();
                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil dihapus.',
                                'success'
                            )
                        } else {
                            //if success reload ajax table
                            reload_table();
                            Swal.fire(
                                'Maaf tidak bisa hapus',
                                data.notif,
                                'info'
                            )
                        }


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });

            }
        })
    }
</script>