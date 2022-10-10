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
    <?php
    if ($user_premium) { ?>
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Akun Premium</h1>
        </div>
        <div class="table-responsive">
            <table id="tabel_premium" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                <thead>
                    <tr class="bg-danger text-light text-center">
                        <th>No</th>
                        <th>No Invoice</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Aktif sampai</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php } else { ?>
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tingkatkan akun ke Premium</h1>
        </div>
        <section class="pricing py-5" id="upgrade_premium">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <!-- Plus Tier -->
                    <div class="col-lg-6 ">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Paket <?= $premium->premium_bulan; ?> Bulan Premium User</h5>
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



    <?php };
    ?>
    <div class="card text-center d-none" id="get_status_pay">
        <div class="card-header" id="bank_va">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title" id="no_va">Special title treatment</h5>
            <p class="card-text">Jumlah Pembayaran</p>
            <p class="card-text" id="jml_pembayaran">Rp.</p>
            <p class="card-text" id="status_pembayaran">?</p>
            <a href="javascript:;" onclick="buy()" class="btn btn-primary text-uppercase">Ganti Pembayaran</a>
        </div>
        <div class="card-footer text-muted">
            Silahkan Melakukan pembayaran pada no VA tersebut, Jika ingin melalukan pergantian pembayaran silahkan klik ganti pembayaran
        </div>
    </div>
</div>


<script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>

<script>
    $(document).ready(function() {
        //datatables
        table = $('#tabel_premium').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('provider/tabel_premium') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //last column
                "orderable": false, //set not orderable
            }, {
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }, {
                "targets": [4], //last column
                "orderable": false, //set not orderable
            }, ],

        });

        <?php
        if ($user_premium == false) { ?>
            setInterval('cek_status()', 15000);
        <?php } else { ?>
            setInterval('cek_status_perpanjangan()', 15000);
        <?php }; ?>
    });

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
                if (result.transaction.status == "SUCCESS") {

                    notifikasi_lampiran = "<?= base_url('provider/premium') ?>";

                    let post = {
                        notifikasi_judul: "Upgrade Premium",
                        notifikasi_isi: "Upgrade Akun Premium Anda Berhasil, Pembayaran telah diterima.",
                        notifikasi_penerima: 'Job Provider',
                        notifikasi_link: '<?= base_url('provider/premium') ?>',
                        notifikasi_lampiran: "kosong",
                        notifikasi_order: $.now(),
                        notifikasi_tanggal: '<?php echo date('Y-m-d H:i:s') ?>',
                        notifikasi_pengirim: '1',
                    };

                    newpost = firebase.database().ref('/Notification/').child('MasterNotification').push().key;
                    $('#notifikasi_key').val(newpost);

                    let update = {};
                    update['/Notification/MasterNotification/' + newpost + '/'] = post;

                    firebase.database().ref().update(update, (error) => {
                        if (error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Notifikasi Gagal Dikirim!',
                                icon: 'error'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.close();
                                    return false;
                                }
                            });
                        } else {
                            let post = {
                                notifikasi_judul: "Upgrade Premium",
                                notifikasi_isi: "Upgrade Akun Premium Anda Berhasil, Pembayaran telah diterima.",
                                notifikasi_key: newpost,
                                notifikasi_penerima: "<?= $this->session->user_id; ?>",
                                notifikasi_link: '<?= base_url('provider/premium') ?>',
                                notifikasi_lampiran: "-",
                                notifikasi_order: $.now(),
                                notifikasi_read_status: 0,
                                notifikasi_tanggal: '<?php echo date('Y-m-d H:i:s'); ?>',
                                notifikasi_pengirim: '<?php echo 0; ?>',
                            };

                            let newnotif = firebase.database().ref().child('/UserNotification/').push().key;
                            let update = {};
                            update['/UserNotification/' + newnotif + '/'] = post;
                            firebase.database().ref().update(update, (error) => {
                                if (error) {
                                    console.log("Error di kirim notif");
                                } else {
                                    upgrade_premium();
                                    Swal.fire(
                                        'Berhasil',
                                        'Pembayaran berhasil, akun anda sekarang premium',
                                        'success'
                                    )
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1500);

                                }
                            });
                        }
                    });

                } else {
                    $('#get_status_pay').removeClass('d-none');
                    $('#upgrade_premium').addClass('d-none');
                    $('#no_va').text(result.virtual_account_info.virtual_account_number);
                    $('#bank_va').text(result.acquirer.id);
                    $('#jml_pembayaran').text(result.order.amount);
                    $('#status_pembayaran').text(result.transaction.status);

                }

            },
            error: (xhr, textStatus, error) => {

            },
        });
    }

    function upgrade_premium() {
        var url;

        url = "<?php echo site_url('provider/payment_sukses') ?>";

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: (result) => {
                setTimeout(function() {
                    location.reload();
                }, 1500);

            },
            error: (xhr, textStatus, error) => {

            },
        });
    }

    function perpanjang() {
        let price = '<?= $premium->premium_harga; ?>'
        let id = '<?= $premium->premium_id; ?>';
        if (price == undefined) {
            alert("kosong");
            return false;
        } else {
            var url;

            url = "<?php echo site_url('provider/perpanjang') ?>";

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

    function cek_status_perpanjangan() {
        var url;

        url = "<?php echo site_url('provider/get_status/perpanjangan') ?>";

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: (result) => {
                if (result.transaction.status == "SUCCESS") {

                    notifikasi_lampiran = "<?= base_url('provider/premium') ?>";

                    let post = {
                        notifikasi_judul: "Perpanjangan Premium",
                        notifikasi_isi: "Perpangjangan Akun Premium Anda Berhasil, Pembayaran telah diterima.",
                        notifikasi_penerima: 'Job Provider',
                        notifikasi_link: '<?= base_url('provider/premium') ?>',
                        notifikasi_lampiran: "kosong",
                        notifikasi_order: $.now(),
                        notifikasi_tanggal: '<?php echo date('Y-m-d H:i:s') ?>',
                        notifikasi_pengirim: '1',
                    };

                    newpost = firebase.database().ref('/Notification/').child('MasterNotification').push().key;
                    $('#notifikasi_key').val(newpost);

                    let update = {};
                    update['/Notification/MasterNotification/' + newpost + '/'] = post;

                    firebase.database().ref().update(update, (error) => {
                        if (error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Notifikasi Gagal Dikirim!',
                                icon: 'error'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.close();
                                    return false;
                                }
                            });
                        } else {
                            let post = {
                                notifikasi_judul: "Perpanjangan Premium",
                                notifikasi_isi: "Perpangjangan Akun Premium Anda Berhasil, Pembayaran telah diterima.",
                                notifikasi_key: newpost,
                                notifikasi_penerima: "<?= $this->session->user_id; ?>",
                                notifikasi_link: '<?= base_url('provider/premium') ?>',
                                notifikasi_lampiran: "-",
                                notifikasi_order: $.now(),
                                notifikasi_read_status: 0,
                                notifikasi_tanggal: '<?php echo date('Y-m-d H:i:s'); ?>',
                                notifikasi_pengirim: '<?php echo 0; ?>',
                            };

                            let newnotif = firebase.database().ref().child('/UserNotification/').push().key;
                            let update = {};
                            update['/UserNotification/' + newnotif + '/'] = post;
                            firebase.database().ref().update(update, (error) => {
                                if (error) {
                                    console.log("Error di kirim notif");
                                } else {
                                    perpanjang_premium(newpost);
                                }
                            });
                        }
                    });
                } else {
                    $('#get_status_pay').removeClass('d-none');
                    $('#upgrade_premium').addClass('d-none');
                    $('#no_va').text(result.virtual_account_info.virtual_account_number);
                    $('#bank_va').text(result.acquirer.id);
                    $('#jml_pembayaran').text(result.order.amount);
                    $('#status_pembayaran').text(result.transaction.status);

                }

            },
            error: (xhr, textStatus, error) => {

            },
        });
    }

    function perpanjang_premium(newpost) {
        var url;

        url = "<?php echo site_url('provider/perpanjang_sukses') ?>";

        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: {
                key: newpost,
            },
            success: (result) => {
                if (result.status == true) {
                    Swal.fire(
                        'Berhasil',
                        'Pembayaran berhasil, akun anda sekarang premium',
                        'success'
                    )
                    setTimeout(function() {
                        location.reload();
                    }, 1500);

                } else {
                    Swal.fire(
                        'Gagal',
                        'Mohon Maaf ada kendala',
                        'warning'
                    )
                }

            },
            error: (xhr, textStatus, error) => {

            },
        });
    }
</script>