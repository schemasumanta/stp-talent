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
        <h1 class="h3 mb-3 ml-5 text-gray-800">Master Data User</h1>
        <div class="card">
          <div class="card-header">
            <div class="col-sm-6"> 
            </div>
            <div class="col-sm-12"> 

             <!-- Button trigger modal -->
             <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Tambah Data User</button>
             <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>

           </div>
           
         </div>
         <div class="card-body">
          <div class="table-responsive">

            <table  id="tabel_user"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
              <thead>
                <tr class="bg-primary text-light text-center">
                  <th>No</th>
                  <th >Nama Lengkap</th>
                  <th >Email</th>
                  <th >Level</th>
                  <th >Telepon</th>
                  <th >Foto</th>
                  <th >Status</th>
                  <th style="text-align: center;" width="10%" >Opsi</th>
                </tr>

              </thead>
              <tbody id="show_data">
              </tbody>



            </table>
          </div>
        </div>

        <!-- modal add -->


        <div class="modal fade" data-backdrop="static" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="modal_userLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header bg-primary text-light"> 
                <h3 class="modal-title" id="label_header_user"> <i class="fas fa-user mr-2"></i> TAMBAH DATA USER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              </div>
              <div class="modal-body">
               <form id="form_user" method="post" enctype="multipart/form-data" action="<?php echo base_url('user/simpan') ?>">
                 <div class="row "> 
                  <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="user_nama">Nama Lengkap</label>
                   <input type="hidden" name="id_user" id="id_user">
                   <input type="text" class="form-control" id="user_nama"  name="user_nama" required>
                 </div>   
                 
                <div class="col-md-6 mb-3"> 
                  <label style="color:#343a40;vertical-align:middle;" for="user_level">Level</label> 
                  <select type="text" class="form-control" id="user_level" name="user_level" required>
                    <option value="0" selected="selected" disabled="disabled">Pilih Level</option>
                    <?php foreach ($level as $key): ?>
                     
                    <option value="<?php $key->level_id ?>"><?php echo $key->level_nama; ?></option>
                    <?php endforeach ?>

                  </select>   
                </div>
                <div class="col-md-6 mb-3"> 
                   <label style="color:#343a40;" for="user_telepon">Telepon</label>
                   <input type="text" class="form-control" id="user_telepon"  name="user_telepon" required onkeypress="return hanyaAngka(event)">
                 </div>   


                <div class="col-md-6 mb-3">  
                  <label style="color:#343a40;" for="user_email">Email</label> 
                  <input type="email" class="form-control " id="user_email"  name="user_email" >
                </div> 

                <div class="col-md-6  mb-3 inputpassword"> 
                  <label for="pwd1">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                    <div class="input-group-addon password mr-2 ml-2 pt-2" style="cursor: pointer;" onclick="show_password('password')"><i class="fa fa-eye"></i></div>

                  </div>
                </div> 
                <div class="col-md-3 mb-3"> 
                  <label for="foto-produk">Foto</label>
                  <label class="imagecheck">
                   <input type="hidden" name="lampiran_user_lama" id="lampiran_user_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_user" id="lampiran_user" onchange="previewFile(this.id)">
                   <figure class="imagecheck-figure">
                    <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_user">
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


<div class="modal fade" data-backdrop="static" id="modal_edit_password" tabindex="-1" role="dialog" aria-labelledby="modal_edit_passwordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" >

      <div class="modal-header bg-info text-light">
        <h5 id="modal_edit_passwordLabel" style="color: white;font-weight:bold; font: sans-serif;"><i class="fas fa-key mr-2"></i>RESET PASSWORD USER</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url() ?>user/reset_password">
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
       <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-users mr-2"></i> Status User</h3>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

     </div>
     <form class="form-horizontal">
      <div class="modal-body">

        <input type="hidden" name="kode_user_aktivasi" id="kode_user_aktivasi" value=""> 
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



  dataTable = $('#tabel_user').DataTable( {
    paginationType:'full_numbers',
    processing: true,
    serverSide: true,
    searching: true,

    filter: false,
    autoWidth:false,
    aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: {
     url: '<?php echo base_url('user/tabel_user')?>',
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
  {'data':'user_nama'},
  {'data':'user_email'},
  {'data':'level_nama'},
  {'data':'user_telepon'},
  {'data':'user_foto'},
  {'data':'user_status'},               
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,4,-1],
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

  function show_password(id)
  {
    if($('#'+id).attr('type')=="password")
    {
      $('#'+id).attr('type','text');
      $('.'+id).html('<i class="fa fa-eye-slash"></i>');
    }else{
      $('#'+id).attr('type','password');
      $('.'+id).html('<i class="fa fa-eye"></i>');

    }
  }


  $('#btn_aktivasi').on('click',function(){
    var kode=$('#kode_user_aktivasi').val();
    var isi=$('#isi_aktivasi').val();

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('user/aktivasi_user')?>",
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

            text:'User Berhasil Di '+ pesan,
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

  $('#show_data').on('click','.item_aktivasi_user',function(){
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan User... ?');
      $('#isi_aktivasi').val(1);

    }else{
      $('.notif_aktivasi').html('Nonaktifkan User... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode= $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_user_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click','.item_edit_user',function(){
    let id_user = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('user/detail_user')?>",
      dataType : "JSON",
      data : {'id_user':id_user},
      success: function(data){

        $('#modal_user').modal('show');
        $('#form_user').attr('action','<?php echo base_url('user/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('.inputpassword').addClass('d-none');
        $('#label_header_user').html('<i class="fas fa-user mr-2"></i> UBAH DATA USER');
        $('#id_user').val(id_user);
        $('#user_nama').val(data[0].nama);
        $('#level').val(data[0].level).trigger('change');
        $('#cabang').val(data[0].id_cabang).trigger('change');
        $('#jabatan').val(data[0].id_jabatan).trigger('change');
        $('#email').val(data[0].email);
        $('#username').val(data[0].username);
        $('#telepon').val(data[0].telepon);
        $('#username_lama').val(data[0].username);
        $('#lampiran_user_lama').val(data[0].foto);
        if(data[0].foto!='')
        {
          $('#preview_lampiran_user').attr('src','<?php echo base_url()?>'+data[0].foto);
          
        }
      },

    });

    return false;
  });

  $('#btn_tambah').on('click',function(){
    $('#modal_user').modal('show');
    $('#form_user').attr('action','<?php echo base_url('user/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_user').trigger("reset");
    $('#preview_lampiran_user').attr('src','<?php echo base_url()?>assets/img/img03.jpg');

    $('.inputpassword').removeClass('d-none');
    $('#label_header_user').html('<i class="fas fa-user mr-2"></i> TAMBAH DATA USER');
  });


  $('#show_data').on('click','.item_edit_password',function(){
    var kode=$(this).attr('data');
    $('#modal_edit_password').modal('show');
    $('#id_user_password').val(kode);
    return false;
  });


function hanyaAngka(event) {
  var angka = (event.which) ? event.which : event.keyCode
  if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
    return false;
  return true;
}


  $('#btn_ubah_password').on('click',function(){
    let id_user   =   $('#id_user_password').val();
    let password  =   $('#password_baru').val();
    let confirm   =   $('#confirm_password').val();

    if (password=="") {
      $('#password_baru').focus();
      Swal.fire({
        title:'Password Baru Kosong',
        text:'Silahkan Masukkan Password Baru!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;

    }

    if (password!==confirm) {
      $('#confirm_password').focus();
      $('#confirm_password').val('');

      Swal.fire({
        title:'Konfirmasi Password Tidak Cocok',
        text:'Silahkan Masukkan Ulang Konfirmasi Password!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;

    }

    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('user/ubah_password')?>",
      dataType : "JSON",
      data : {'id_user':id_user, 'password':password},
      success: function(data){

        if (data) {

         Swal.fire({
          title:'Berhasil',
          text:'Password Berhasil Diubah',
          icon:'success'


        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
            $('#modal_edit_password').modal('hide');
            location.reload();

          }
        });
      } else{

       Swal.fire({
        title:'Gagal',
        text:'Password Gagal Diubah',
        icon:'error'


      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
          $('#modal_edit_password').modal('hide');
          location.reload();

        }
      });

    }



  }
});
    return false;
  });

  $('#btn_simpan').on('click',function(){

    let user_nama = $('#user_nama').val();
    if (user_nama=="") {
      $('#user_nama').focus();
      Swal.fire({
        title:'Nama Kosong',
        text:'Silahkan Masukkan Nama!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }



     let user_level = $('#user_level').val();
    if (user_level==null) {
     $('#user_level').focus();
     Swal.fire({
      title:'Level Kosong',
      text:'Silahkan Pilih Level!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });
    return false;
  }

  // let user_telepon = $('#user_telepon').val();
  // if (user_telepon=="") {
  //   $('#user_telepon').focus();
  //   Swal.fire({
  //     title:'Telepon Kosong',
  //     text:'Silahkan Masukkan Telepon!',
  //     icon:'error'
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       Swal.close();
  //     }
  //   });
  //   return false;
  // }


  let user_email = $('#user_email').val();
  if (user_email=="") {
      $('#user_email').focus();
      Swal.fire({
        title:'Email Kosong',
        text:'Silahkan Masukkan Email!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }else{

    let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (!testEmail.test(user_email))
    {
     $('#user_email').focus();
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
let cek = 0;
$.ajax({
  type : "GET",
  url  : "<?php echo base_url('user/cek_email')?>",
  dataType : "JSON",
  data : {'user_email': user_email},
  success: function(data){
   let link = $('#form_user').attr('action');
   if (link.includes('simpan')) {
    if (data > 0) {
      cek+=1;
      $('#username').focus();
      Swal.fire({
        title:'Username Sudah Digunakan',
        text:'Silahkan Masukkan Username Lain!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });

      return false;

    }

    else{

     let password = $('#password').val();
     if (password=="") {
      cek +=1;
      $('#password').focus();
      Swal.fire({
        title:'Password Kosong',
        text:'Silahkan Masukkan Password!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
    else{

      $('#btn_simpan').attr('disabled','disabled');
      $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

      $('#form_user').submit();
    }

  }

} else{

  let username_lama = $('#username_lama').val();

  if (data > 0 && username_lama!=username) {
    $('#username_lama').focus();
    Swal.fire({
      title:'Username Sudah Digunakan',
      text:'Silahkan Masukkan Username Lain!',
      icon:'error'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close();
      }
    });

    return false;


  }else{
    $('#btn_simpan').attr('disabled','disabled');
    $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');


    $('#form_user').submit();
  }

}


}

});

});


</script>













