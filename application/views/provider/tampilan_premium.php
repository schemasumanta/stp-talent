<style>
    .pricing .card {
        border: none;
        border-radius: 1rem;
        transition: all 0.2s;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .pricing hr {
        margin: 1.5rem 0;
    }

    .pricing .card-title {
        margin: 0.5rem 0;
        font-size: 0.9rem;
        letter-spacing: .1rem;
        font-weight: bold;
    }

    .pricing .card-price {
        font-size: 3rem;
        margin: 0;
    }

    .pricing .card-price .period {
        font-size: 0.8rem;
    }

    .pricing ul li {
        margin-bottom: 1rem;
    }

    .pricing .text-muted {
        opacity: 0.7;
    }

    .pricing .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        opacity: 0.7;
        transition: all 0.2s;
    }

    /* Hover Effects on Card */

    @media (min-width: 992px) {
        .pricing .card:hover {
            margin-top: -.25rem;
            margin-bottom: .25rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
        }

        .pricing .card:hover .btn {
            opacity: 1;
        }
    }
</style>
<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tingkatkan akun ke Premium</h1>
    </div>
    <section class="pricing py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <!-- Plus Tier -->
                <div class="col-lg-6 ">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center">Premium User</h5>
                            <h6 class="card-price text-center"><?= "Rp " . number_format($premium->premium_harga, 0, ',', '.'); ?><span class="period">/month</span></h6>
                            <input type="hidden" id="harga_premium" value="<?= $premium->premium_harga; ?>">
                            <input type="hidden" id="id_premium" value="<?= $premium->premium_id; ?>">
                            <hr>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Job Posting yang tak terhingga</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Fitur untuk merahasiakan gaji dan profile perusahaan di view Job Posting</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Banner / Badge Premium membedakan Job posting premium</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Tampil paling atas pada saat pencarian lowongan</li>
                            </ul>
                            <div class="d-grid text-center">
                                <a href="javascript:;" onclick="buy()" class="btn btn-primary text-uppercase">Upgrade</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>

<script>
    $(document).ready(function() {});

    function buy() {
        let price = $("#harga_premium").val();
        let id = $("#id_premium").val();
        if (price == undefined) {
            alert("kosong");
            return false;
        } else {
            var url;

            url = "<?php echo site_url('provider/payment') ?>";

            $.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                data: {
                    price: price,
                    id: id,
                },

                success: (result) => {
                    console.log(result);
                    loadJokulCheckout(result.response.payment.url);
                    cek_status();
                },
                error: (xhr, textStatus, error) => {
                    console.log(textStatus);
                },
            });
        }
    }

    function cek_status() {
        var url;

        url = "<?php echo site_url('provider/get_status') ?>";

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: (result) => {
                console.log(result);
            },
            error: (xhr, textStatus, error) => {

            },
        });
    }
</script>