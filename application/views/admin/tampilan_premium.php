<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <h1 class="h3 mb-2 text-gray-800">Data Premium</h1>
    <p class="mb-4"></p>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6 class="m-0 font-weight-bold text-primary">Data Premium</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn btn-danger" onclick="add_premium()"><i class="fas fa-plus-circle"></i> Tambah</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
                    <hr>
                    <div class="table-responsive">
                        <table id="tabel_premium" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-danger text-light text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                    <th>Harga</th>
                                    <th>Bulan</th>
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
<div class="modal fade" id="modal_premium" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_premium" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label ">Nama</label>
                            <div class="">
                                <input name="premium_nama" id="premium_nama" placeholder="Masukan nama premium" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Tipe</label>
                            <div class="">
                                <select name="premium_tipe" id="premium_tipe" class="form-control">
                                    <option value="">--Pilih Tipe--</option>
                                    <option value="1">Seeker</option>
                                    <option value="2">Provider</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Harga perbulan</label>
                            <div class="">
                                <input type="text" name="premium_harga" id="premium_harga" placeholder="100000" class="form-control" value="" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Berlaku selama berapa bulan</label>
                            <div class="">
                                <input type="number" name="premium_bulan" id="premium_bulan" min="1" placeholder="1" class="form-control" value="" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
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
        table = $('#tabel_premium').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('premium/tabel_premium') ?>",
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
    var rupiah = document.getElementById("premium_harga");
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

    function changeStatus(id) {
        var isChecked = $('#set_active' + id);
        $.ajax({
            type: "POST",

            url: '<?php echo site_url('premium/setStatus') ?>',

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

    function add_premium() {
        save_method = 'add';
        $('#form_premium')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_premium').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Premium'); // Set Title to Bootstrap modal title
    }

    function edit_premium(id) {
        save_method = 'update';
        $('#form_premium')[0].reset(); // reset form on modals
        $('.form-contorl').removeClass('is-invalid'); // clear error class
        $('.form-control').removeClass('is-valid'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('premium/edit_premium/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.premium_id);
                $('[name="premium_nama"]').val(data.premium_nama);
                $('[name="premium_tipe"]').val(data.premium_tipe);
                $('[name="premium_harga"]').val(data.premium_harga);
                $('[name="premium_bulan"]').val(data.premium_bulan);
                $('#modal_premium').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Premium'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('premium/premium_add') ?>";
        } else {
            url = "<?php echo site_url('premium/premium_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_premium').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_premium').modal('hide');
                    reload_table();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan',
                    })
                } else {
                    $('#premium_nama').removeClass("is-invalid");
                    if ($('#premium_nama').val() != "") {
                        $('#premium_nama').addClass("is-valid");
                    }
                    $('#premium_tipe').removeClass("is-invalid");
                    if ($('#premium_tipe').val() != "") {
                        $('#premium_tipe').addClass("is-valid");
                    }
                    $('#premium_harga').removeClass("is-invalid");
                    if ($('#premium_harga').val() != "") {
                        $('#premium_harga').addClass("is-valid");
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

    function delete_premium(id) {
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
                    url: "<?php echo site_url('premium/premium_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        reload_table();
                        Swal.fire(
                            'Berhasil!',
                            'Data berhasil dihapus.',
                            'success'
                        )

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });

            }
        })
    }
</script>