<style type="text/css">
    #tabel_saved_job td {
        border-top: #e3e6f000;
        padding: 0px;

    }

    #tabel_saved_job {
        border-collapse: separate;
        border-spacing: 2em;
    }

    #tabel_saved_job thead {
        border-top: #e3e6f000;
        display: none;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid p-5 flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <h1 class="h3 mb-0 text-gray-800">Saved Job</h1>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="table-responsive">

                <table id="tabel_saved_job" class="table " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                    <tbody id="show_data">

                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
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


        dataTable = $('#tabel_saved_job').DataTable({
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
                url: '<?php echo base_url('seeker/tabel_saved_job') ?>',
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


        function table_data() {
            dataTable.ajax.reload(null, true);
        }


        $(".refresh").click(function() {
            location.reload();
        });

    });

    $('#show_data').on('click', '.item_hapus_lowongan', function() {
        let id = $(this).attr('data');
        $('#ModalHapusBookmark').modal('show');
        $('#lowongan_tersimpan_id_hapus').val(id);
    });
</script>

<div class="modal fade" data-backdrop="static" id="ModalHapusBookmark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-bookmark mr-2"></i>Saved Job</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('seeker/hapus_bookmark') ?>">
                <div class="modal-body">
                    <input type="hidden" name="lowongan_tersimpan_id_hapus" id="lowongan_tersimpan_id_hapus" value="">
                    <div class="alert alert-danger">
                        <p class="">Hapus Pekerjaan yang disimpan?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
                    <button class="btn_hapus_bookmark btn btn-success btn-flat" type="submit" id="btn_hapus_bookmark"><i class="fas fa-check mr-2"></i>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>