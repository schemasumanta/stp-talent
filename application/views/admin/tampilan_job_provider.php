<div class="container-fluid flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

  <h1 class="h3 mb-2 text-gray-800">Job Provider</h1>
  <p class="mb-4"></p>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <div class="col-md-12 mb-4">
          <h6 class="m-0 font-weight-bold text-primary">Data User Job Provider</h6>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tabel_job_provider" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
          <thead>
            <tr class="bg-danger text-light text-center">
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Level</th>
              <th>Telepon</th>
              <th>Foto</th>
              <th>Status</th>
              <th style="text-align: center;" width="10%">Opsi</th>
            </tr>
          </thead>
          <tbody id="show_data">
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
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

    dataTable = $('#tabel_job_provider').DataTable({
      paginationType: 'full_numbers',
      processing: true,
      serverSide: true,
      searching: true,

      filter: false,
      autoWidth: false,
      aLengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
      ],
      ajax: {
        url: '<?php echo base_url('user/tabel_job_provider') ?>',
        type: 'get',
        data: function(data) {}
      },
      language: {
        sProcessing: 'Sedang memproses...',
        sLengthMenu: 'Tampilkan _MENU_ entri',
        sZeroRecords: 'Tidak ditemukan data yang sesuai',
        sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
        sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
        sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
        sInfoPostFix: '',
        sSearch: 'Cari:',
        sUrl: '',
        oPaginate: {
          sFirst: '<<',
          sPrevious: '<',
          sNext: '>',
          sLast: '>>'
        }
      },
      // order: [1, 'asc'],
      columns: [{
          'data': 'no'
        },
        {
          'data': 'user_nama'
        },
        {
          'data': 'user_email'
        },
        {
          'data': 'level_nama'
        },
        {
          'data': 'user_telepon'
        },
        {
          'data': 'user_foto'
        },
        {
          'data': 'user_status'
        },
        {
          'data': 'opsi',
          orderable: false
        },

      ],
      columnDefs: [{
        targets: [0, 5, 6, -1],
        className: 'text-center'
      }, ]

    });


    function table_data() {
      dataTable.ajax.reload(null, true);
    }


    $(".refresh").click(function() {
      location.reload();
    });




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

  function show_password(id) {
    if ($('#' + id).attr('type') == "password") {
      $('#' + id).attr('type', 'text');
      $('.' + id).html('<i class="fa fa-eye-slash"></i>');
    } else {
      $('#' + id).attr('type', 'password');
      $('.' + id).html('<i class="fa fa-eye"></i>');

    }
  }


  $('#btn_aktivasi').on('click', function() {
    var kode = $('#kode_user_aktivasi').val();
    var isi = $('#isi_aktivasi').val();
    alert(kode);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('user/aktivasi_user') ?>",
      dataType: "JSON",
      data: {
        'kode': kode,
        'isi': isi
      },
      success: function(data) {
        let pesan = '';
        if (data) {
          if (isi == 1) {
            pesan = "Diaktifkan";
          } else {
            pesan = "DiNonaktifkan";
          }
          Swal.fire({
            title: 'Berhasil',

            text: 'Job Provider Berhasil Di ' + pesan,
            icon: 'success'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
              $('#ModalAktivasi').modal('hide');

              location.reload();

            }
          });
        }


      }
    });
    return false;
  });

  $('#show_data').on('click', '.item_aktivasi_user', function() {
    if ($(this).html().includes('check')) {
      $('.notif_aktivasi').html('Aktifkan Job Provider... ?');
      $('#isi_aktivasi').val(1);

    } else {
      $('.notif_aktivasi').html('Nonaktifkan Job Provider... ?');
      $('#isi_aktivasi').val(0);
    }

    var kode = $(this).attr('data');
    $('#ModalAktivasi').modal('show');
    $('#kode_user_aktivasi').val(kode);

    return false;
  });

  $('#show_data').on('click', '.item_edit_user', function() {
    let id_user = $(this).attr('data');
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('user/detail_user') ?>",
      dataType: "JSON",
      data: {
        'id_user': id_user
      },
      success: function(data) {

        $('#modal_user').modal('show');
        $('#form_user').attr('action', '<?php echo base_url('user/ubah') ?>');
        $('#btn_simpan').html('UBAH');
        $('.inputpassword').addClass('d-none');
        $('#label_header_user').html('<i class="fas fa-user mr-2"></i> UBAH DATA USER');
        $('#id_user').val(id_user);
        $('#user_nama').val(data[0].nama);
        $('#level').val(data[0].level).trigger('change');
        $('#cabang').val(data[0].id_cabang).trigger('change');
        $('#jabatan').val(data[0].id_jabatan).trigger('change');
        $('#email').val(data[0].email);
        $('#username').val(data[0].username);
        $('#telepon').val(data[0].telepon);
        $('#username_lama').val(data[0].username);
        $('#lampiran_user_lama').val(data[0].foto);
        if (data[0].foto != '') {
          $('#preview_lampiran_user').attr('src', '<?php echo base_url() ?>' + data[0].foto);

        }
      },

    });

    return false;
  });

  $('#btn_tambah').on('click', function() {
    $('#modal_user').modal('show');
    $('#form_user').attr('action', '<?php echo base_url('user/simpan') ?>');
    $('#btn_simpan').html('SIMPAN');

    $('#form_user').trigger("reset");
    $('#preview_lampiran_user').attr('src', '<?php echo base_url() ?>assets/img/img03.jpg');

    $('.inputpassword').removeClass('d-none');
    $('#label_header_user').html('<i class="fas fa-user mr-2"></i> TAMBAH DATA USER');
  });


  $('#show_data').on('click', '.item_edit_password', function() {
    var kode = $(this).attr('data');
    $('#modal_edit_password').modal('show');
    $('#id_user_password').val(kode);
    return false;
  });


  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka != 8 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }


  $('#btn_ubah_password').on('click', function() {
    let id_user = $('#id_user_password').val();
    let password = $('#password_baru').val();
    let confirm = $('#confirm_password').val();

    if (password == "") {
      $('#password_baru').focus();
      Swal.fire({
        title: 'Password Baru Kosong',
        text: 'Silahkan Masukkan Password Baru!',
        icon: 'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;

    }

    if (password !== confirm) {
      $('#confirm_password').focus();
      $('#confirm_password').val('');

      Swal.fire({
        title: 'Konfirmasi Password Tidak Cocok',
        text: 'Silahkan Masukkan Ulang Konfirmasi Password!',
        icon: 'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;

    }

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('user/ubah_password') ?>",
      dataType: "JSON",
      data: {
        'id_user': id_user,
        'password': password
      },
      success: function(data) {

        if (data) {

          Swal.fire({
            title: 'Berhasil',
            text: 'Password Berhasil Diubah',
            icon: 'success'


          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
              $('#modal_edit_password').modal('hide');
              location.reload();

            }
          });
        } else {

          Swal.fire({
            title: 'Gagal',
            text: 'Password Gagal Diubah',
            icon: 'error'


          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
              $('#modal_edit_password').modal('hide');
              location.reload();

            }
          });

        }



      }
    });
    return false;
  });

  $('#btn_simpan').on('click', function() {

    let user_nama = $('#user_nama').val();
    if (user_nama == "") {
      $('#user_nama').focus();
      Swal.fire({
        title: 'Nama Kosong',
        text: 'Silahkan Masukkan Nama!',
        icon: 'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }



    let user_level = $('#user_level').val();
    if (user_level == null) {
      $('#user_level').focus();
      Swal.fire({
        title: 'Level Kosong',
        text: 'Silahkan Pilih Level!',
        icon: 'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    }
    let user_email = $('#user_email').val();
    if (user_email == "") {
      $('#user_email').focus();
      Swal.fire({
        title: 'Email Kosong',
        text: 'Silahkan Masukkan Email!',
        icon: 'error'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close();
        }
      });
      return false;
    } else {

      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      if (!testEmail.test(user_email)) {
        $('#user_email').focus();
        Swal.fire({
          title: 'Format Email Salah',
          text: 'Silahkan Masukkan Email yang Valid!',
          icon: 'error'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
          }
        });
        return false;
      }
    }
    let cek = 0;
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('user/cek_email') ?>",
      dataType: "JSON",
      data: {
        'user_email': user_email
      },
      success: function(data) {
        let link = $('#form_user').attr('action');
        if (link.includes('simpan')) {
          if (data > 0) {
            cek += 1;
            $('#username').focus();
            Swal.fire({
              title: 'Username Sudah Digunakan',
              text: 'Silahkan Masukkan Username Lain!',
              icon: 'error'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.close();
              }
            });

            return false;

          } else {

            let password = $('#password').val();
            if (password == "") {
              cek += 1;
              $('#password').focus();
              Swal.fire({
                title: 'Password Kosong',
                text: 'Silahkan Masukkan Password!',
                icon: 'error'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.close();
                }
              });
              return false;
            } else {

              $('#btn_simpan').attr('disabled', 'disabled');
              $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');

              $('#form_user').submit();
            }

          }

        } else {

          let username_lama = $('#username_lama').val();

          if (data > 0 && username_lama != username) {
            $('#username_lama').focus();
            Swal.fire({
              title: 'Username Sudah Digunakan',
              text: 'Silahkan Masukkan Username Lain!',
              icon: 'error'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.close();
              }
            });

            return false;


          } else {
            $('#btn_simpan').attr('disabled', 'disabled');
            $('#btn_simpan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif">');


            $('#form_user').submit();
          }

        }

      }

    });

  });

  function approve_provider(id) {
    save_method = 'update';
    $('#form_approve')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo site_url('user/cek_perusahaan') ?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        $('[name="id"]').val(data.user_id);
        $('[name="perusahaan_nama"]').val(data.perusahaan_nama);
        $('[name="perusahaan_email"]').val(data.perusahaan_email);
        if (data.perusahaan_website) {
          $('[name="perusahaan_website"]').val(data.perusahaan_website);
        }
        $('#modal_approve').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Detail Approve'); // Set title to Bootstrap modal title

        $('#npwp-preview').show(); // show photo preview modal
        var base_url = "<?= base_url(); ?>"
        if (data.perusahaan_npwp) {
          $('#npwp-preview div').html(`<iframe
              src = "` + base_url + `assets/dokumen/npwp/` + data.perusahaan_npwp + `"
              frameBorder = "0"
              scrolling = "auto"
              height = "100%"
              width = "100%" >
              <
              /iframe>`);
        } else {
          $('#npwp-preview div').text('(NPWP Tidak ada)');
        }

        if (data.perusahaan_nib) {
          $('#nib-preview div').html(`<iframe
              src = "` + base_url + `assets/dokumen/nib/` + data.perusahaan_nib + `"
              frameBorder = "0"
              scrolling = "auto"
              height = "100%"
              width = "100%" >
              <
              /iframe>`);
        } else {
          $('#nib-preview div').text('(NPWP Tidak ada)');
        }


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function save_perusahaan() {
    $('#btnSave').text('menyimpan...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    url = "<?php echo site_url('user/approve_provider') ?>";

    // ajax adding data to database

    var formData = new FormData($('#form_approve')[0]);
    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data) {

        if (data.status) //if success close modal and reload ajax table
        {
          $('#modal_approve').modal('hide');
          Swal.fire({
            title: 'Berhasil',
            text: 'Data berhasil disimpan',
            icon: 'success'
          });
          reload_table();
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
          }
        }
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 

      }
    });
  }

  function reload_table() {
    dataTable.ajax.reload(null, false); //reload datatable ajax 
  }
</script>
<div class="modal fade" data-backdrop="static" id="ModalAktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-light">
        <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-users mr-2"></i> Status User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>

      </div>
      <form class="form-horizontal" method="post" action="<?php echo base_url('user/aktivasi_job_provider') ?>">
        <div class="modal-body">
          <input type="hidden" name="kode_user_aktivasi" id="kode_user_aktivasi" value="">
          <input type="hidden" name="isi_aktivasi" id="isi_aktivasi" value="">
          <div class="alert alert-danger">
            <p class="notif_aktivasi"></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
          <button type="submit" class="btn_aktivasi btn btn-success btn-flat" id="btn_aktivasi"><i class="fas fa-check mr-2"></i>YA</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_approve" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Person Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
        <form action="#" id="form_approve" class="form-horizontal">
          <input type="hidden" value="" name="id" />
          <div class="form-body">
            <div class="form-group">
              <label class="control-label">Nama Perusahaan</label>
              <div class="">
                <input name="perusahaan_nama" id="perusahaan_nama" class="form-control" type="text" readonly>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label ">Email Perusahaan</label>
              <div class="">
                <input name="perusahaan_email" id="perusahaan_email" class="form-control" type="text" readonly>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Website Perusahaan</label>
              <div class="">
                <a href="#" id="perusahaan_website" class="btn btn-danger btn-sm">Tidak ada</a>
                <span class="help-block"></span>
              </div>
            </div>
            <div id="npwp-preview" style="height: 500px;">
              <h4 class="control-label text-center">NPWP Perusahaan</h4>
              <div style="height: 500px;">
                (No photo)
                <span class="help-block"></span>
              </div>
            </div>
            <br />
            <hr>
            <br />
            <div id="nib-preview" style="height: 500px;">
              <h4 class="control-label  text-center">NIB Perusahaan</h4>
              <div style="height: 500px;">
                (No photo)
                <span class="help-block"></span>
              </div>
            </div>
            <br />
            <hr>
            <br />
            <div class="form-group">
              <label class="control-label">Status</label>
              <div class="">
                <select name="perusahaan_status" class="form-control">
                  <!-- <option value="">--Pilih Status--</option> -->
                  <option value="1">Terima</option>
                  <option value="3">Tolak</option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save_perusahaan()" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->