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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Master Data Kategori Pekerjaan</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Data Kategori Pekerjaan</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_job_kategori"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-danger text-light text-center">
                  <th width="1%">No</th>
                  <th width="54%">Kategori Pekerjaan</th>
                  <th width="25%">Icon</th>
                  <th width="10%">Status</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>

              </thead>
              <tbody id="show_data">
              </tbody>



            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_kategori" tabindex="-1" role="dialog" aria-labelledby="modal_kategoriLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" >
              <div class="modal-header bg-danger text-light"> 
                <h3 class="modal-title" id="label_header_user"> <i class="fas fa-database mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_kategori" method="post" enctype="multipart/form-data" action="<?php echo base_url('job/simpan_kategori') ?>">
                 <div class="row "> 
                  <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="user_nama">Nama Kategori</label>
                   <input type="hidden" name="kategori_id" id="kategori_id">
                   <input type="text" class="form-control" id="kategori_nama"  name="kategori_nama" required>
                 </div>   
                 
                 <div class="col-md-12 mb-3"> 
                  <label class="imagecheck">Icon
                   <input type="hidden" name="lampiran_kategori_lama" id="lampiran_kategori_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_kategori" id="lampiran_kategori" onchange="previewFile(this.id)">
                   <figure class="imagecheck-figure">
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_kategori">
                  </figure>
                </label>
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
      <div class="modal-header bg-danger text-light">
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-info mr-2"></i> Status Kategori</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <input type="hidden" name="kode_kategori_aktivasi" id="kode_kategori_aktivasi" value=""> 
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



  dataTable = $('#tabel_job_kategori').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('job/tabel_job_kategori')?>',
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
  columns: [
  {'data':'no'},
  {'data':'kategori_nama'},
  {'data':'kategori_icon'},
  {'data':'kategori_status'},
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,2,3,-1],
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

  function previewFile(id) {
    let file = $('#'+id)[0].files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      $('#preview_'+id).attr('src',reader.result);
    }, false);
    if (file) {
      reader.readAsDataURL(file);
    }
  }


  $('#btn_aktivasi').on('click',function(){
    var kode=$('#kode_kategori_aktivasi').val();
    var isi=$('#isi_aktivasi').val();

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('job/aktivasi_kategori')?>",
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

            text:'Kategori Berhasil Di '+ pesan,
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

  $('#show_data').on('click','.item_aktivasi_job_kategori',function(){
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan Kategori... ?');
      $('#isi_aktivasi').val(1);

    }else{
      $('.notif_aktivasi').html('Nonaktifkan Kategori... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode= $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_kategori_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_job_kategori',function(){
    let kategori_id = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('job/detail_kategori')?>",
      dataType : "JSON",
      data : {'kategori_id':kategori_id},
      success: function(data){

        $('#modal_kategori').modal('show');
        $('#form_kategori').attr('action','<?php echo base_url('job/ubah_kategori') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_user').html('<i class="fas fa-database mr-2"></i> UBAH KATEGORI PEKERJAAN');
        $('#kategori_id').val(kategori_id);
        $('#kategori_nama').val(data[0].kategori_nama);
        $('#lampiran_kategori_lama').val(data[0].kategori_icon);
        if(data[0].kategori_icon!='')
        {
          $('#preview_lampiran_kategori').attr('src','<?php echo base_url()?>'+data[0].kategori_icon);
        }
      },
    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_kategori').modal('show');
    $('#form_kategori').attr('action','<?php echo base_url('job/simpan_kategori') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_kategori').trigger("reset");
    $('#preview_lampiran_kategori').attr('src','<?php echo base_url()?>assets/img/img03.jpg');
    $('#label_header_user').html('<i class="fas fa-database mr-2"></i> TAMBAH KATEGORI PEKERJAAN');
  });



  $('#btn_simpan').on('click',function(){
    let kategori_nama = $('#kategori_nama').val();
    if (kategori_nama=="") {
      $('#kategori_nama').focus();
      Swal.fire({
        title:'Nama Kategori Kosong',
        text:'Silahkan Masukkan Nama Kategori!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

    let link = $('#form_kategori').attr('action');
    if (link.includes('simpan')) {

     let lampiran_kategori = $('#lampiran_kategori').val();
     if (lampiran_kategori=='') {
       $('#lampiran_kategori').focus();
       Swal.fire({
        title:'Icon Kosong',
        text:'Silahkan Upload Icon!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
  }

  $('#btn_simpan').attr('disabled','disabled');
  $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

  $('#form_kategori').submit();

});


</script>













