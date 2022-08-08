<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<style type="text/css">
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        height: 25px;
        width: 25px;
        outline: black;
        background-size: 100%, 100%;
        border-radius: 50%;
        background-image: none;
    }

    .carousel-control-next-icon:after
    {
        content: '>';
        font-size: 10px;
        color: white;
    }

    .carousel-control-prev-icon:after {
        content: '<';
        font-size: 10px;
        color: white;
    }

    /*@media only screen and (min-width: 600px){
        .carousel-item{
            padding-left: 90px;padding-right: 90px
        }
        }*/
    </style>

    <div class="container-fluid   flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
        <div class="d-sm-flex mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <?php if (count($slider) > 0) { ?>

            <div class="row">
             <div class="col-xl-12 col-md-12  mb-5 w-100  h-100">
                <div id="carouselExampleControls" class="carousel slide shadow" data-ride="carousel" style="height: 300px;width:100%;overflow: hidden;border-radius: 10px">
                    <div class="carousel-inner">
                        <?php $i=0; foreach ($slider as $slide): ?>
                        <?php if ($slide->slider_status > 0) {?>
                            <?php if ($i==0) {?>
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?php echo base_url().$slide->slider_gambar ?>" alt="First slide">
                                </div>
                            <?php }else{ ?>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="<?php echo base_url().$slide->slider_gambar ?>" alt="Second slide">
                                </div>
                            <?php }} ?>
                            <?php $i++; endforeach ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <br>
            </div>

        <?php } ?>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Job Posting</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $job_posting; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Submission</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $submission; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Report
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $reported; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flag fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Visitor</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $visitor; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
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
  });

</script>


