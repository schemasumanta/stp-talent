<style>
  .select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;
    top: 50%;
    width: 0;
    cursor: pointer
  }

  .select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;
    top: 50%;
    width: 0;
    cursor: pointer
  }
</style>
<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">User</h1>
  <p class="mb-4"></p>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <div class="col-md-12 mb-4">
          <h6 class="m-0 font-weight-bold text-primary">Data User</h6>

        </div>
        <div class="col-md-12">
          <button id="btn_tambah" class="btn btn-success btn-sm btn-md btn  mr-2" onclick="add()"><i class="fa fa-plus mr-2"></i> Tambah Data User</button>
        </div>

      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tabel_user" class="table table-striped table-bordered " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_user" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h3 class="modal-title">Person Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
        <form action="javascript:;" id="form_user" class="form-horizontal">
          <input type="hidden" value="" name="id" id="id" />
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4">Nama Lengkap</label>
              <div class="col-md-12">
                <input name="user_nama" id="user_nama" placeholder="Nama Lengkap" class="form-control" type="text">
                <span class="help-block text-danger" id="v_user_nama"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Email</label>
              <div class="col-md-12">
                <input name="user_email" id="user_email" placeholder="contoh@gmail.com" class="form-control" type="email">
                <span class="help-block text-danger" id="v_user_email"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">No Tlp</label>
              <div class="col-md-12">
                <input name="user_telepon" id="user_telepon" placeholder="08xxx" class="form-control" type="text">
                <span class="help-block text-danger" id="v_user_telepon"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Pilih menu</label>
              <div class="col-md-12">
                <select name="role_id[]" id="role_id" class="form-control" multiple="multiple" style="width: 100%;">
                  <option value="0" disabled>Pilih Menu</option>
                  <?php foreach ($menu as $key) { ?>
                    <option value="<?= $key->role_id; ?>"> <?= $key->role_menu; ?></option>
                  <?php }; ?>
                </select>
                <span class="help-block text-danger" id="v_role_id"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Password</label>
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="show_pw" onclick="show_password()"><i class="fa fa-eye"></i></button>
                  </div>
                </div>
                <p id="pw_edit">
                  <small class="text-danger">*Masukan Password jika ingin merubahnya</small>
                </p>
                <span class="help-block text-danger" id="v_user_password"></span>
              </div>
            </div>
            <div class="form-group" id="photo-preview">
              <label class="control-label col-md-4">Photo</label>
              <div class="col-md-4">
                <div class="card">
                  <img src="<?php echo base_url('assets_admin/img/avatar1.png'); ?>" class="card-img-top" alt="..." id="imgView_user">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4" id="label-photo">Upload Photo </label>
              <div class="col-md-12">
                <input name="user_photo" id="user_photo" type="file" multiple accept="image/*" onchange="loadFile(event)">
                <input type="hidden" name="file_firebase" id="file_firebase">
                <span class="help-block" id="v_photo"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<!-- 
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-database.js"></script> -->


<script type="text/javascript">
  $(document).ready(function() {
    // const firebaseConfig = {
    //   apiKey: "AIzaSyAbDiylzDJ_ukXTyTYeq85-Usnkp85fW6o",
    //   authDomain: "solo-digital-tech.firebaseapp.com",
    //   databaseURL: "https://solo-digital-tech-default-rtdb.firebaseio.com",
    //   projectId: "solo-digital-tech",
    //   storageBucket: "solo-digital-tech.appspot.com",
    //   messagingSenderId: "608688468148",
    //   appId: "1:608688468148:web:e503938ea2f4ea0eaa27e1",
    //   measurementId: "G-6GFS5NPL12"
    // };
    // // Initialize Firebase
    // firebase.initializeApp(firebaseConfig);
    $('#role_id').select2({
      multiple: true,
      placeholder: "Pilih menu",
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

    dataTable = $('#tabel_user').DataTable({
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
        url: '<?php echo base_url('user/tabel_user') ?>',
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


    $(".refresh").click(function() {
      location.reload();
    });

  });

  function reload_table() {
    dataTable.ajax.reload(null, false);
  }


  $("#user_photo").change(function(event) {
    fadeInAdd();
    getuser_photo(this);
  });

  $("#user_photo").on('click', function(event) {
    fadeInAdd();
  });

  document.getElementById('btnSave').addEventListener('click', function() {
    var file = document.getElementById('user_photo').files[0];
    console.log(file)
    if (file != null) {
      console.log(file.name);
      var storage = firebase.storage().ref('talent_hub/foto_user/' + file.name);
      var upload = storage.put(file);

      upload.on('state_changed', function(snapshot) {
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        console.log("upload is " + progress + " done");
      }, function(error) {
        console.log(error.message);
      }, function() {
        upload.snapshot.ref.getDownloadURL().then(function(downloadURL) {
          console.log(downloadURL);
          if (save_method == "add") {
            $('#file_firebase').val(downloadURL);
          } else {
            let photo = $('#file_firebase').val();
            if (photo != '') {
              const myfile = firebase.storage();
              myfile.refFromURL(photo).delete()
            }
            $('#file_firebase').val(downloadURL);
          }
          save();
        })
      })
    } else {
      save();
    }
  })


  function getuser_photo(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $("#user_photo").val();
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
      reader.onload = function(e) {
        // debugger;
        $('#imgView_user').attr('src', e.target.result);
        $('#imgView_user').hide();
        $('#imgView_user').fadeIn(500);
        $('.custom-file-label').text(filename);
      }
      reader.readAsDataURL(input.files[0]);
    }
    $(".alert").removeClass("loadAnimate").hide();
  }

  function fadeInAdd() {
    fadeInAlert();
  }

  function fadeInAlert(text) {
    $(".alert").text(text).addClass("loadAnimate");
  }



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

  function show_password() {
    if ($('#user_password').attr('type') == "password") {
      $('#user_password').attr('type', 'text');
      $('#show_pw').html('<i class="fa fa-eye-slash"></i>');
    } else {
      $('#user_password').attr('type', 'password');
      $('#show_pw').html('<i class="fa fa-eye"></i>');
    }
  }

  function add() {
    save_method = 'insert';
    $('#form_user')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_user').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah User'); // Set Title to Bootstrap modal title
    $('#pw_edit').hide();
    // $('#photo-preview').hide(); // hide photo preview modal

    $('#label-photo').text('Upload Photo'); // label photo upload
  }

  function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    if (save_method == 'insert') {
      url = "<?php echo site_url('user/insert_user') ?>";
    } else {
      url = "<?php echo site_url('user/update_user') ?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form_user')[0]);
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
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          if (save_method == "insert") {
            Toast.fire({
              icon: 'success',
              title: 'Tambah data berhasil'
            })
          } else if (save_method == "update") {
            Toast.fire({
              icon: 'success',
              title: 'Ubah data berhasil'
            })
          }

          $('#modal_user').modal('hide');
          reload_table();
          $('#imgView_user').attr('src', 'assets_admin/img/avatar1.png');
          setTimeout(function() {
            location.reload();
          }, 1000);
        } else {
          $('.help-block').empty();
          $('.form-control').removeClass("is-invalid");
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[id="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
            $('#v_' + data.inputerror[i] + '').text(data.error_string[i])
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: "Ada yg belum diisi atau tidak sesuai ketentuan"
            })
          }
        }
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 


      },
      error: function(jqXHR, textStatus, errorThrown) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: "error dicoding silahkan kontak developer"
        });
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 

      }
    });
  }

  function changeStatus(id) {
    var isChecked = $('#set_active' + id);
    $.ajax({
      type: "POST",

      url: '<?php echo site_url('user/setStatus') ?>',

      data: {
        id: id
      },
      dataType: "JSON",
      success: function(response) {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        if (response.status) {
          isChecked.next().text($(isChecked).is(':checked') ? 'Aktif' : 'Nonaktif');
          Toast.fire({
            icon: 'success',
            title: 'Ubah status berhasil'
          })
        } else {
          isChecked.prop('checked', isChecked.is(':checked') ? null : 'checked');
          Toast.fire({
            icon: 'warning',
            title: 'Ubah status gagal'
          })
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        isChecked.prop('checked', isChecked.is(':checked') ? null : 'checked');
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: "error dicoding silahkan kontak developer"
        });
      },
    });
  }

  function edit_user(id) {
    save_method = 'update';
    $('#form_user')[0].reset(); // reset form on modals
    $('.form-group').removeClass('is-invalid'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo site_url('user/get_data_user') ?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        $('[name="id"]').val(data.isi.user_id);
        $('[name="user_nama"]').val(data.isi.user_nama);
        $('[name="user_email"]').val(data.isi.user_email);
        $('[name="user_telepon"]').val(data.isi.user_telepon);
        $('#pw_edit').show();
        $('#modal_user').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
        if (data.isi.user_foto) {
          $('#label-photo').text('Change Photo'); // label photo upload
          $('#photo-preview div').html('<img src="' + data.isi.user_foto + '" class="card-img-top" id="imgView_user">'); // show photo
          $('#file_firebase').val(data.isi.user_foto);
        } else {
          $('#label-photo').text('Upload Photo'); // label photo upload
          $('#photo-preview div').text('(No photo)');
        }

        var selectM = [];
        $.each(data.menu, function(i, v) {
          selectM.push(v.role_id)
        });
        $("#role_id").select2({
          multiple: true,
        });
        $('#role_id').val(selectM).trigger('change');

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
</script>