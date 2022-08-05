 <main>
  <style type="text/css">
    .btn-perusahaan:hover{
      color:  #f44a40 !important;
    }
    .header_perusahaan{
      height: 250px;
      border-radius: 55px;
      overflow: hidden;
    }
    .logo_perusahaan{
      width: 9rem;
      height: 9rem;
      position: absolute;
      left: 10% ;
      padding: 5px;
      bottom: -70px ;
      border-radius: 10px;
      background: #fff;
      box-shadow: 1px 4px 15px -4px rgba(0,0,0,0.65);
      -webkit-box-shadow: 1px 4px 15px -4px rgba(0,0,0,0.65);
      -moz-box-shadow: 1px 4px 15px -4px rgba(0,0,0,0.65);
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
    <div class="job-post-company pt-50 pb-120">
      <div class="container">
        <div class="row">
          <!-- Left Content -->
          <div class="col-xl-12 col-lg-12">
            <!-- job single -->
            <div class="header_perusahaan rounded"  <?php if ($pr->perusahaan_sampul!='') { ?>

              style="background-image: url(<?php echo $pr->perusahaan_sampul?>)"

            <?php  }else{ ?>

              style="background-image: url(<?php echo base_url() ?>assets/img/sampul.jpg)"

            <?php } ?>
            >
            <div class="logo_perusahaan d-flex flex-row justify-content-center align-items-center">
              <a href="#"
              ><img src="<?php echo $pr->perusahaan_logo ?>" style="width: 100%;" alt=""
              /></a>
              <!--          <a href="javascript:;" class="genric-btn large primary rounded" style="position: absolute;bottom: 0px;">Ganti Logo</a></a> -->

            </div>

          </div>


        </div>
        <div class="col-xl-12 col-lg-12 mt-5">
          <!-- job single -->
          <div class="single-job-items mb-50" style="border:0px !important;">
            <div class="job-items">

              <div class="job-tittle mt-5" >
                <a href="javascript:;">
                  <h4><?php echo $pr->perusahaan_nama ?></h4>
                </a>
                <p><?php echo $pr->perusahaan_alamat ?></p>
                <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo $pr->kabkota_nama." - ".$pr->prov_nama; ?></p>

                <ul>

                  <li>
                    <div class="job-tittle mt-5" >
                      <a href="javascript:;">
                        <h4>About Us</h4>
                      </a>
                    </div>
                    <?php echo $pr->perusahaan_sambutan; ?></li>
                    <br>
                    <li><?php echo $pr->prov_nama; ?></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

</main>

<script type="text/javascript">
  $('.item_bookmark').on('click',function(e){
    e.preventDefault();
    let job = $(this).data('job');
    let status = $(this).data('status');
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('job/bookmark')?>",
      dataType : "JSON",
      data : {'job':job,'status':status,},
      success: function(data){
        if (data!="Gagal") {
          if (data==0) {
            $('.item_bookmark').css('color','#b2b2b2');
            $('.item_bookmark').data('status','1');

          }else{
            $('.item_bookmark').css('color','#F82C2C');
            $('.item_bookmark').data('status','0');

          }
        }
      }
    });
  });
</script>