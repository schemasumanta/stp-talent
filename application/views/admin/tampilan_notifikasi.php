<div class="main-panel">
  <div class="content">

    <section class="content-header" >
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Main content -->
    <section class="content flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

      <div class="row">
        <div class="col-12">
          <h1 class="h3 mb-3 ml-5 text-gray-800">Notifikasi</h1>
          <div class="card">
            <div class="card-header">


              <div class="col-sm-12"> 

               <!-- Button trigger modal -->

               <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" ><i class="fa fa-plus mr-2"></i> Notifikasi</button>
               <button id="export" name="export" class="btn btn-sm refresh btn-warning btn-md"  ><i class="fas fa-sync-alt" style="margin-right: 10px"></i>Refresh Data</button>
             </div>
           </div>
           <div class="card-body">
            <div class="table-responsive">

              <table  id="tabel_notifikasi"  class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                <thead>
                  <tr class="bg-danger text-light text-center">
                    <th>No</th>
                    <th >Judul</th>
                    <th >Isi</th>
                    <th >Lampiran</th>
                    <th style="text-align: center;" width="10%" >Opsi</th>
                  </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
              </table>
            </div>
          </div>
          <!-- modal add -->
          <div class="modal fade" data-backdrop="static" id="modal_notifikasi" tabindex="-1" role="dialog" aria-labelledby="modal_notifikasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content" >
               <form id="form_notifikasi" method="post" enctype="multipart/form-data" action="<?php echo base_url('notifikasi/simpan') ?>">
                <div class="modal-header bg-danger text-light"> 
                  <h3 class="modal-title" id="label_header_notifikasi"> <i class="fas fa-bell mr-2"></i> TAMBAH NOTIFIKASI</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">

                 <div class="row "> 
                  <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="notifikasi_judul">Judul</label>
                   <input type="hidden" name="notifikasi_id" id="notifikasi_id">
                   <input type="hidden" name="notifikasi_key" id="notifikasi_key">

                   <input type="text" class="form-control" id="notifikasi_judul"  name="notifikasi_judul" required>
                 </div>  
                 <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="notifikasi_penerima">Penerima</label>
                   <select  class="form-control" id="notifikasi_penerima"  name="notifikasi_penerima">
                     <option value="All">All</option>
                     <option value="Job Seeker">Job Seeker</option>
                     <option value="Job Provider">Job Provider</option>
                   </select>
                 </div>   

                 <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="notifikasi_link">Direct URL</label>
                   <input type="text" class="form-control" id="notifikasi_link"  name="notifikasi_link" required>
                 </div>
                 <div class="col-md-12 mb-3"> 
                   <label style="color:#343a40;" for="notifikasi_isi">Deskripsi</label>
                   <textarea class="form-control" id="notifikasi_isi"  name="notifikasi_isi" rows="6"></textarea> 
                 </div> 
                 <div class="col-md-6 mb-3"> 
                   <input type="hidden" name="lampiran_notifikasi_lama" id="lampiran_notifikasi_lama">
                   <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_notifikasi" id="lampiran_notifikasi">
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

  var files = [];
  document.getElementById("lampiran_notifikasi").addEventListener("change", function(e) {
    files = e.target.files;
    console.log(files);
  });


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



    dataTable = $('#tabel_notifikasi').DataTable( {
      paginationType:'full_numbers',
      processing: true,
      serverSide: true,
      searching: true,

      filter: false,
      autoWidth:false,
      aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      ajax: {
       url: '<?php echo base_url('notifikasi/tabel_notifikasi')?>',
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
  {'data':'notifikasi_judul'},
  {'data':'notifikasi_isi'},
  {'data':'notifikasi_lampiran'},
  {'data':'opsi',orderable:false},

  ],   
  columnDefs: [
  {
    targets: [0,3,-1],
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
      url  : "<?php echo base_url('notifikasi/detail_stp')?>",
      dataType : "JSON",
      data : {'stp_id':stp_id},
      success: function(data){

        $('#modal_notifikasi').modal('show');
        $('#form_notifikasi').attr('action','<?php echo base_url('notifikasi/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('#label_header_notifikasi').html('<i class="fas fa-bell mr-2"></i> UBAH NOTIFIKASI');
        $('#stp_id').val(stp_id);
        $('#notifikasi_judul').val(data[0].notifikasi_judul);
        $('#notifikasi_penerima').val(data[0].notifikasi_penerima);
        $('#stp_pemilik').val(data[0].stp_pemilik);
        $('#stp_telepon').val(data[0].stp_telepon);
        $('#stp_email').val(data[0].stp_email);
        $('#stp_facebook').val(data[0].stp_facebook);
        $('#stp_instagram').val(data[0].stp_instagram);
        $('#stp_website').val(data[0].stp_website);
        $('#stp_alamat').val(data[0].stp_alamat);
        $('#lampiran_notifikasi_lama').val(data[0].stp_logo);
        $('#lampiran_icon_lama').val(data[0].stp_brand_icon);

        if(data[0].stp_logo!='')
        {
          $('#preview_lampiran_notifikasi').attr('src','<?php echo base_url()?>'+data[0].stp_logo);
        }

        if(data[0].stp_brand_icon!='')
        {
          $('#preview_lampiran_icon').attr('src','<?php echo base_url()?>'+data[0].stp_brand_icon);
        }
      },

    });

    return false;
  });


  function uploadImage(id, image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
      url: "<?php echo site_url('cv/upload_image') ?>",
      cache: false,
      contentType: false,
      processData: false,
      data: data,
      type: "POST",
      success: function(url) {
        $('#' + id).summernote("insertImage", url);
      },
      error: function(id, data) {
        console.log(data);
      }
    });
  }

  function deleteImage(src) {
    $.ajax({
      data: {
        src: src
      },
      type: "POST",
      url: "<?php echo site_url('cv/delete_image') ?>",
      cache: false,
      success: function(response) {}
    });
  }


  $('#btn_tambah').on('click',function(){
    $('#modal_notifikasi').modal('show');
    $('#form_notifikasi').attr('action','<?php echo base_url('notifikasi/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_notifikasi').trigger("reset");
    $('#preview_lampiran_notifikasi').attr('src','<?php echo base_url()?>assets/img/img03.jpg');

    $('#label_header_notifikasi').html('<i class="fas fa-bell mr-2"></i> TAMBAH NOTIFIKASI');


    $('#notifikasi_isi').summernote({
      placeholder: 'Isi Notifikasi',
      tabsize: 2,
      height: 150,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('notifikasi_isi', image[0]);
        },
        onMediaDelete: function(target) {
          deleteImage(target[0].src);
        }
      }
    });

  });

  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_simpan').on('click',function(e){

    e.preventDefault();
    let notifikasi_judul = $('#notifikasi_judul').val();
    if (notifikasi_judul=="") {
      $('#notifikasi_judul').focus();
      Swal.fire({
        title:'Judul Kosong',
        text:'Silahkan Masukkan Judul!',
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
    let notifikasi_lampiran =$('#lampiran_notifikasi_lama').val();

    if (files.length  >  0) {
      for (let i = 0; i < files.length; i++) {
        let storage = firebase.storage().ref('talent_hub/notifikasi/' + files[i].name);
        let upload = storage.put(files[i]);
        upload.on(
          "state_changed",
          function progress(snapshot) {},

          function error() {
            $('.error-file-photo').html("Upload File Error");
          },
          function complete() {
            storage
            .getDownloadURL()
            .then(function(url) {
              $('#lampiran_notifikasi_lama').val(url);
              let post = {  
                notifikasi_judul    : $('#notifikasi_judul').val(),  
                notifikasi_isi      : $('#notifikasi_isi').val(),  
                notifikasi_penerima : $('#notifikasi_penerima').val(),  
                notifikasi_link     : $('#notifikasi_link').val(),  
                notifikasi_lampiran : url,  
                notifikasi_order    : $.now(),  
                notifikasi_tanggal  : '<?php echo date('Y-m-d H:i:s') ?>',  
                notifikasi_pengirim : '<?php echo $this->session->user_id ?>',
              };

              let newpost = firebase.database().ref().child('/Notification/').push().key;
              $('#notifikasi_key').val(newpost);

              let update = {};
              update['/Notification/'+newpost+'/'] = post;
              firebase.database().ref().update(update, (error) => {
                if (error) {
                  console.log('Data could not be saved.' + error);
                } else {

                  $('#form_notifikasi').submit();
                }
              });

            })
            .catch(function(error) {
              console.log("error encountered");
            });
          },
          );
      }
    }else{

      let post = {  
        notifikasi_judul    : $('#notifikasi_judul').val(),  
        notifikasi_isi      : $('#notifikasi_isi').val(),  
        notifikasi_penerima : $('#notifikasi_penerima').val(),  
        notifikasi_link     : $('#notifikasi_link').val(),  
        notifikasi_lampiran : notifikasi_lampiran,  
        notifikasi_order    : $.now(),  
        notifikasi_tanggal  : '<?php echo date('Y-m-d H:i:s'); ?>',  
        notifikasi_pengirim : '<?php echo $this->session->user_id ?>',
      };

      let newpost = firebase.database().ref().child('/Notification/').push().key;
      $('#notifikasi_key').val(newpost);

      let update = {};
      update['/Notification/'+newpost+'/'] = post;
      firebase.database().ref().update(update, (error) => {
        if (error) {
          Swal.fire({
          title:'Error',
          text:'Notifikasi Gagal Dikirim!',
          icon:'error'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
            location.reload();
          }
        });
        } else {
         Swal.fire({
          title:'Berhasil',
          text:'Notifikasi Berhasil Dikirim!',
          icon:'success'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
            location.reload();
          }
        });

      
        }
      });

    }


  });


</script>
<div class="col-sm-6 d-none"> 
  <?php  $this->load->view('templates/header'); ?>
</div>












