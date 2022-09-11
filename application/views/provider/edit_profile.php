<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1>Edit Profile</h1>
        </div>
        <div class="col-sm-2"><img title="profi-le image" style="height: 100px;" src="<?php echo base_url() . $this->session->stp_brand_icon ?>"></div>
    </div>
    <form class="form" action="javascript:;" id="form_user">
        <div class="row">
            <div class="col-sm-3">
                <!--left col-->
                <div class="text-center">
                    <img src="<?= $seeker->user_foto; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6>Upload a different photo...</h6>
                    <input type="file" class="text-center center-block file-upload" accept="image/*" name="user_photo" id="user_photo">
                    <input type="hidden" name="file_firebase" id="file_firebase" value="<?= $seeker->user_foto; ?>">
                    <input type="hidden" name="id_user" id="id_user" value="<?= $seeker->user_id; ?>">
                </div>
                </hr><br>

            </div>
            <!--/col-3-->
            <div class="col-sm-9">


                <div class="form-group">

                    <div class="col-xs-6">
                        <label for="nama">
                            <h4>Nama</h4>
                        </label>
                        <input type="text" class="form-control" name="user_nama" id="user_nama" value="<?= $seeker->user_nama; ?>" placeholder="Nama" title="enter your first name if any.">
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-xs-6">
                        <label for="user_telepon">
                            <h4>No telepon</h4>
                        </label>
                        <input type="text" class="form-control" name="user_telepon" id="user_telepon" value="<?= $seeker->user_telepon; ?>" placeholder="enter phone" title="enter your phone number if any.">
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-xs-6">
                        <label for="email">
                            <h4>Email</h4>
                        </label>
                        <input type="email" class="form-control" name="user_email" id="user_email" value="<?= $seeker->user_email; ?>" placeholder="you@email.com" title="enter your email.">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <button class="btn btn-lg btn-danger" type="button" id="btnSave"><i class="glyphicon glyphicon-ok-sign"></i> Simpan</button>
                        <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                    </div>
                </div>

                <hr>


            </div>
    </form>
    <!--/tab-content-->

</div>
<!--/col-9-->
</div>
<!--/row-->
<script>
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function() {
            readURL(this);
        });

        var save_method = "add";
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
                    $('#file_firebase').val(downloadURL);
                    save();
                    var file_di_firebase = "<?= $seeker->user_foto; ?>";
                    const myfile = firebase.storage();
                    myfile.refFromURL(file_di_firebase).delete();
                    console.log("File berhasil di hapus");
                })
            })
        } else {
            save();
        }
    })

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        url = "<?php echo site_url('seeker/update_user') ?>";

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

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: "Data berhasil di perbaharui"
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: data.error_string[i]
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
</script>