<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->

<style type="text/css">
  #lampiran_pas_photo{
    opacity: 0 !important;
    padding: 0 !important;
    width: 100%!important;

  }
  .imagecheck-figure > img {
    width: 100%!important;
  }
</style>

<?php 
$bulan = array(
  '01' => 'Januari',
  '02' => 'Februari',
  '03' => 'Maret',
  '04' => 'April',
  '05' => 'Mei',
  '06' => 'Juni',
  '07' => 'Juli',
  '08' => 'Agustus',
  '09' => 'September',
  '10' => 'Oktober',
  '11' => 'November',
  '12' => 'Desember'
);
?>


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
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_edit_resume" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($resume) > 0): ?>
                      <?php foreach ($resume as $pp): ?>
                        <div class="col-md-3 text-center">
                          <img  class="" src="<?php echo $pp->resume_foto ?>" style="width: 60%;border-radius: 10px">

                        </div>  

                        <div class="col-md-9 col-xl-9">
                          <div class="row mb-3">
                            <span class="col-md-4">NIK</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pp->resume_nik; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Nama Lengkap</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pp->resume_nama_lengkap; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-4">Tempat Tanggal Lahir</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php 
                            $tgl_lahir = explode('-', $pp->resume_tanggal_lahir);
                            echo $pp->resume_tempat_lahir.", ".$tgl_lahir[2]." ".$bulan[$tgl_lahir[1]]." ".$tgl_lahir[0]; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Jenis Kelamin</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pp->resume_jenis_kelamin=="L" ? "Laki-Laki":"Perempuan"; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Agama</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pp->agama_nama; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-4">Pendidikan</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pp->pendidikan_nama; ?></span>
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
                 <div class="col-md-4 col-xl-4 p-3" style="border: 1px solid #d8d8d8;border-radius: 15px;max-height: 200px">
                  <div class="row">
                    <div class="col-md-12 col-xl-12 text-center">
                      <span style="font-weight: bold;font-size: 18px;">Resume</span>
                      <hr>
                      <?php if (count($upload_resume) > 0): ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="position: absolute;right: 5px;top:5px;border-radius: 0px" data-target="#ModalUploadResume" data-toggle="modal"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($upload_resume) > 0): ?>
                      <?php foreach ($upload_resume as $up): ?>
                        <div class="col-md-12 col-xl-12 justify-content-center w-100 btn-group">
                          <a href="<?php echo $up->resume_lampiran ?>" target="_blank" class="genric-btn danger large item_lihat_resume" style="border-top-left-radius: 15px;border-bottom-left-radius: 15px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">Lihat Resume</a>
                          <a href="<?php echo base_url()?>cv/profile/<?php echo $up->user_id ?>" target="_blank" class="genric-btn primary large">Generate CV</a>
                        </div>
                      <?php endforeach ?>

                      <?php else: ?>
                        <div class="col-md-12 col-xl-12 text-center">
                         <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="border-radius: 0px" data-toggle="modal" data-target="#ModalUploadResume"><i class="fas fa-plus mr-2"></i>Upload Resume</a>
                       </div>
                     <?php endif ?>
                   </div>
                 </div>

                 <div class="col-xl-12 col-md-12 mb-4 p-3" >
                  <div class="row">

                    <div class="col-md-12 col-xl-12">
                      <span style="font-weight: bold;font-size: 18px">Pengalaman Kerja</span>
                      <hr>
                      <?php if (count($pengalaman) > 0): ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($pengalaman) > 0): ?>
                      <?php foreach ($pengalaman as $pl): ?>

                        <div class="col-md-12 col-xl-12">
                          <div class="row mb-3">
                            <span class="col-md-4">NIK</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pl->resume_nik; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Nama Lengkap</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pl->resume_nama_lengkap; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-4">Tempat Tanggal Lahir</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php 
                            $tgl_lahir = explode('-', $pl->resume_tanggal_lahir);
                            echo $pl->resume_tempat_lahir.", ".$tgl_lahir[2]." ".$bulan[$tgl_lahir[1]]." ".$tgl_lahir[0]; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Jenis Kelamin</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pl->resume_jenis_kelamin=="L" ? "Laki-Laki":"Perempuan"; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Agama</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pl->agama_nama; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-4">Pendidikan</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $pl->pendidikan_nama; ?></span>
                          </div>
                        </div>
                      <?php endforeach ?>
                      <?php else: ?>
                        <div class="col-md-12 col-xl-12 text-center">
                         <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="border-radius: 0px" data-toggle="modal" data-target="#ModalPengalaman"><i class="fas fa-plus mr-2"></i>Tambah Pengalaman</a>
                       </div>
                     <?php endif ?>
                   </div>
                 </div>

                 <div class="col-xl-12 col-md-12 mb-4 p-3" >
                  <div class="row">

                    <div class="col-md-12 col-xl-12">
                      <span style="font-weight: bold;font-size: 18px">Skill / Keahlian</span>
                      <hr>
                      <?php if (count($skill_resume) > 0): ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($skill_resume) > 0): ?>
                      <?php foreach ($skill_resume as $sr): ?>

                        <div class="col-md-12 col-xl-12">
                          <div class="row mb-3">
                            <span class="col-md-4">NIK</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $sr->resume_nik; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Nama Lengkap</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $sr->resume_nama_lengkap; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-4">Tempat Tanggal Lahir</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php 
                            $tgl_lahir = explode('-', $sr->resume_tanggal_lahir);
                            echo $sr->resume_tempat_lahir.", ".$tgl_lahir[2]." ".$bulan[$tgl_lahir[1]]." ".$tgl_lahir[0]; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Jenis Kelamin</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $sr->resume_jenis_kelamin=="L" ? "Laki-Laki":"Perempuan"; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-4">Agama</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $sr->agama_nama; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-4">Pendidikan</span>
                            <span class="col-md-8" style="font-weight: bold;">: <?php echo $sr->pendidikan_nama; ?></span>
                          </div>
                        </div>
                      <?php endforeach ?>
                      <?php else: ?>
                        <div class="col-md-12 col-xl-12 text-center">
                         <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_tambah_skill" style="border-radius: 0px" ><i class="fas fa-plus mr-2"></i>Tambah Skill</a>
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
     <form id="form_profil" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_resume') ?>">

      <div class="modal-header bg-danger"> 
        <h3 class="modal-title"  style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i> TAMBAH PROFIL</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <div class="modal-body">
       <div class="row "> 
        <div class="col-md-12 mb-3  mt-3" style="border-bottom: 1px solid #ced4da"> 
          <h6>Biodata</h6>
        </div>
        <div class="col-md-6 mb-3 "> 
         <label style="color:#343a40;" for="resume_nik">NIK</label>
         <input type="hidden" name="resume_id" id="resume_id">
         <input type="text" class="form-control" id="resume_nik"  name="resume_nik" required onkeypress="return hanyaAngka(event)" maxlength="16">
         <small class="error-resume_nik text-danger"></small>

       </div>

       <div class="col-md-6 mb-3"> 
         <label style="color:#343a40;" for="resume_nama_lengkap">Nama Lengkap</label>
         <input type="text" class="form-control" id="resume_nama_lengkap"  name="resume_nama_lengkap" required>
         <small class="error-resume_nama_lengkap text-danger"></small>
       </div>  

       <div class="col-md-6 mb-3"> 
         <label style="color:#343a40;" for="resume_tempat_lahir">Tempat Tanggal Lahir</label>
         <div class=" input-group">

           <input type="text" class="form-control" id="resume_tempat_lahir"  name="resume_tempat_lahir" required>
           <input type="date" class="form-control" id="resume_tanggal_lahir"  name="resume_tanggal_lahir" required>
         </div>
         <small class="error-resume_tempat_lahir text-danger"></small>

       </div> 


       <div class="col-md-3 mb-3 "> 
         <label style="color:#343a40;" for="resume_jenis_kelamin">Jenis Kelamin</label>
         <br>
         <select class="form-control w-100" id="resume_jenis_kelamin"  name="resume_jenis_kelamin" required>
           <option value="0" disabled selected>Pilih Jenis Kelamin</option>
           <option value="L">Laki-Laki</option>
           <option value="P">Perempuan</option>
         </select> 
         <small class="error-resume_jenis_kelamin text-danger"></small>

       </div> 


       <div class="col-md-3 mb-3 "> 
         <label style="color:#343a40;" for="resume_agama">Agama</label>
         <br>
         <select class="form-control w-100" id="resume_agama"  name="resume_agama" style="width: 100%">
           <option value="0" disabled selected>Pilih Agama</option>
           <?php foreach ($agama as $ag): ?>
             <option value="<?php echo $ag->agama_id ?>"><?php echo $ag->agama_nama ?></option>
           <?php endforeach ?>
         </select> 
         <small class="error-resume_agama text-danger"></small>

       </div>

       <div class="col-md-12 mb-3 mt-3" style="border-bottom: 1px solid #ced4da"> 
        <h6>Pendidikan</h6>
      </div>

      <div class="col-md-4 mb-3"> 
       <label style="color:#343a40;" for="pendidikan_id">Pendidikan Terakhir</label>
       <br>
       <select class="form-control" id="pendidikan_id"  name="pendidikan_id" required style="width: 100%">
         <option value="0" disabled selected>Pilih Pendidikan</option>
         <?php foreach ($pendidikan as $pd): ?>
           <option value="<?php echo $pd->pendidikan_id ?>"><?php echo $pd->pendidikan_nama ?></option>
         <?php endforeach ?>
       </select> 
       <small class="error-pendidikan_id text-danger"></small>

     </div>
     <div class="col-md-5 mb-3"> 
       <label style="color:#343a40;" for="resume_nama_pendidikan_terakhir">Institusi</label>
       <input type="text" class="form-control" id="resume_nama_pendidikan_terakhir"  name="resume_nama_pendidikan_terakhir" required>
       <small class="error-resume_nama_pendidikan_terakhir text-danger"></small>
     </div> 
     <div class="col-md-3 mb-3"> 
       <label style="color:#343a40;" for="resume_pendidikan_tahun_lulus">Tahun Lulus</label>
       <input type="text" class="form-control" id="resume_pendidikan_tahun_lulus"  name="resume_pendidikan_tahun_lulus" required maxlength="4" onkeypress="return hanyaAngka(event)">
       <small class="error-resume_pendidikan_tahun_lulus text-danger"></small>

     </div> 


     <div class="col-md-12 mb-3 mt-3" style="border-bottom: 1px solid #ced4da"> 
      <h6>Alamat</h6>
    </div>
    <div class="col-md-6 mb-3 "> 
     <label style="color:#343a40;" for="resume_prov">Provinsi</label>
     <br>
     <select class="form-control w-100" id="resume_prov"  name="resume_prov" style="width: 100%">
       <option value="0" disabled selected>Pilih Provinsi</option>
       <?php foreach ($provinsi as $prov): ?>
         <option value="<?php echo $prov->prov_id ?>"><?php echo $prov->prov_nama ?></option>
       <?php endforeach ?>
     </select> 
     <small class="error-resume_prov text-danger"></small>

   </div>

   <div class="col-md-6 mb-3 "> 
     <label style="color:#343a40;" for="resume_kabkota">Provinsi</label>
     <br>
     <select class="form-control" id="resume_kabkota"  name="resume_kabkota" style="width: 100%">
       <option value="0" disabled selected>Pilih Kabkota</option>
     </select> 
     <small class="error-resume_kabkota text-danger"></small>

   </div>

   <div class="col-md-6"> 
     <label style="color:#343a40;" for="resume_alamat">Alamat Lengkap</label>
     <textarea type="text" class="form-control" id="resume_alamat"  name="resume_alamat" required rows="5"></textarea>
     <small class="error-resume_alamat text-danger"></small>
   </div>

   <div class="col-md-3 mb-3"> 
    <label class="imagecheck">Pas Photo
     <input type="hidden" name="lampiran_pas_photo_lama" id="lampiran_pas_photo_lama">
     <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_pas_photo" id="lampiran_pas_photo">
     <figure class="imagecheck-figure">
      <img src="<?php echo base_url('assets/img/img03.jpg');?>"  class="imagecheck-image" id="preview_lampiran_pas_photo">
    </figure>
  </label>
  <small class="error-file-photo text-danger"></small>

</div>
</div>
</div>


<div class="modal-footer">

  <div class=" row"class="collapse" id="customer_collapse">

    <div class="col-sm-12 float-right">
      <button type="button" class="genric-btn large primary" data-dismiss="modal" style="border-radius: 0px;" >Tutup</button>

      <button type="button" class="genric-btn large danger text-light" style="border-radius: 0px" id="btn_simpan_biodata">Simpan</button>

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
        <input type="hidden" class="form-control" name="lampiran_cv" id="lampiran_cv" class="form-control">
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



<div class="modal fade" data-backdrop="static" id="ModalSkillResume" tabindex="-1" role="dialog" aria-labelledby="ModalSkillResumeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
     <form id="form_skill_resume" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_skill') ?>">

      <div class="modal-header bg-danger"> 
        <h3 class="modal-title" id="ModalSkillResumeJudul" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i>TAMBAH SKILL</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <div class="modal-body">
       <div class="row " style="overflow: hidden;"> 
        <div class="col-md-8 mb-3 "> 
          <label style="color:#343a40;" for="skill_id">Skill</label>
         <input type="hidden" name="skill_resume_id" id="skill_resume_id">
         <select class="form-control" id="skill_id"  name="skill_id" style="width: 100%">
           <option value="0" selected disabled>Pilih Skill</option>
           <?php foreach ($skill as $sk): ?>
             <option value="<?php echo $sk->skill_id ?>"><?php echo $sk->skill_nama; ?></option>
           <?php endforeach ?>
         </select>
         <small class="error-skill_id text-danger"></small>
       </div>

       <div class="col-md-4 mb-3 "> 
          <label style="color:#343a40;" for="skill_level_id">Level</label>
         <select class="form-control" id="skill_level_id"  name="skill_level_id" style="width: 100%">
           <option value="0" selected disabled>Pilih Level Skill</option>
           <?php foreach ($skill_level as $lv): ?>
             <option value="<?php echo $lv->skill_level_id ?>"><?php echo $lv->skill_level_nama; ?></option>
           <?php endforeach ?>
         </select>
         <small class="error-skill_level_id text-danger"></small>
       </div>




     </div>
   </div>


   <div class="modal-footer">

    <div class=" row"class="collapse" id="customer_collapse">

      <div class="col-sm-12 float-right">
        <button type="button" class="genric-btn large primary" data-dismiss="modal" style="border-radius: 0px;" >Tutup</button>

        <button type="button" class="genric-btn large danger text-light" style="border-radius: 0px" id="btn_simpan_skill">Simpan</button>

      </div>

    </div>



  </div>

</form>



</div>
</div>
</div> 

<script type="text/javascript">
  function previewFile(id) {
    let file = $('#'+id)[0].files[0];
    alert(file);
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      $('#preview_'+id).attr('src',reader.result);
    }, false);
    if (file) {
      reader.readAsDataURL(file);
      
    }
  }

  var files = [];
  document.getElementById("file-cv").addEventListener("change", function(e) {
    files = e.target.files;
  });

  document.getElementById("lampiran_pas_photo").addEventListener("change", function(e) {
    files = e.target.files;
    previewFile('lampiran_pas_photo');

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

  $('#pendidikan_id').select2({
    dropdownParent: $('#ModalProfil .modal-content'),
    allowClear: true,
    placeholder:'Pilih Pendidikan',
    tags: true,

  });

  $('#resume_prov').select2({
    dropdownParent: $('#ModalProfil .modal-content'),
    allowClear: true,
    placeholder:'Pilih Provinsi'
  });



  $('#resume_prov').on('change',function(){
    let prov = $(this).val();
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('seeker/getkabkota')?>",
      dataType : "JSON",
      data : {'prov_id':prov},
      success: function(data){
        let kab = '<option value="0" selected disabled>Pilih Kabupaten/Kota</option>';
        for (var i = 0; i < data.length; i++) {
          kab+='<option value="'+data[i].kabkota_id+'">'+data[i].kabkota_nama+'</option>';
        }
        $('#resume_kabkota').html(kab);
        $('#resume_kabkota').select2({
          dropdownParent: $('#ModalProfil .modal-content'),
          allowClear: true,
          placeholder:'Pilih Kabupaten/Kota'
        });

      }
    });

  });




});

  function getPathStorageFromUrl(url){

    const baseUrl = "https://firebasestorage.googleapis.com/v0/b/project-80505.appspot.com/o/";

    let imagePath = url.replace(baseUrl,"");

    const indexOfEndPath = imagePath.indexOf("?");

    imagePath = imagePath.substring(0,indexOfEndPath);
    
    imagePath = imagePath.replace("%2F","/");
    
    return imagePath;
  }



  $('#btn_simpan_biodata').on('click',function(){

    let cek =0;
    let nik = $('#resume_nik').val();
    if (nik=='') {
      $('.error-resume_nik').html('NIK Tidak Boleh Kosong');
      cek++;
    }else{
      if (nik.length !=16) {
        $('.error-resume_nik').html('NIK Harus 16 Digit');
        cek++;
      }else{
        $('.error-resume_nik').html('');
      }
    }

    let nama_lengkap = $('#resume_nama_lengkap').val();
    if (nama_lengkap=='') {
      $('.error-resume_nama_lengkap').html('Silahkan Masukkan Nama');
      cek++;
    }else{
      $('.error-resume_nama_lengkap').html('');
    }

    let tempat_lahir = $('#resume_tempat_lahir').val();
    if (tempat_lahir=='') {
      $('.error-resume_tempat_lahir').html('Silahkan Masukkan Tempat Lahir');
      cek++;
    }else{
      let tanggal_lahir = $('#resume_tanggal_lahir').val();
      if (tanggal_lahir=='') {
        $('.error-resume_tempat_lahir').html('Silahkan Masukkan Tanggal Lahir');
        cek++;
      }else{
        $('.error-resume_tempat_lahir').html('');
      }
    }

    let jenis_kelamin = $('#resume_jenis_kelamin').val();
    if (jenis_kelamin==null) {
      $('.error-resume_jenis_kelamin').html('Silahkan Pilih Jenis Kelamin');
      cek++;
    }else{
      $('.error-resume_jenis_kelamin').html('');
    }

    let agama = $('#resume_agama').val();
    if (agama==null) {
      $('.error-resume_agama').html('Silahkan Pilih Agama');
      cek++;
    }else{
      $('.error-resume_agama').html('');
    }

    let pendidikan = $('#pendidikan_id').val();
    if (pendidikan==null) {
      $('.error-pendidikan_id').html('Silahkan Pilih Jenjang Pendidikan');
      cek++;
    }else{
      $('.error-pendidikan_id').html('');
    }

    let nama_pendidikan_terakhir = $('#resume_nama_pendidikan_terakhir').val();
    if (nama_pendidikan_terakhir=='') {
      $('.error-resume_nama_pendidikan_terakhir').html('Silahkan Masukkan Nama Sekolah / Institusi');
      cek++;
    }else{
      $('.error-resume_nama_pendidikan_terakhir').html('');
    }

    let pendidikan_tahun_lulus = $('#resume_pendidikan_tahun_lulus').val();
    if (pendidikan_tahun_lulus=='') {
      $('.error-resume_pendidikan_tahun_lulus').html('Tahun Lulus Kosong');
      cek++;
    }else{
      $('.error-resume_pendidikan_tahun_lulus').html('');
    }

    let resume_prov = $('#resume_prov').val();
    if (resume_prov==null) {
      $('.error-resume_prov').html('Silahkan Pilih Provinsi');
      cek++;
    }else{
      $('.error-resume_prov').html('');
    }

    let resume_kabkota = $('#resume_kabkota').val();
    if (resume_kabkota==null) {
      $('.error-resume_kabkota').html('Silahkan Pilih Kabupaten/Kota');
      cek++;
    }else{
      $('.error-resume_kabkota').html('');
    }

    let alamat = $('#resume_alamat').val();
    if (alamat=='') {
      $('.error-resume_alamat').html('Silahkan Masukkan Alamat Lengkap');
      cek++;
    }else{
      $('.error-resume_alamat').html('');
    }

    if (cek > 0) {
      return false
    }else{
      let link = $('#form_upload').attr('action');
      
      if (files.length==0) {
        if (link.includes('simpan')!==false) {
          $('.error-file-photo').html('Silahkan Upload Photo');
          return false;
        }else{
         $('#btn_simpan_biodata').attr('disabled','disabled');
         $('#btn_simpan_biodata').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');

         $('#form_profil').submit();
       }
     }else{
      let photo = $('#lampiran_pas_photo_lama').val();
      if (photo!='') {
        const myfile = firebase.storage();
        myfile.refFromURL(photo).delete()
      } 
      for (let i = 0; i < files.length; i++) {
        var storage = firebase.storage().ref('talent_hub/cv/'+files[i].name);
        var upload = storage.put(files[i]);
        upload.on(

          "state_changed",
          function progress(snapshot) {
          },

          function error() {
            $('.error-file-photo').html("Upload File Error");
          },

          function complete() {
            storage
            .getDownloadURL()
            .then(function(url) {
              $('#lampiran_pas_photo_lama').val(url);
              $('#btn_simpan_biodata').attr('disabled','disabled');
              $('#btn_simpan_biodata').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');
              $('#form_profil').submit();
            })
            .catch(function(error) {
              console.log("error encountered");
            });
          },
          );


      }
    }
    

  }

});

function hanyaAngka(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

  return true;
}


$(document).on('click','.item_upload_resume',function(){
  if (files.length==0) {
    $('.error-file-cv').html('Silahkan Upload File Resume');
    return false;
  }else{

    let resume_lama = $('.item_lihat_resume').attr('href');
    if (resume_lama!='') {
      const myfile = firebase.storage();
      myfile.refFromURL(resume_lama).delete()
    } 

    for (let i = 0; i < files.length; i++) {
      var storage = firebase.storage().ref('talent_hub/cv/'+files[i].name);
      var upload = storage.put(files[i]);
      upload.on(

        "state_changed",
        function progress(snapshot) {
        },

        function error() {
          $('.error-file-cv').html("Upload File Error");
        },

        function complete() {
          storage
          .getDownloadURL()
          .then(function(url) {
            $('#lampiran_cv').val(url);

            $('#form_upload').submit();
          })
          .catch(function(error) {
            console.log("error encountered");
          });
        },
        );


    }
  }
});

$('.item_edit_resume').on('click',function(){
 $.ajax({
  type : "GET",
  url  : "<?php echo base_url('seeker/get_resume')?>",
  dataType : "JSON",
  success: function(data){
    if (data.length > 0) {
      $('#ModalProfil').modal('show');
      $('#ModalProfilLabel').html('UBAH BIODATA PROFIL');
      $('#form_profil').attr('action','<?php echo base_url('cv/ubah_resume') ?>');
      $('#btn_simpan_biodata').html('UPDATE');
      $('#resume_id').val(data[0].resume_id);
      $('#resume_nama_lengkap').val(data[0].resume_nama_lengkap);

      $('#resume_nik').val(data[0].resume_nik)

      $('#resume_tempat_lahir').val(data[0].resume_tempat_lahir);
      $('#resume_tanggal_lahir').val(data[0].resume_tanggal_lahir);

      $('#resume_jenis_kelamin').val(data[0].resume_jenis_kelamin).trigger('change');
      $('#resume_agama').val(data[0].agama_id).trigger('change');
      $('#pendidikan_id').val(data[0].pendidikan_id).trigger('change');
      $('#resume_pendidikan_tahun_lulus').val(data[0].resume_pendidikan_tahun_lulus);
      $('#resume_nama_pendidikan_terakhir').val(data[0].resume_nama_pendidikan_terakhir);
      $('#resume_prov').val(data[0].prov_id).trigger('change');

      setTimeout(
        function() 
        {
          $('#resume_kabkota').val(data[0].kabkota_id).trigger('change');

        }, 2000);

      $('#resume_alamat').val(data[0].resume_alamat_lengkap);
      $('#lampiran_pas_photo_lama').val(data[0].resume_foto);
      if (data[0].resume_foto!='') {
        $('#preview_lampiran_pas_photo').attr('src',data[0].resume_foto);
      }
    }else{
      Swal.fire({
        title:'Error',
        text:'Biodata Tidak Ditemukan!',
        icon:'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }

  }
});

});

$('.item_tambah_skill').on('click',function(){
  $('#ModalSkillResume').modal('show');
  $('#btn_simpan_skill').html('TAMBAH');
  $('#ModalSkillResumeJudul').html(' <i class="fas fa-database mr-2"></i>TAMBAH SKILL');
  $('#skill_id').select2({
    placeholder : 'Pilih Skill',
    allowClear:true,
    dropdownParent:$('#ModalSkillResume .modal-content'),
    tags:true,
  });
});
</script>


