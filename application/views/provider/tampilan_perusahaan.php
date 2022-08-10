<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->

<style type="text/css">
  #lampiran_sampul {
    opacity: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    max-height: 350px  !important;
  }

  #lampiran_logo {
    opacity: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    max-height: 350px  !important;
  }

  #preview_lampiran_sampul {
    width: 100% !important;
    max-height: 350px  !important;
  }
  #preview_lampiran_logo {
    width: 100% !important;
    /*max-height: 350px  !important;*/
  }
  #preview_sampul_perusahaan {
    width: 100% !important;
    max-height: 400px  !important;
  }

  .imagecheck{
    width: 100% !important;
  }

  #foto_sampul
  {

    width: 100% !important;
    max-height: 350px  !important;
  }

  .timeline {
    border-left: 3px solid #dd2727;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    background: transparent;
    margin: 0 auto;
    letter-spacing: 0.2px;
    position: relative;
    line-height: 1.4em;
    font-size: 1.03em;
    padding: 50px;
    list-style: none;
    text-align: left;
    max-width: 60%;
  }

  @media (max-width: 2000px) {
    .timeline {
      max-width: 98%;
      padding: 25px;
    }
  }

  .timeline h1 {
    font-size: 1.4em;
    font-weight: bold;
  }

  .timeline h2,
  .timeline h3 {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 10px;
  }



  .timeline .event {
    border-bottom: 1px dashed #e8ebf1;
    padding-bottom: 25px;
    margin-bottom: 25px;
    position: relative;
  }

  @media (max-width: 2000px) {
    .timeline .event {
      padding-top: 30px;
    }
  }

  .timeline .event:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border: none;
  }

  .timeline .event:before,
  .timeline .event:after {
    position: absolute;
    display: block;
    top: 0;
  }

  .timeline .event:before {
    left: -270px;
    content: attr(data-date);
    text-align: right;
    font-weight: 100;
    font-size: 0.9em;
    min-width: 120px;
  }

  @media (max-width: 2000px) {
    .timeline .event:before {
      left: 0px;
      text-align: left;
    }
  }

  .timeline .event:after {
    -webkit-box-shadow: 0 0 0 3px #dd2727;
    box-shadow: 0 0 0 3px #dd2727;
    left: -55.8px;
    background: #fff;
    border-radius: 50%;
    height: 9px;
    width: 9px;
    content: "";
    top: 5px;
  }

  @media (max-width: 2000px) {
    .timeline .event:after {
      left: -31.8px;
    }
  }

  .rtl .timeline {
    border-left: 0;
    text-align: right;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-right: 3px solid #dd2727;
  }

  .rtl .timeline .event::before {
    left: 0;
    right: -170px;
  }

  .rtl .timeline .event::after {
    left: 0;
    right: -55.8px;
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

<?php foreach ($perusahaan as $pr): ?>

  <div class="container-fluid  flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <h1 class="h3 mb-4 text-gray-800">Company Profile</h1>
    <div class="row">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-md-12 col-md-12 mb-4">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-md-12">
                <div class="row p-3">
                  <?php if ($pr->perusahaan_sampul!='') { ?>

                    <div class="col-md-12 col-md-12 " style="position: relative;overflow:hidden;">
                    <?php  }else{ ?>
                     <div class="col-md-12 col-md-12" style="position: relative;overflow:hidden;background: #dddddd">
                     <?php  } ?>

                     <?php if ($pr->perusahaan_sampul!='') { ?>
                      <img src="<?php echo $pr->perusahaan_sampul; ?>" class="imagecheck-image" id="preview_sampul_perusahaan">
                    <?php  }else{ ?>
                     <center>
                       <img src="<?php echo base_url('assets/img/noimagesampul.jpg'); ?>" class="imagecheck-image" style="width: auto!important;height: 350px;" id="preview_sampul_perusahaan">
                     </center>
                   <?php  } ?>


                   <a href="javascript:void(0)" class="btn btn-sm btn-danger item_edit_sampul" style="position: absolute;bottom:11rem;right: 2rem" data-sampul="<?php echo $pr->perusahaan_sampul ?>"><i class="fas fa-edit mr-2"></i>Edit</a>

                   <div class="shadow rounded" style="position: relative;left: 5rem;top:-5rem;width: 10rem;height: 10rem;background: white;text-align: center;padding: 0.5rem">
                    <?php if ($pr->perusahaan_logo!=''): ?>
                      <img src="<?php echo $pr->perusahaan_logo?>" style="width: 100%!important;height: auto;z-index: 999;margin-top: 2rem;">
                      <?php else: ?>
                        <img src="<?php echo base_url('assets/img/user.png'); ?>"  style="width: auto!important;height: auto;z-index: 999;margin-top: 2rem;">


                      <?php endif; ?>

                      <a href="javascript:void(0)" class="text-danger btn-outline-light btn item_edit_logo btn-block" style="position: absolute;bottom:0rem;left: 0rem;" data-logo="<?php echo $pr->perusahaan_logo ?>"><i class="fas fa-edit mr-2"></i>Edit</a>
                    </div>
                  </div>
                  <div class="col-md-12 col-xl-12 p-0 mt-5">
                     <a href="javascript:;" class="text-danger btn-sm btn btn-outline-light item_edit_perusahaan" style="position: absolute;right: 5px;top:-15px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                     <hr>
                    <div class="row">
                      <div class="col-md-8 col-xl-8 p-5">
                        <h4  style="font-weight: bolder;">About Us</h4>
                        <p style="text-align: justify;"><?php echo $pr->perusahaan_sambutan; ?></p>
                      </div> 
                      <div class="col-md-4 col-xl-4 p-5">
                        <h4  style="font-weight: bolder;"><?php echo $pr->perusahaan_nama; ?></h4>
                        <br>
                        <?php if ($pr->perusahaan_alamat!='') { ?>
                          <p style="text-align: justify;"><i class="fas fa-building mr-3"></i><?php echo $pr->perusahaan_alamat; ?></p>
                       <?php  } ?>

                        <?php if ($pr->perusahaan_prov!=0) { ?>
                          <p><i class="fas fa-map-marker-alt mr-3"></i><?php echo $pr->kabkota_nama." - ".$pr->prov_nama; ?></p>
                       <?php  } ?>

                       <?php if ($pr->perusahaan_email!='') { ?>
                          <p><i class="fas fa-envelope mr-3"></i><?php echo $pr->perusahaan_email; ?></p>
                       <?php  } ?>
                        <?php if ($pr->perusahaan_telepon!='') { ?>
                          <p><i class="fas fa-phone mr-3"></i><?php echo $pr->perusahaan_telepon; ?></p>
                       <?php  } ?>

                        <?php if ($pr->perusahaan_website!='') { ?>
                          <a href="<?php echo $pr->perusahaan_website; ?>" target="_blank" class="btn btn-sm"><p><i class="fas fa-globe mr-3"></i><?php echo $pr->perusahaan_website; ?></p></a>
                       <?php  } ?>
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
</div>
<?php endforeach ?>

<!-- Modal -->



<div class="modal fade" data-backdrop="static" id="modalprofilperusahaan" tabindex="-1" role="dialog" aria-labelledby="modalprofilperusahaanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_perusahaan" method="post" enctype="multipart/form-data" action="<?php echo base_url('provider/ubah_perusahaan') ?>">
        <div class="modal-header bg-danger text-light" style="color: #ffff">
          <h3 class="modal-title" id="label_header_stp" style="color: #ffffff!important"> <i class="fas fa-building mr-2"></i>PROFILE PERUSAHAAN</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12 mb-3">
              <label style="color:#343a40;" for="perusahaan_nama_edit">Nama Perusahaan</label>
              <input type="hidden" name="perusahaan_id_edit" id="perusahaan_id_edit">
              <input type="text" class="form-control" id="perusahaan_nama_edit" name="perusahaan_nama_edit" required>
              <small class="mt-1 error-perusahaan_nama_edit text-danger"></small>
            </div>
            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_prov_edit">Provinsi</label>
              <select class="form-control" id="perusahaan_prov_edit" name="perusahaan_prov_edit" style="width: 100%!important">
              </select>
              <small class="mt-1 error-perusahaan_prov_edit text-danger"></small>

            </div>
            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_kabkota_edit">Kabupaten / Kota</label>
              <select class="form-control" id="perusahaan_kabkota_edit" name="perusahaan_kabkota_edit" style="width: 100%!important">
              </select>
              <small class="mt-1 error-perusahaan_kabkota_edit text-danger"></small>
            </div>

            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_telepon_edit">Telepon</label>
              <input type="text" class="form-control" id="perusahaan_telepon_edit" name="perusahaan_telepon_edit">
            </div>

            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_email_edit">Email</label>
              <input type="text" class="form-control" id="perusahaan_email_edit" name="perusahaan_email_edit">
              <small class="mt-1 error-perusahaan_email_edit text-danger"></small>

            </div>


            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_website_edit">Website</label>
              <input type="text" class="form-control" id="perusahaan_website_edit" name="perusahaan_website_edit">
            </div>
            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_jml_karyawan_edit">Jumlah Karyawan</label>
              <input type="number" class="form-control" id="perusahaan_jml_karyawan_edit" name="perusahaan_jml_karyawan_edit">
            </div>

            <div class="col-md-12 mb-3">
              <label style="color:#343a40;" for="perusahaan_sambutan_edit">About Us</label>
              <textarea class="form-control" id="perusahaan_sambutan_edit" name="perusahaan_sambutan_edit" rows="6"></textarea>
              <small class="mt-1 error-perusahaan_sambutan_edit text-danger"></small>
            </div>
            <div class="col-md-12 mb-3">
              <label style="color:#343a40;" for="perusahaan_alamat_edit">Alamat</label>
              <textarea class="form-control" id="perusahaan_alamat_edit" name="perusahaan_alamat_edit" rows="6"></textarea>
              <small class="mt-1 error-perusahaan_alamat_edit text-danger"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group row" class="collapse" id="customer_collapse">
              <button type="button" class="btn btn-danger btn-sm mr-2 rounded" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-sm btn-success rounded" id="btn_update_profil_perusahaan">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" data-backdrop="static" id="ModalEditSampul" tabindex="-1" role="dialog" aria-labelledby="ModalEditSampulLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_sampul" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_resume') ?>">

        <div class="modal-header bg-danger">
          <h3 class="modal-title" style="color: #ffffff!important"> <i class="fas fa-camera mr-3"></i>LINI MASA</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12 mb-3">
              <label class="imagecheck">
                <input type="hidden" name="lampiran_sampul_lama" id="lampiran_sampul_lama">
                <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_sampul" id="lampiran_sampul">
                <figure class="imagecheck-figure">
                  <img src="<?php echo base_url('assets/img/img03.jpg'); ?>" class="imagecheck-image" id="preview_lampiran_sampul">
                </figure>
              </label>
              <small class="error-lampiran_sampul text-danger"></small>
            </div>
            <div class="col-md-12 mb-3 mt-5">
              <p class="fw-bold">Catatan :</p>
              <li>
                <small>Format gambar harus .jpg, .jpeg, atau .png</small><br>
                
              </li>
              <li>
                <small>Dimensi Gambar Proporsional : 1260px x 350px</small><br>
              </li>

            </div>

          </div>
        </div>
        <div class="modal-footer">

          <div class=" row" class="collapse" id="customer_collapse">
            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">Tutup</button>
              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_sampul">Simpan</button>
            </div>
          </div>
        </div>

      </form>



    </div>
  </div>
</div>



<div class="modal fade" data-backdrop="static" id="ModalEditLogo" tabindex="-1" role="dialog" aria-labelledby="ModalEditLogoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_logo" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_resume') ?>">

        <div class="modal-header bg-danger">
          <h3 class="modal-title" style="color: #ffffff!important"> <i class="fas fa-camera mr-3"></i>LOGO PERUSAHAAN</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12 mb-3">
              <label class="imagecheck">
                <input type="hidden" name="lampiran_logo_lama" id="lampiran_logo_lama">
                <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_logo" id="lampiran_logo">
                <figure class="imagecheck-figure">
                  <img src="<?php echo base_url('assets/img/img03.jpg'); ?>" class="imagecheck-image" id="preview_lampiran_logo">
                </figure>
              </label>
              <small class="error-lampiran_logo text-danger"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">

          <div class=" row" class="collapse" id="customer_collapse">
            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">Tutup</button>
              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_logo">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- script -->
<script type="text/javascript">
  $(document).ready(function() {

    $('#perusahaan_prov_edit').on('change', function() {
    let prov_id = $(this).val();
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('job/get_kabkota') ?>",
      dataType: "JSON",
      data: {
        'prov_id': prov_id
      },
      success: function(data) {

        let kab = '<option value ="0" selected disabled>Pilih Kabupaten / Kota</option>';
        for (var i = 0; i < data.length; i++) {
          kab += '<option value="' + data[i].kabkota_id + '">' + data[i].kabkota_nama + '</option>';
        }
        $('#perusahaan_kabkota_edit').html(kab);
        $('#perusahaan_kabkota_edit').select2({
          allowClear: true,
          placeholder: "Pilih Kabupaten / Kota",
          dropdownParent: $('#modalprofilperusahaan'),
        });

      }
    });
  });


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
  });

  function previewFile(id) {
    let file = $('#' + id)[0].files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function() {
      $('#preview_' + id).attr('src', reader.result);
    }, false);
    if (file) {
      reader.readAsDataURL(file);
    }
  }


  var files = [];

  document.getElementById("lampiran_sampul").addEventListener("change", function(e) {
    files = e.target.files;
    previewFile('lampiran_sampul');
  });

  document.getElementById("lampiran_logo").addEventListener("change", function(e) {
    files = e.target.files;
    previewFile('lampiran_logo');
  });



  $('.item_edit_sampul').on('click',function(){
    let sampul = $(this).data('sampul');
    $('#ModalEditSampul').modal('show');

    if (sampul!='') {
      $('#preview_lampiran_sampul').attr('src',sampul);
      $('#lampiran_sampul_lama').val(sampul);
    }
    $('#form_sampul').attr('action','<?php echo base_url('provider/ubah_sampul') ?>');
  });

    $(document).on('click', '.item_edit_perusahaan', function() {
    let perusahaan_id = '<?php echo $this->session->perusahaan_id ?>';
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('job/get_perusahaan') ?>",
      dataType: "JSON",
      data: {
        'perusahaan_id': perusahaan_id
      },
      success: function(data) {
        $('#modalprofilperusahaan').modal('show');
        $('#perusahaan_nama_edit').val(data.perusahaan[0].perusahaan_nama);
        $('#perusahaan_email_edit').val(data.perusahaan[0].perusahaan_email);
        $('#perusahaan_telepon_edit').val(data.perusahaan[0].perusahaan_telepon);
        $('#perusahaan_sambutan_edit').val(data.perusahaan[0].perusahaan_sambutan);

        $('#perusahaan_jml_karyawan_edit').val(data.perusahaan[0].perusahaan_jml_karyawan);
        $('#perusahaan_website_edit').val(data.perusahaan[0].perusahaan_website);
        $('#perusahaan_alamat_edit').val(data.perusahaan[0].perusahaan_alamat);
        let prov = '<option value ="0" selected disabled>Pilih Provinsi</option>';
        for (var i = 0; i < data.provinsi.length; i++) {
          if (data.perusahaan[0].perusahaan_prov == data.provinsi[i].prov_id) {
            prov += '<option value="' + data.provinsi[i].prov_id + '" selected>' + data.provinsi[i].prov_nama + '</option>';
          } else {
            prov += '<option value="' + data.provinsi[i].prov_id + '">' + data.provinsi[i].prov_nama + '</option>';
          }
        }
        $('#perusahaan_prov_edit').html(prov);
        $('#perusahaan_prov_edit').select2({
          allowClear: true,
          placeholder: "Pilih Provinsi",
          dropdownParent: $('#modalprofilperusahaan'),
        });
        let kab = '<option value ="0" selected disabled>Pilih Kabupaten / Kota</option>';
        for (var i = 0; i < data.kabkota.length; i++) {
          if (data.kabkota[i].prov_id == data.perusahaan[0].perusahaan_prov) {
            if (data.kabkota[i].kabkota_id == data.perusahaan[0].perusahaan_kabkota) {
              kab += '<option value="' + data.kabkota[i].kabkota_id + '" selected>' + data.kabkota[i].kabkota_nama + '</option>';
            } else {
              kab += '<option value="' + data.kabkota[i].kabkota_id + '">' + data.kabkota[i].kabkota_nama + '</option>';

            }

          }
        }
        $('#perusahaan_kabkota_edit').html(kab);
        $('#perusahaan_kabkota_edit').select2({
          allowClear: true,
          placeholder: "Pilih Kabupaten / Kota",
          dropdownParent: $('#modalprofilperusahaan'),
        });
      }
    });
  });

  $('.item_edit_logo').on('click',function(){
    let logo = $(this).data('logo');
    $('#ModalEditLogo').modal('show');
    if (logo!='') {
      $('#preview_lampiran_logo').attr('src',logo);
      $('#lampiran_logo_lama').val(logo);
    }
    $('#form_logo').attr('action','<?php echo base_url('provider/ubah_logo') ?>');
  });

  $('#btn_simpan_sampul').on('click', function() {


    let link = $('#form_sampul').attr('action');

    $('#btn_simpan_sampul').attr('disabled', 'disabled');
    $('#btn_simpan_sampul').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');

    if (files.length == 0) {
      if (link.includes('simpan') !== false) {
        $('.error-sampul').html('Silahkan Upload Sampul');
        return false;
      }

      
      $('#form_sampul').submit();
    } else {
      let sampul = $('#lampiran_sampul_lama').val();
      if (sampul != '') {
        const myfile = firebase.storage();
        myfile.refFromURL(sampul).delete();
      }
      for (let i = 0; i < files.length; i++) {
        var storage = firebase.storage().ref('talent_hub/perusahaan/' + files[i].name);
        var upload = storage.put(files[i]);
        upload.on(
          "state_changed",
          function progress(snapshot) {},

          function error() {
            $('.error-sampul').html("Upload File Error");
          },

          function complete() {
            storage
            .getDownloadURL()
            .then(function(url) {
              $('#lampiran_sampul_lama').val(url);
              $('#form_sampul').submit();
            })
            .catch(function(error) {
              console.log("error encountered");
            });
          },
          );


      }
    }



  });

  $('#btn_simpan_logo').on('click', function() {


    let link = $('#form_logo').attr('action');

    $('#btn_simpan_logo').attr('disabled', 'disabled');
    $('#btn_simpan_logo').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');

    if (files.length == 0) {
      if (link.includes('simpan') !== false) {
        $('.error-lampiran_logo').html('Silahkan Upload logo');
        return false;
      }

      
      $('#form_logo').submit();
    } else {
      let logo = $('#lampiran_logo_lama').val();
      if (logo != '') {
        const myfile = firebase.storage();
        myfile.refFromURL(logo).delete();
      }
      for (let i = 0; i < files.length; i++) {
        var storage = firebase.storage().ref('talent_hub/perusahaan/' + files[i].name);
        var upload = storage.put(files[i]);
        upload.on(
          "state_changed",
          function progress(snapshot) {},

          function error() {
            $('.error-lampiran_logo').html("Upload File Error");
          },

          function complete() {
            storage
            .getDownloadURL()
            .then(function(url) {
              $('#lampiran_logo_lama').val(url);
              $('#form_logo').submit();
            })
            .catch(function(error) {
              console.log("error encountered");
            });
          },
          );


      }
    }



  });

   



  $(document).on('click', '#btn_update_profil_perusahaan', function() {

    let cek = 0;

    let perusahaan_nama = $('#perusahaan_nama_edit').val();
    if (perusahaan_nama == '') {
      cek++;
      $('.error-perusahaan_nama_edit').html('Nama Perusahaan Tidak Boleh Kosong');
    } else {
      $('.error-perusahaan_nama_edit').html('');
    }

    let perusahaan_prov = $('#perusahaan_prov_edit').val();
    if (perusahaan_prov == null) {
      cek++;
      $('.error-perusahaan_prov_edit').html('Silahkan Pilih Provinsi');
    } else {
      $('.error-perusahaan_prov_edit').html('');
    }

    let perusahaan_kabkota = $('#perusahaan_kabkota_edit').val();
    if (perusahaan_kabkota == null) {
      cek++;
      $('.error-perusahaan_kabkota_edit').html('Silahkan Pilih Kabupaten Kota');
    } else {
      $('.error-perusahaan_kabkota_edit').html('');
    }

    let perusahaan_email = $('#perusahaan_email_edit').val();
    if (perusahaan_email != '') {

      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

      if (!testEmail.test(perusahaan_email)) {
        cek++;
        $('.error-perusahaan_email_edit').html('Format Email Tidak Valid');

      } else {
        $('.error-perusahaan_email_edit').html('');

      }
    } else {
      $('.error-perusahaan_email_edit').html('');
    }

    let perusahaan_alamat = $('#perusahaan_alamat_edit').val();
    if (perusahaan_alamat == '') {
      cek++;
      $('.error-perusahaan_alamat_edit').html('Alamat Perusahaan Tidak Boleh Kosong');
    } else {
      $('.error-perusahaan_alamat_edit').html('');
    }

    if (cek > 0) {
      return false;
    } else {

        $('#btn_update_profil_perusahaan').attr('disabled', 'disabled');
        $('#btn_update_profil_perusahaan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px;width:25px;">');
        $('#form_perusahaan').submit();
    }
  });

</script>
