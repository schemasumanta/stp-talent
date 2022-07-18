<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="col-xl-10 col-lg-10 col-md-10">
  <!-- Featured_job_start -->
  <section class="featured-job-area">
    <div class="container-fluid  flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
       <h1 class="h3 mb-4 text-gray-800">Curriculum Vitae</h1>
       <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <h6 class="m-0 font-weight-bold text-primary">Data Resume</h6>

                  </div>

              </div>
          </div>
          <div class="card-body">
           <div class="row">
               <div class="col-md-12 col-xl-12">
                <div class="row p-3">
                    <div class="col-xl-8 col-md-8 mb-4 p-3" >
                        <div class="row">

                            <div class="col-md-12 col-xl-12">
                                <span style="font-weight: bold;font-size: 18px">Biodata</span>
                                <hr>
                                <?php if (count($resume) > 0): ?>
                                    <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                                <?php endif ?>
                            </div>
                            <?php if (count($resume) > 0): ?>
                                <?php foreach ($resume as $pp): ?>

                                    <div class="col-md-12 col-xl-12">
                                        <div class="row">

                                            <span class="col-md-3">Nama Lengkap</span>
                                            <span class="col-md-6" style="font-weight: bold;"><?php echo $pp->resume_nama_lengkap; ?></span>
                                        </div>

                                    </div>

                                <?php endforeach ?>

                                <?php else: ?>
                                    <div class="col-md-12 col-xl-12 text-center">
                                     <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="border-radius: 0px" data-toggle="modal" data-target="#ModalProfil"><i class="fas fa-plus mr-2"></i>Tambah Profil</a>
                                 </div>
                             <?php endif ?>
                         </div>
                     </div>

                     <div class="col-md-4 col-xl-4 p-3" style="border: 1px solid #d8d8d8;border-radius: 15px">
                        <div class="row">
                            <div class="col-md-12 col-xl-12 text-center">
                                <span style="font-weight: bold;font-size: 18px;">Resume</span>
                                <hr>
                                <?php if (count($resume) > 0): ?>
                                    <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                                <?php endif ?>
                            </div>
                            <?php if (count($upload_resume) > 0): ?>

                                <div class="col-md-12 col-xl-12">
                                    <span class="col-md-6">Nama Lengkap</span>
                                    <span class="col-md-6"></span>
                                </div>


                                <?php else: ?>
                                    <div class="col-md-12 col-xl-12 text-center">
                                     <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="border-radius: 0px" data-toggle="modal" data-target="#ModalUploadResume"><i class="fas fa-plus mr-2"></i>Upload Resume</a>
                                 </div>
                             <?php endif ?>
                         </div>
                     </div>


                 </div>
             </div>
         </div>
     </div>
 </div>

</div>

</div>



</div>
</div>

<div class="modal fade" data-backdrop="static" id="ModalProfil" tabindex="-1" role="dialog" aria-labelledby="ModalProfilLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header bg-danger"> 
        <h3 class="modal-title"  style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i> TAMBAH PROFIL</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
    </div>
    <div class="modal-body">
     <form id="form_profil" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_resume') ?>">
       <div class="row "> 
          <div class="col-md-8 mb-3"> 
             <label style="color:#343a40;" for="resume_nama_lengkap">Nama Lengkap</label>
             <input type="hidden" name="resume_id" id="resume_id">
             <input type="text" class="form-control" id="resume_nama_lengkap"  name="resume_nama_lengkap" required>
         </div>  
         <div class="col-md-4 mb-3 "> 
             <label style="color:#343a40;" for="resume_jenis_kelamin">Jenis Kelamin</label>
             <br>
             <select class="form-control w-100" id="resume_jenis_kelamin"  name="resume_jenis_kelamin" required>
                 <option value="0" disabled selected>Pilih Jenis Kelamin</option>
                 <option value="L">Laki-Laki</option>
                 <option value="P">Perempuan</option>
             </select> 
         </div> 

         <div class="col-md-3 mb-3"> 
             <label style="color:#343a40;" for="pendidikan_id">Pendidikan</label>
             <br>
             <select class="select2" id="pendidikan_id"  name="pendidikan_id" required>
                 <option value="0" disabled selected>Pilih Pendidikan</option>
                 <?php foreach ($pendidikan as $pd): ?>
                     <option value="<?php echo $pd->pendidikan_id ?>"><?php echo $pd->pendidikan_nama ?></option>
                 <?php endforeach ?>
             </select> 
         </div>
         <div class="col-md-5 mb-3"> 
             <label style="color:#343a40;" for="resume_nama_pendidikan_terakhir">Institusi</label>
             <input type="text" class="form-control" id="resume_nama_pendidikan_terakhir"  name="resume_nama_pendidikan_terakhir" required>
         </div> 
         <div class="col-md-4 mb-3"> 
             <label style="color:#343a40;" for="resume_pendididkan_tahun_lulus">Tahun Lulus</label>
             <input type="text" class="form-control" id="resume_pendididkan_tahun_lulus"  name="resume_pendididkan_tahun_lulus" required maxlength="4" onkeypress="return hanyaAngka(event)">
         </div> 

         <div class="col-md-3 mb-3 "> 
             <label style="color:#343a40;" for="resume_prov">Provinsi</label>
             <br>
             <select class="form-control w-100" id="resume_prov"  name="resume_prov">
                 <option value="0" disabled selected>Pilih Provinsi</option>
                 <?php foreach ($provinsi as $prov): ?>
                     <option value="<?php echo $prov->prov_id ?>"><?php echo $prov->prov_nama ?></option>
                 <?php endforeach ?>
             </select> 
         </div>



     </div>
 </div>


 <div class="modal-footer">

    <div class=" row"class="collapse" id="customer_collapse">

      <div class="col-sm-12 float-right">
        <button type="button" class="genric-btn large primary" data-dismiss="modal" style="border-radius: 0px;" >Tutup</button>
        
        <button type="submit" class="genric-btn large danger text-light" style="border-radius: 0px">Simpan</button>

    </div>

</div>



</div>

</form>



</div>
</div>
</div> 


<div class="modal fade" id="ModalUploadResume" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <form id="form_upload" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/upload_resume') ?>">
          <div class="modal-header">
            <h5 class="modal-title">Upload CV</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <label>File Resume</label>
        <input type="file" name="file-cv" id="file-cv" class="form-control">
        <small class="error-file-cv text-danger"></small>

    </div>
    <div class="modal-footer">
        <button type="button" class="genric-btn primary" data-dismiss="modal" style="border-radius: 0px">Tutup</button>
        <button type="button" class="genric-btn danger item_upload_resume" style="border-radius: 0px">Upload</button>

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

$('#pendidikan_id').select2({
    dropdownParent: $('#ModalProfil .modal-content'),
    allowClear: true,
    placeholder:'Pilih Pendidikan'
});

});

  function hanyaAngka(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

  return true;
}

$(document).on('click','.item_upload_resume',function(){

    let file = $('#file-cv').val();
    if (file=='') {
        $('.error-file-cv').html('Silahkan Upload File Resume');
        return false;
    }else{
        
    }
});
</script>


