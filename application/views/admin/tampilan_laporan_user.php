<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <h1 class="h3 mb-2 text-gray-800">Laporan Data User</h1>
    <p class="mb-4"></p>

    <div class="row">
        <div class="col-md-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Data User</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('user/laporan_user_print'); ?>" method="POST" id="form_laporan_user">
                        <div class="form-group">
                            <label>Dari Tanggal</label>
                            <small class="text-danger"><?php echo form_error('dari_tgl'); ?></small>
                            <input type="date" class="form-control" id="dari_tgl" name="dari_tgl">
                            <small class="form-text text-muted">Harus sebelum tanggal "Sampai Tanggal"</small>
                        </div>
                        <div class="form-group">
                            <label>Sampai Tanggal</label>
                            <small class="text-danger"><?php echo form_error('sampai_tgl'); ?></small>
                            <input type="date" class="form-control" id="sampai_tgl" name="sampai_tgl">
                            <small class="form-text text-muted">Harus sesudah tanggal "Dari Tanggal"</small>
                        </div>
                        <div class="form-group">
                            <label>Sebagai</label>
                            <select name="sebagai" id="sebagai" class="form-control">
                                <option value="all">All User</option>
                                <option value="1">Admin</option>
                                <option value="2">Seeker</option>
                                <option value="3">Provider</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabel_user" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                            <thead>
                                <tr class="bg-danger text-light text-center">
                                    <th>No</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Sebagai</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tabel_user').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('user/tabel_laporan_user') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //last column
                "orderable": false, //set not orderable
            }, ],

        });

    });
</script>