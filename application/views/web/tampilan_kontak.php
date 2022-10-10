<!-- Social Icons-->
<div class="jumbotron text-center">
    <h1>Kontak Kami</h1>
</div>

<div class="container mb-4">
    <!-- <h2 class="text-center">Kontak Kami</h2> -->
    <div class="row">
        <div class="col-md-6">
            <iframe width="100%" height="615" loading="lazy" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDJsW-9RFVRNAIhH-_p66qb-KjP7HabdvA&amp;q=solo%20technopark&amp;zoom=16" title="solo technopark" aria-label="solo technopark" data-rocket-lazyload="fitvidscompatible" class="lazyloaded" data-ll-status="loaded" frameborder="0"></iframe>
        </div>
        <div class="col-md-6">
            <label>Kunjungi kami</label>
            <h2>Butuh bantuan? Kunjungi kami</h2>
            <hr>
            <div class="card">
                <div class="card-body">
                    <h4><i class='fas fa-map-marker-alt' style='font-size:38px;color:red'></i> Lokasi</h4><br />
                    <?= $profile->stp_alamat; ?>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4><i class='fas fa-envelope' style='font-size:38px;color:red'></i> Email</h4><br />
                    <?= $profile->stp_email; ?>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4><i class='fas fa-phone' style='font-size:38px;color:red'></i> Telepon</h4><br />
                    <?= $profile->stp_telepon ?>
                </div>
            </div>
        </div>
    </div>
</div>