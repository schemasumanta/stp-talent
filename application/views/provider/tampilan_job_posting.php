<style type="text/css">
    #tabel_job_posting td{
     border-top: #e3e6f000;
     padding: 0px;

 }
 #tabel_job_posting{
     border-collapse:separate; 
     border-spacing:2em;
 }

 #tabel_job_posting thead{
     border-top: #e3e6f000;
     display: none;
 }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div class="container-fluid p-5 flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
  <!-- Page Heading -->
  <div class="d-sm-flex mb-4">
    <h1 class="h3 mb-0 text-gray-800">Job Posting</h1>
  </div>
  <div class="row">
    <div class="col-sm-12 mb-3"> 
     <!-- Button trigger modal -->
     <button id="btn_tambah"  class="btn btn-success mr-2"  ><i class="fa fa-plus mr-2"></i> Posting Job</button>
     <button id="export" name="export" class="btn btn-danger " onclick="location.reload()"><i class="fas fa-sync-alt mr-2" style=""></i>Refresh Data</button>
   </div>


   <div class="col-xl-12 col-md-12 mb-4">
    <div class="table-responsive">

      <table id="tabel_job_posting"  class="table " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
        <tbody id="show_data">

        </tbody>
      </table>
    </div>


  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>


<!-- modal -->
<div class="modal fade" data-backdrop="static" id="modal_job_posting" role="dialog" aria-labelledby="modal_job_postingLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <form id="form_job_posting" method="post" enctype="multipart/form-data" action="<?php echo base_url('job/simpan_post') ?>">
        <div class="modal-header bg-danger" style="color: #ffff"> 
          <h3 class="modal-title" id="label_header_job_posting" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
         <div class="row "> 
          <div class="col-md-12 mb-3"> 
           <label style="color:#343a40;" for="lowongan_judul">Judul</label>
           <input type="text" class="form-control" name="lowongan_judul" id="lowongan_judul">
           <small class="mt-1 error-lowongan_judul text-danger"></small>

         </div>  

         <div class="col-md-6 mb-3"> 
           <label style="color:#343a40;" for="tanggal_akhir_lowongan">Tanggal Akhir Lowongan</label>
           <input type="date" class="form-control" name="tanggal_akhir_lowongan" id="tanggal_akhir_lowongan" >
           <small class="mt-1 error-tanggal_akhir_lowongan text-danger"></small>

         </div> 


         <div class="col-md-6 mb-3"> 
           <label style="color:#343a40;" for="kategori_id">Kategori</label>
           <select class="form-control" id="kategori_id"  name="kategori_id" style="width: 100%!important">
            <option value="0" selected disabled>Pilih Kategori</option>
            <?php foreach ($kategori as $k): ?>
             <option value="<?php echo $k->kategori_id ?>"><?php echo $k->kategori_nama; ?></option>
           <?php endforeach ?>
         </select>
         <small class="mt-1 error-kategori_id text-danger"></small>

       </div> 
       <div class="col-md-6 mb-3"> 
         <label style="color:#343a40;" for="joblevel_id">Job Level</label>

         <select class="form-control" id="joblevel_id"  name="joblevel_id" style="width: 100%!important">
          <option value="0" selected disabled>Pilih Job Level</option>

          <?php foreach ($joblevel as $jl): ?>
           <option value="<?php echo $jl->joblevel_id ?>"><?php echo $jl->joblevel_nama; ?></option>
         <?php endforeach ?>
       </select>
       <small class="mt-1 error-joblevel_id text-danger"></small>
     </div>


     <div class="col-md-6 mb-3"> 
       <label style="color:#343a40;" for="jabatan_id">Posisi</label>
       <select class="form-control" id="jabatan_id"  name="jabatan_id" style="width: 100%!important">
        <option value="0" selected disabled>Pilih Posisi</option>

        <?php foreach ($jabatan as $jb): ?>
         <option value="<?php echo $jb->jabatan_id ?>"><?php echo $jb->jabatan_nama; ?></option>
       <?php endforeach ?>
     </select>
     <small class="mt-1 error-jabatan_id text-danger"></small>
   </div>

   <div class="col-md-12 mb-3"> 
     <label style="color:#343a40;" for="lowongan_gaji" id="label_gaji">Gaji</label>
     <div class="input-group">
       <div class="input-group" style="width: 45%">
         <span class="input-group-text">Rp</span>
         <input type="text" class="form-control" name="lowongan_gaji_min" id="lowongan_gaji_min" onkeypress="return hanyaAngka(event)" value="0" onfocusout="SeparatorRibuan(this.value,this.id)">
       </div>
       <span class="pembatas d-none" style="width: 10%;text-align: center;">&nbsp;&nbsp;-&nbsp;&nbsp; </span>
       <div class="input-group d-none lowongan_gaji_max" style="width: 45%">
         <span class="input-group-text">Rp</span>
         <input type="text" class="form-control" name="lowongan_gaji_max" id="lowongan_gaji_max" onkeypress="return hanyaAngka(event)" value="0"  onfocusout="SeparatorRibuan(this.value,this.id)">
       </div>
     </div>
     <input type="checkbox" id="rentang_gaji" name="rentang_gaji" class=" mt-3" value="1">
     <label for="rentang_gaji" class="mr-5">Range</label>
     <input type="checkbox" id="rahasiakan" name="rahasiakan" class=" mt-3" value="1">
     <label for="rahasiakan">Dirahasiakan</label>
     <br>
     <small class="mt-1 error-lowongan_gaji_min text-danger"></small>
   </div> 


   <div class="col-md-12 mb-3"> 
     <label style="color:#343a40;" for="lowongan_deskripsi">Deskripsi</label>
     <textarea type="text" class="form-control summernote" name="lowongan_deskripsi" id="lowongan_deskripsi" rows="5"></textarea>
     <small class="mt-1 error-lowongan_deskripsi text-danger"></small>
   </div> 



   <div class="col-md-12 mb-3"> 
     <label style="color:#343a40;" for="lowongan_skill">Skill</label>
     <select class="form-control" id="lowongan_skill"  name="lowongan_skill[]" multiple="multiple" style="width: 100%!important;height: 500px!important">
       <?php foreach ($skill as $sk): ?>
         <option value="<?php echo $sk->skill_id ?>"><?php echo $sk->skill_nama; ?></option>
       <?php endforeach ?>
     </select>
   </div>
 </div>
</div>
<div class="modal-footer">
  <div class="form-group row"class="collapse" id="customer_collapse">
    <div class="col-sm-6">
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">TUTUP</button>
    </div>
    <div class="col-sm-6 float-sm-right">
      <button type="button" class="btn btn-success btn-sm" id="btn_simpan">TAMBAH</button>

    </div>

  </div>



</div>

</form>



</div>
</div>
</div> 


<script type="text/javascript">
  function uploadImage(id,image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
      url: "<?php echo site_url('koperasi/upload_image')?>",
      cache: false,
      contentType: false,
      processData: false,
      data: data,
      type: "POST",
      success: function(url) {
        $('#'+id).summernote("insertImage", url);
      },
      error: function(id,data) {
        console.log(data);
      }
    });
  }
  function deleteImage(src) {
    $.ajax({
      data: {src : src},
      type: "POST",
      url: "<?php echo site_url('koperasi/delete_image')?>",
      cache: false,
      success: function(response) {
      }
    });
  }
  $('#btn_tambah').on('click',function(){
    let perusahaan_id = '<?php echo $this->session->perusahaan_id ?>';
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('job/cek_perusahaan')?>",
      dataType : "JSON",
      data : {'perusahaan_id':perusahaan_id},
      success: function(data){
        console.log(data);
        if (data[0].perusahaan_alamat=="" || data[0].perusahaan_kabkota==0  || data[0].perusahaan_prov==0 || data[0].perusahaan_nama=="" || data[0].perusahaan_logo==null) {

          Swal.fire({
            title:'Profil Perusahaan Belum Lengkap',
            text:'Silahkan Ubah Profil Perusahaan!',
            icon:'error'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
            }
          });
          return false;
        }else{
          $('#modal_job_posting').modal('show');
          $('#form_job_posting').attr('action','<?php echo base_url('job/simpan_post') ?>');
          $('#btn_simpan').html('SIMPAN');
          $('#form_job_posting').trigger("reset");
          $('#label_header_job_posting').html('<i class="fas fa-plus mr-2"></i> Posting Lowongan Pekerjaan');
        }
      }
    });
  });
  $(document).ready(function(){


      dataTable = $('#tabel_job_posting').DataTable( {
        paginationType:'full_numbers',
        processing: true,
        serverSide: true,
        searching: true,

        filter: false,
        autoWidth:false,
        aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ajax: {
            url: '<?php echo base_url('provider/tabel_job_posting')?>',
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
          // {'data':'no'},
          {'data':'isi_lowongan',orderable:false},
          ],   
        //   columnDefs: [
        //   {
        //     targets: [0,2,-1],
        //     className: 'text-center'
        // },
        // ]

    });


      function table_data(){
       dataTable.ajax.reload(null,true);
   }


   $(".refresh").click(function(){
       location.reload();
   });


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

    $('.summernote').summernote({
      placeholder: 'Deskripsi',
      tabsize: 2,
      height: 150,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('misi',image[0]);
        },
        onMediaDelete : function(target) {
          deleteImage(target[0].src);
        }
      }
    });


    $('#kategori_id').select2({
      placeholder:'Pilih Kategori',
      allowClear:true,
      selectOnClose: true,
      dropdownParent : $('#modal_job_posting'),
      tags: true,

    });

    $('#joblevel_id').select2({
      placeholder:'Pilih Job Level',
      allowClear:true,
      selectOnClose: true,
      dropdownParent : $('#modal_job_posting'),
      tags: true,

    });

    $('#jabatan_id').select2({
      placeholder:'Pilih Jabatan',
      allowClear:true,
      selectOnClose: true,
      dropdownParent : $('#modal_job_posting'),
      tags: true,


    });

    $('#lowongan_skill').select2({
      tags: true,
      placeholder:'Pilih Skill',
      allowClear:true,
      dropdownParent : $('#modal_job_posting'),
    });

  });
  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }

  $('#rentang_gaji').on('click',function(){
    if ($(this).prop('checked')) {
      $('#label_gaji').html('Rentang Gaji');
      $('.lowongan_gaji_max').removeClass('d-none');
      $('.pembatas').removeClass('d-none');


    }else{
      $('#label_gaji').html('Rentang Gaji');
      $('.lowongan_gaji_max').addClass('d-none');
      $('.pembatas').addClass('d-none');
    }
  });

  $('#rahasiakan').on('click',function(){
    if ($(this).prop('checked')) {

      $('#label_gaji').html('Gaji');
      $('.lowongan_gaji_max').addClass('d-none');
      $('.pembatas').addClass('d-none');
      $('#lowongan_gaji_min').val(0);
      $('#lowongan_gaji_max').val(0);
      $('#lowongan_gaji_min').attr('disabled','disabled');
      $('#rentang_gaji').prop('checked',false);
      $('#rentang_gaji').attr('disabled','disabled');


    }else{
      $('#lowongan_gaji_min').removeAttr('disabled');
      $('#rentang_gaji').removeAttr('disabled');


    }
  });

  $('#btn_simpan').on('click',function(){
    let cek =0;
    let lowongan_judul = $('#lowongan_judul').val();
    if (lowongan_judul=='') {
      cek++;
      $('.error-lowongan_judul').html('Judul Lowongan Tidak Boleh Kosong');
    }else{
      $('.error-lowongan_judul').html('');
    }

    let tanggal_akhir_lowongan = $('#tanggal_akhir_lowongan').val();
    if (tanggal_akhir_lowongan=='') {
      cek++;
      $('.error-tanggal_akhir_lowongan').html('Tanggal Akhir Lowongan Tidak Boleh Kosong');
    }else{
      let tanggal_sekarang = '<?php echo date('Y-m-d') ?>';
      if (tanggal_akhir_lowongan <= tanggal_sekarang) {
        cek++;
      $('.error-tanggal_akhir_lowongan').html('Tanggal Akhir Lowongan Minimal 1 Hari Kerja');
      }else{
      $('.error-tanggal_akhir_lowongan').html('');
      }
    }

    let kategori_id = $('#kategori_id').val();
    if (kategori_id==null) {
      cek++;
      $('.error-kategori_id').html('Kategori Lowongan Tidak Boleh Kosong');
    }else{
      $('.error-kategori_id').html('');
    }

    let joblevel_id = $('#joblevel_id').val();
    if (joblevel_id==null) {
      cek++;
      $('.error-joblevel_id').html('Level Pekerjaan Tidak Boleh Kosong');
    }else{
      $('.error-joblevel_id').html('');
    }

    let jabatan_id = $('#jabatan_id').val();
    if (jabatan_id==null) {
      cek++;
      $('.error-jabatan_id').html('Posisi Pekerjaan Tidak Boleh Kosong');
    }else{
      $('.error-jabatan_id').html('');
    }
    let cek_range = $('#rentang_gaji').prop('checked');
    let cek_rahasia = $('#rahasiakan').prop('checked');
    if (cek_rahasia==false) {
      let lowongan_gaji_min = $('#lowongan_gaji_min').val();
      if (lowongan_gaji_min==0 || lowongan_gaji_min=='') {
        cek++;
        $('.error-lowongan_gaji_min').html('Gaji Tidak Boleh Kosong');
      }else{
        $('.error-lowongan_gaji_min').html('');
      }

      if (cek_range) {
        let lowongan_gaji_max = $('#lowongan_gaji_max').val();
        if (parseFloat(lowongan_gaji_max) <parseFloat(lowongan_gaji_min)) {
          cek++;
          $('.error-lowongan_gaji_min').html('Rentang Gaji Tidak Valid');
        }else{
          $('.error-lowongan_gaji_min').html('');
        }
      }

    }else{
      $('.error-lowongan_gaji_min').html('');

    }

    if ($('#lowongan_deskripsi').summernote('isEmpty')) {

      $('.error-lowongan_deskripsi').html('Silahkan Masukkan Deskripsi Lowongan');
    }else{
      $('.error-lowongan_deskripsi').html('');
    }
    
    if (cek > 0 ) {
      return false
    }else{
      $('#btn_simpan').attr('disabled','disabled');
      $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');
      $('#form_job_posting').submit();
    }

  });

  function SeparatorRibuan(bilangan,id){
    let angka = bilangan.replace(/\./g,'');
    let sisa  = angka.length % 3;
    awalan  = angka.substr(0, sisa);
    ribuan  = angka.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
      separator = sisa ? '.' : '';
      hasil = awalan + separator + ribuan.join('.');
      $('#'+id).val(hasil);


    }
  }


</script>

