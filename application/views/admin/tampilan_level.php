<div class="main-panel">
  <div class="content">
   <style type="text/css">
    input[type="file"]{
      opacity: 0 !important;
      padding: 0 !important;
      width: 100%!important;

    }
    .imagecheck-figure > img {
      width: 100%!important;
    }
  </style>

  <section class="content-header" >
    <div class="container-fluid" >
      <div class="row mb-2">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- Main content -->
  <section class="content flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <div class="row">
      <div class="col-12">
        <h1 class="h3 mb-3 ml-5 text-gray-800">Master Data Level</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 
             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Data Level</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_level"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light ">
                  <th width="1%" class="text-center">No</th>
                  <th width="70%">Level</th>
                  <th width="10%">Status</th>
                  <th class="text-center" width="19%" >Opsi</th>
                </tr>

              </thead>
              <tbody id="show_data">
              </tbody>



            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_level" tabindex="-1" role="dialog" aria-labelledby="modal_levelLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_level"> <i class="fas fa-user mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_level" method="post" enctype="multipart/form-data" action="<?php echo base_url('level/simpan') ?>">
                 <div class="row "> 
                  <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="level_nama">Level</label>
                   <input type="hidden" name="level_id" id="level_id">
                   <input type="text" class="form-control" id="level_nama"  name="level_nama" required>
                 </div>   
                 
            </div>

          </div>


          <div class="modal-footer">

            <div class="form-group row"class="collapse" id="customer_collapse">

              <div class="col-sm-6">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><b>TUTUP</b></button>

              </div>

              <div class="col-sm-6 float-sm-right">
                <button type="button" class="btn btn-success" id="btn_simpan"><b>TAMBAH</b></button>

              </div>

            </div>



          </div>

        </form>



      </div>
    </div>
  </div> 


  <!-- /.card-body -->
</div>


<div class="modal fade" data-backdrop="static" id="modal_edit_password" tabindex="-1" role="dialog" aria-labelledby="modal_edit_passwordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" >

      <div class="modal-header bg-info text-light">
        <h5 id="modal_edit_passwordLabel" style="color: white;font-weight:bold; font: sans-serif;"><i class="fas fa-key mr-2"></i>RESET PASSWORD USER</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url() ?>level/reset_password">
          <div class="form-group row"class="collapse" id="customer_collapse">
            <div class="col-md-12 mb-3">

              <input type="hidden" class="form-control" id="id_user_password"  name="id_user_password" required >

              <div class="alert-danger alert">
                <p>Reset Password User... ?</p>
                <p class="fw-bold mt-2">Password Default : <b>12345678</b></p>
              </div>
            </div>

          </div>

        <div class="modal-footer">

          <div class="form-group row"class="collapse" id="customer_collapse">

            <div class="col-sm-12 btn-group">
              <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><b>BATAL</b></button>

              <button type="submit" class="btn btn-success" id="btn_reset_password"><b>RESET</b></button>

            </div>

          </div>



        </div>


        </form>


      </div>
    </div>
  </div> 


  <!-- /.card-body -->
</div>


</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
</div>
<div class="modal fade" data-backdrop="static" id="ModalAktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-database mr-2"></i> Status Level</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <input type="hidden" name="kode_level_aktivasi" id="kode_level_aktivasi" value=""> 
        <input type="hidden" name="isi_aktivasi" id="isi_aktivasi" value="">  

        <div class="alert alert-danger"><p class="notif_aktivasi"></p></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
        <button class="btn_aktivasi btn btn-success btn-flat" id="btn_aktivasi"><i class="fas fa-check mr-2"></i>YA</button>
      </div>


    </form>
  </div>
</div>
</div>
<script type="text/javascript">




  $(document).ready(function(){

   const notif = $('.flashdatart').data('title');
   if (notif) {
    Swal.fire({
      title:notif,
      text:$('.flashdatart').data('text'),
      icon:$('.flashdatart').data('icon'),
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close(); 

      }
    });
  }



  dataTable = $('#tabel_level').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('level/tabel_level')?>',
     type: 'get',
     data: function (data) {
     }
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
  order: [1, 'asc'],
  columns: [
  {'data':'no'},
  {'data':'level_nama'},
  {'data':'level_status'},
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,2,-1],
    className: 'text-center'
  },
  ]

});


  function table_data(){
   dataTable.ajax.reload(null,true);
 }


 $(".refresh").click(function(){
   location.reload();
 });

});


  $('#btn_aktivasi').on('click',function(){
    var kode=$('#kode_level_aktivasi').val();
    var isi=$('#isi_aktivasi').val();

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('level/aktivasi')?>",
      dataType : "JSON",
      data : {'kode': kode,'isi': isi},
      success: function(data){
        let pesan='';
        if (data) {
          if (isi==1) {
            pesan = "Diaktifkan";
          }else{
            pesan = "DiNonaktifkan";
          }
          Swal.fire({
            title:'Berhasil',

            text:'Level Berhasil '+ pesan,
            icon:'success'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
              $('#ModalAktivasi').modal('hide');

              location.reload();

            }
          });
        }


      }
    });
    return false;
  });

  $('#show_data').on('click','.item_aktivasi_level',function(){
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan Level... ?');
      $('#isi_aktivasi').val(1);

    }else{
      $('.notif_aktivasi').html('Nonaktifkan Level... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode= $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_level_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_level',function(){
    let level_id = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('level/detail_level')?>",
      dataType : "JSON",
      data : {'level_id':level_id},
      success: function(data){

        $('#modal_level').modal('show');
        $('#form_level').attr('action','<?php echo base_url('level/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_level').html('<i class="fas fa-database mr-2"></i> UBAH DATA LEVEL');
        $('#level_id').val(level_id);
        $('#level_nama').val(data[0].level_nama);
      },
    });
    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_level').modal('show');
    $('#form_level').attr('action','<?php echo base_url('level/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');
    $('#form_level').trigger("reset");
    $('#label_header_level').html('<i class="fas fa-database mr-2"></i> TAMBAH DATA LEVEL');
  });


  $('#btn_simpan').on('click',function(){

    let level_nama = $('#level_nama').val();
    if (level_nama=="") {
      $('#level_nama').focus();
      Swal.fire({
        title:'Level Kosong',
        text:'Silahkan Masukkan Level!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

      $('#btn_simpan').attr('disabled','disabled');
      $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');
      $('#form_level').submit();

});


</script>













