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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Profil Solo Techno Park</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <?php if ($profil < 1) { ?>

               <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Profil STP</button>
             <?php } ?>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_stp"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th>No</th>
                  <th >Nama Aplikasi</th>
                  <th >Pemilik</th>
                  <th >Email</th>
                  <th >Telepon</th>
                  <th >Logo</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_stp" tabindex="-1" role="dialog" aria-labelledby="modal_stpLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_stp"> <i class="fas fa-building mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_stp" method="post" enctype="multipart/form-data" action="<?php echo base_url('stp/simpan') ?>">
                 <div class="row "> 
                  <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="stp_nama">Nama Aplikasi</label>
                   <input type="hidden" name="stp_id" id="stp_id">
                   <input type="text" class="form-control" id="stp_nama"  name="stp_nama" required>
                 </div>  
                 <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="stp_tagline">Tagline</label>
                   <input type="text" class="form-control" id="stp_tagline"  name="stp_tagline">
                 </div>   

                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_telepon">Telepon</label>
                   <input type="text" class="form-control" id="stp_telepon"  name="stp_telepon">
                 </div>  

                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_email">Email</label>
                   <input type="text" class="form-control" id="stp_email"  name="stp_email">
                 </div>   


                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_pemilik">Pemilik</label>
                   <input type="text" class="form-control" id="stp_pemilik"  name="stp_pemilik">
                 </div>   


                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_facebook">Facebook</label>
                   <input type="text" class="form-control" id="stp_facebook"  name="stp_facebook">
                 </div>   

                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_instagram">Instagram</label>
                   <input type="text" class="form-control" id="stp_instagram"  name="stp_instagram">
                 </div>   
                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_website">Website</label>
                   <input type="text" class="form-control" id="stp_website"  name="stp_website">
                 </div> 


                 <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="stp_alamat">Alamat</label>
                   <textarea class="form-control" id="stp_alamat"  name="stp_alamat" rows="6"></textarea> 
                 </div>  

                 <div class="col-md-3 mb-3"> 
                  <label class="imagecheck">Logo
                   <input type="hidden" name="lampiran_stp_lama" id="lampiran_stp_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_stp" id="lampiran_stp" onchange="previewFile(this.id)">
                   <figure class="imagecheck-figure">
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_stp">
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



  dataTable = $('#tabel_stp').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('stp/tabel_stp')?>',
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
  // order: [1, 'asc'],
  columns: [
  {'data':'no'},
  {'data':'stp_nama'},
  {'data':'stp_pemilik'},
  {'data':'stp_email'},
  {'data':'stp_telepon'},
  {'data':'stp_logo'},
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,4,5,-1],
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


  $('#show_data').on('click','.item_edit_stp',function(){
    let stp_id = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('stp/detail_stp')?>",
      dataType : "JSON",
      data : {'stp_id':stp_id},
      success: function(data){

        $('#modal_stp').modal('show');
        $('#form_stp').attr('action','<?php echo base_url('stp/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_stp').html('<i class="fas fa-building mr-2"></i> UBAH DATA PROFIL STP');
        $('#stp_id').val(stp_id);
        $('#stp_nama').val(data[0].stp_nama);
        $('#stp_tagline').val(data[0].stp_tagline);
        $('#stp_pemilik').val(data[0].stp_pemilik);
        $('#stp_telepon').val(data[0].stp_telepon);
        $('#stp_email').val(data[0].stp_email);
        $('#stp_facebook').val(data[0].stp_facebook);
        $('#stp_instagram').val(data[0].stp_instagram);
        $('#stp_website').val(data[0].stp_website);
        $('#stp_alamat').val(data[0].stp_alamat);
        $('#lampiran_stp_lama').val(data[0].stp_logo);
        if(data[0].stp_logo!='')
        {
          $('#preview_lampiran_stp').attr('src','<?php echo base_url()?>'+data[0].stp_logo);
        }
      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_stp').modal('show');
    $('#form_stp').attr('action','<?php echo base_url('stp/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_stp').trigger("reset");
    $('#preview_lampiran_stp').attr('src','<?php echo base_url()?>assets/img/img03.jpg');

    $('#label_header_stp').html('<i class="fas fa-building mr-2"></i> TAMBAH DATA PROFIL STP');
  });

  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_simpan').on('click',function(){

    let stp_nama = $('#stp_nama').val();
    if (stp_nama=="") {
      $('#stp_nama').focus();
      Swal.fire({
        title:'Nama Aplikasi Kosong',
        text:'Silahkan Masukkan Nama Aplikasi!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }


    let stp_email = $('#stp_email').val();
    if (stp_email!="") {

      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      if (!testEmail.test(stp_email))
      {
       $('#stp_email').focus();
       Swal.fire({
        title:'Format Email Salah',
        text:'Silahkan Masukkan Email yang Valid!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
  }

  let link = $('#form_stp').attr('action');

  if (link.includes('simpan')) {

      let lampiran_stp = $('#lampiran_stp').val();
    if (lampiran_stp=="") {
      $('#lampiran_stp').focus();
      Swal.fire({
        title:'Logo Kosong',
        text:'Silahkan Upload Logo!',
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
    $('#form_stp').submit();

});


</script>













