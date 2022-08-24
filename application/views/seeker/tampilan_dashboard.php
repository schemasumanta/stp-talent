<!-- Begin Page Content -->
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

    .carousel-control-next-icon:after {
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
<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <!-- Page Heading -->
    <form action="javascript:void(0);" id="form_cari" class="d-none d-sm-inline-block form-inline navbar-search mb-4" style="width: 85%;margin-left: 3rem; margin-top:-25rem;">
        <div class="input-group ">
            <input type="text" name="nama_lowongan" id="nama_lowongan" class="form-control bg-light border-0 small" placeholder="Cari Lowongan" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-prepend">
                <button class="btn btn-danger" type="submit" id="btnSave">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>

        </div>
    </form>

    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <!-- Content Row -->
    <?php if (count($slider) > 0) { ?>

        <div class="row">
            <div class="col-xl-12 col-md-12  mb-5 w-100  h-100">
                <div id="carouselExampleControls" class="carousel slide shadow" data-ride="carousel" style="height: 300px;width:100%;overflow: hidden;border-radius: 10px">
                    <div class="carousel-inner">
                        <?php $i = 0;
                        foreach ($slider as $slide) : ?>
                            <?php if ($slide->slider_status > 0) { ?>
                                <?php if ($i == 0) { ?>
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo base_url() . $slide->slider_gambar ?>" alt="First slide">
                                    </div>
                                <?php } else { ?>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url() . $slide->slider_gambar ?>" alt="Second slide">
                                    </div>
                            <?php }
                            } ?>
                        <?php $i++;
                        endforeach ?>
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
                                Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $submission; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Saved Job</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $saved_job; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
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
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Grafik jumlah orang yang melihat anda</h6>
                    <div class="dropdown no-arrow">
                        <form class="form-inline">
                            <div class="form-group mb-2">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">Agustus</option>
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">2022</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger mb-2">Tampilkan</button>
                        </form>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <canvas height="80" id="visit-sale-chart2"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script src="<?= base_url(); ?>assets_admin/vendor/apex_chart/apexcharts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
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

        $(function() {
            Chart.defaults.global.legend.labels.usePointStyle = true;
            if ($("#visit-sale-chart2").length) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('visit-sale-chart2').getContext("2d");
                var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 90);
                gradientStrokeViolet.addColorStop(0, 'red');
                gradientStrokeViolet.addColorStop(1, 'red');
                var gradientLegendViolet = 'red';
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['1-08-2022', '2-08-2022', '3-08-2022', '4-08-2022', '5-08-2022', '6-08-2022', '7-08-2022', '8-08-2022', '9-08-2022', '10-08-2022', '11-08-2022', '12-08-2022', '13-08-2022', '14-08-2022', '15-08-2022', '16-08-2022', '17-08-2022', '18-08-2022', '19-08-2022', '20-08-2022', '21-08-2022', '22-08-2022', '23-08-2022', ],
                        datasets: [{
                            label: "Jumlah Orang yang melihat",
                            borderColor: gradientStrokeViolet,
                            backgroundColor: gradientStrokeViolet,
                            hoverBackgroundColor: gradientStrokeViolet,
                            legendColor: gradientLegendViolet,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 2,
                            fill: 'origin',
                            data: [120, 140, 125, 171, 25, 50, 30, 20, 90, 10, 11, 12, 20, 90, 10, 11, 12, 15, 171, 25, 50, 11, 200]
                        }, ]
                    },
                    options: {
                        responsive: true,
                        legend: false,
                        legendCallback: function(chart) {
                            var text = [];
                            text.push('<ul>');
                            for (var i = 0; i < chart.data.datasets.length; i++) {
                                text.push('<li><span class="legend-dots" style="background:' +
                                    chart.data.datasets[i].legendColor +
                                    '"></span>');
                                if (chart.data.datasets[i].label) {
                                    text.push(chart.data.datasets[i].label);
                                }
                                text.push('</li>');
                            }
                            text.push('</ul>');
                            return text.join('');
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                },
                                gridLines: {
                                    drawBorder: false,
                                    color: 'rgba(235,237,242,1)',
                                    zeroLineColor: 'rgba(235,237,242,1)'
                                }
                            }],
                            xAxes: [{
                                barPercentage: 0.6
                            }]
                        }
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                })
                $("#visit-sale-chart2-legend").html(myChart.generateLegend());
            }
        });
    });
    $('#form_cari').submit(function(e) {
        e.preventDefault();

        $('#btnSave').text('mencari...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        url = "<?php echo site_url('job/cari_job') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_cari').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    window.location.replace("<?= base_url('job/job_listing') ?>");
                }

                $('#btnSave').text('Finding Job'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Finding Job'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    });
</script>