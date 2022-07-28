  <?php foreach ($resume as $key): ?>
    <?php $bulan = array(
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

    <!DOCTYPE html>
    <?php   $month = array('01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember',); ?>

    <html ><head style="padding: 0px!important;margin: 0px!important">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/flaticon.css" />

      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/fontawesome-all.min.css" />
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/themify-icons.css" />

      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css" />

      <script src="<?php echo base_url() ?>assets/js/vendor/jquery-1.12.4.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>


      <!-- Scrollup, nice-select, sticky -->
      <script src="<?php echo base_url() ?>assets/js/jquery.scrollUp.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/jquery.nice-select.min.js"></script>
      <script src="<?php echo base_url() ?>assets/js/jquery.sticky.js"></script>

      <!-- contact js -->
      <script src="<?php echo base_url() ?>assets/js/contact.js"></script>
      <script src="<?php echo base_url() ?>assets/js/jquery.form.js"></script>

      <script src="<?php echo base_url() ?>assets/js/main.js"></script>
      
      <style type="text/css">
        .xlText {
          mso-number-format: "\@";
        }
        p,span{
          font-size:12px; 
          font-family: "Inter","sans-serif";
        }
        body,head,html{padding: 0px!important;margin: 0px!important}
        body{
          z-index: -999;
        }
        *{
          font-family: Inter
        }
        .kotak_kiri{
          width: 40%;
          background: #f5f5f5;
          position: absolute;
          height: 100%
        }

        .kotak_kanan{
          width: 40%;
          background: red;
          position: absolute;
          height: 100%;
          right: 0px;
        }
        .kotak_tengah{
          width: 60%;
          background: white;
          position: absolute;
          height: 95%!important;
          right: 25px;
          top: 25px;
          z-index: 100;
        }

        .photo_dh{
          width: 150px;
          height: 150px;
          position: relative;
          border-radius: 75px;
          top: 20px;
          margin: auto;
          overflow: hidden;
          text-align: center;
          background: white;
        }
        .kotak_skor{
          position: absolute;
          bottom: 50px;
          right: 50px;
          background: red;
          width: 160px;
          height: 160px;
          border-radius: 15px;
          vertical-align: middle;
        }
      </style> 

      <?php
      $foto ='';
      $data = file_get_contents($key->resume_foto);
      $foto = 'data:image/'. ';base64,' . base64_encode($data);
      ?>

    </head><body style="background: #f5f5f5;padding: 0px!important;margin: 0px!important">
      <div class="kotak_kiri">
        <div class="photo_dh">
          <?php if ($foto!='') { ?>
            <img alt="Foto" src="<?php echo $foto ?>" class="rounded-circle profile-widget-picture" width="80%" height="auto" alt="Foto">
          <?php }else{ ?>
            <img alt="Foto" src="assets/img/personnel_boy.png" class="rounded-circle profile-widget-picture" width="90%" height="auto" alt="Foto" title="Belum Ada Foto">
          <?php } ?>
        </div>
        <br>
        <h6 style="text-align: center;font-weight: bold;width: 100%;color: #3c3c3c;margin-bottom: 5px"><?php echo strtoupper($key->resume_nama_lengkap); ?></h6>
        <hr style="border-top: 1px solid #878787;border-bottom: 0px;width: 75%;margin: auto;margin-bottom: 5px">
        <p style="text-align: center;color:#3c3c3c;margin-top: 0px;font-size: 12px "><?php echo strtoupper($key->resume_nik); ?></p>
        <br>

        <?php if ($key->user_email!='') { ?>
          <img src="assets/img/email.png" style="width: 25px;height: 25px;display: inline-block;margin-left: 35px;margin-top: 5px">
          <span style="width:  200px;font-size: 14px;display: inline-block;margin-left: 10px"><?php echo $key->user_email; ?></span>
        <?php  } ?>
        <br>
        <br>

        <?php if ($key->user_telepon!='') { ?>
          <img src="assets/img/telepon.png" style="width: 25px;height: 25px;display: inline-block;margin-left: 35px">
          <span style="width:  200px;font-size: 14px;display: inline-block;margin-left: 10px"><?php echo $key->user_telepon; ?></span>
        <?php  } ?>
        <br>

        <br>
        <?php if ($key->resume_alamat_lengkap!='') { ?>
          <img src="assets/img/home.png" style="width: 25px;height: 25px;display: inline-block;margin-left: 35px;vertical-align: top!important;">
          <span style="width:  200px;display: inline-block;margin-left: 10px;vertical-align: middle!important;text-align: justify-all;word-wrap: break-word;font-size: 14px"><?php echo ucwords(strtolower($key->resume_alamat_lengkap)); ?></span>
        <?php  } ?>
        <br>
        <br>
      </div>
      <div class="kotak_kanan">

      </div>

      <div class="kotak_tengah">
       <h6 style="font-weight: bold;color:red;margin-top:25px; margin-left: 50px;border-bottom: 1px solid red;width: 80%;margin-bottom: 25px">Biodata</h6>
       <span  class="col-md-4" style="font-size: 14px;margin-left: 50px;width: 150px;display: inline-block;">Nama</span>
       <span class="col-md-6" style="font-size: 14px;display: inline-block;">: <?php echo $key->resume_nama_lengkap; ?></span>
       <br>
       <br>
     

    <span  class="col-md-4" style="font-size: 14px;margin-left: 50px;width: 150px;display: inline-block;">Tempat Tanggal Lahir</span>
    <span class="col-md-6" style="font-size: 14px;display: inline-block;">: 
      <?php $tgl_lahir = explode('-', $key->resume_tanggal_lahir);
      echo ucfirst(strtolower($key->resume_tempat_lahir)).", ".$tgl_lahir[2]." ".$bulan[$tgl_lahir[1]]." ".$tgl_lahir[0]; ?>

    </span>

    <br>
    <br>
    <span  class="col-md-4" style="font-size: 14px;margin-left: 50px;width: 150px;display: inline-block;">Jenis Kelamin</span>
    <span class="col-md-6" style="font-size: 14px;display: inline-block;">: <?php echo $key->resume_jenis_kelamin=="L" ? "Laki-Laki" :"Perempuan"; ?></span>
    <br>
    <br>

    <span  class="col-md-4" style="font-size: 14px;margin-left: 50px;width: 150px;display: inline-block;">Agama</span>
    <span class="col-md-6" style="font-size: 14px;display: inline-block;">: <?php echo $key->agama_nama; ?></span>
    <br>
    <br>
    <span  class="col-md-4" style="font-size: 14px;margin-left: 50px;width: 150px;display: inline-block;">Provinsi</span>
    <span class="col-md-6" style="font-size: 14px;display: inline-block;">: <?php echo $key->prov_nama; ?></span>
    <br>
    <br>
    <span  class="col-md-4" style="font-size: 14px;margin-left: 50px;width: 150px;display: inline-block;">Kabupaten / Kota</span>
    <span class="col-md-6" style="font-size: 14px;display: inline-block;">: <?php echo $key->kabkota_nama; ?></span>
   

    <br>
    <br>
    <?php if (count($pengalaman) > 0) { ?>
      <h6 style="font-weight: bold;color:red;margin-top:25px; margin-left: 50px;border-bottom: 1px solid red;width: 80%;margin-bottom: 25px">Pengalaman Kerja</h6>
     <ul>
       <?php foreach ($pengalaman as $pl): ?>
         <li style="margin-left: 50px;margin-bottom: 15px ">
          <span><?php echo ucfirst($pl->pengalaman_tahun_awal." - ".$pl->pengalaman_tahun_akhir); ?></span>
           
         </li>
       <?php endforeach ?>

     </ul>
   <?php } ?>
   <br>
   <br>

</div>
<br>
<br>

</div>
</body></html>
<?php endforeach ?>












