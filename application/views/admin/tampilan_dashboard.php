<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Job Provider</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $provider; ?></div>
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
                                Job Seeker</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $seeker; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Job Posting
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $job_posting; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2500</div>
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
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Grafik jumlah orang melihat postingan lowongan pekerjaan</h6>
                    <div class="dropdown no-arrow">
                        <form class="form-inline" id="form_view_posting" action="javascript:;">
                            <div class="form-group mb-2">
                                <?php $bulan = [
                                    1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                ];
                                ?>
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php foreach ($bulan as $key => $value) { ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php }; ?>
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    $thn_skr = date('Y');
                                    for ($x = $thn_skr; $x >= 2020; $x--) {
                                    ?>
                                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger mb-2" onclick="grafik_postingan()">Tampilkan</button>
                        </form>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <canvas height="80" id="view_postingan"></canvas>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('user/job_posting'); ?>" class="btn btn-sm btn-danger">Lihat Detail Per Postingan</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

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

        grafik_postingan();
    });

    function grafik_postingan() {
        $.ajax({
            url: "<?php echo base_url('dashboard/get_postingan') ?>",
            type: "POST",
            data: $('#form_view_posting').serialize(),
            dataType: "JSON",
            success: function(data) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                if ($("#view_postingan").length) {
                    var label = [];
                    var value = [];
                    for (var i in data) {
                        label.push(data[i].tgl);
                        value.push(data[i].jml);
                    }
                    Chart.defaults.global.legend.labels.usePointStyle = true;
                    var ctx = document.getElementById('view_postingan').getContext("2d");
                    var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 90);
                    gradientStrokeViolet.addColorStop(0, '#e74a3b');
                    gradientStrokeViolet.addColorStop(1, '#e74a3b');
                    var gradientLegendViolet = '#e74a3b';
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: label,
                            datasets: [{
                                label: "Dilihat",
                                borderColor: gradientStrokeViolet,
                                backgroundColor: gradientStrokeViolet,
                                hoverBackgroundColor: gradientStrokeViolet,
                                legendColor: gradientLegendViolet,
                                pointRadius: 0,
                                fill: false,
                                borderWidth: 2,
                                fill: 'origin',
                                data: value
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
                    $("#view_postingan-legend").html(myChart.generateLegend());
                }
            }
        })
    }
</script>