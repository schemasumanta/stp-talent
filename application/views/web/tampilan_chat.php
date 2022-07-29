<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->

<style type="text/css">



  #lampiran_pas_photo{
    opacity: 0 !important;
    padding: 0 !important;
    width: 100%!important;

  }
  .imagecheck-figure > img {
    width: 100%!important;
  }
  #search_chat{
    border:1px solid #dd2727!important;
    box-shadow: outset;
  }
  .header_chatting{
    height: 90px!important;
    width: 100%;
    background: rgb(252,30,14);
    background: radial-gradient(circle, rgba(252,30,14,1) 0%, rgba(255,63,63,0.9) 49%, rgba(255,0,0,1) 100%);
    border-top-right-radius: 5rem;
    border-bottom-right-radius: 5rem;
    box-shadow: -1px 8px 5px -1px rgba(0,0,0,0.57);
    -webkit-box-shadow: -1px 8px 5px -1px rgba(0,0,0,0.57);
    -moz-box-shadow: -1px 8px 5px -1px rgba(0,0,0,0.57);
  }



  .search{
   position: relative;
   box-shadow: 0 0 40px rgba(51, 51, 51, .1);
   width: 90%;
   text-align: center;

 }

 .search input{

  height: 40px;
  text-indent: 25px;
  border: 2px solid #e24536;


}
.search input:focus{
  box-shadow: none;
  border: 2px solid #fc1e0e;


}
.reset_break{
  clear: both;
}

.search .fa-search{
  position: absolute;
  top: 12px;
  left: 16px;
}

.isi_chatting{
  height: 500px;
  padding: 15px;
  overflow-y:scroll;
  /*border:1px solid black;*/
}

.isi_chatting_penerima{
  padding: 15px;
  border:2px solid #e3e6f0;
  background: #6aa946;
  border-bottom-right-radius: 1em;
  border-top-left-radius: 1em;
}

.isi_chatting_pengirim{
  padding: 15px;
  border:2px solid #e3e6f0;
  background: #ededed;
  border-bottom-right-radius: 1em;
  border-top-left-radius: 1em;

}
</style>

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

<!-- style="background: rgb(252,30,14);
      
  background: radial-gradient(circle, rgba(252,30,14,1) 0%, rgba(255,63,63,0.9) 49%, rgba(255,0,0,1) 100%);" -->

  <div class="container-fluid  flashdatart p-5" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
   <div class="row p-3 style="background: transparent; max-height:90%">
    <div class="col-md-12 mb-4">
      <div class="card  mb-4 rounded" style="background: transparent; ">
        <div class="card-body py-3">

          <?php var_dump($contact_chat) ?>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4 d-flex flex-row align-items-start rounded-left" style="background: white">
                  <div class="search mt-3 d-flex justify-content-center flex-row">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" placeholder="Cari Pesan">
                  </div>
                </div>
                <div class="col-md-8 rounded-right reset_break" style="background: transparent;">
                  <?php if (count($penerima) > 0) { ?>
                    <?php foreach ($penerima as $key): ?>
                      
                  <div class="header_chatting row d-flex flex-row align-items-center">
                    <span class="col-md-1" style="cursor: pointer;"><i class="fa fa-ellipsis-v text-white fa-2x" aria-hidden="true"></i></span>

                    <span class="col-md-9 text-white text-right">
                      <b><?php echo $key->user_nama; ?></b>
                      <input type="hidden" id="chat_penerima" name="chat_penerima" value="<?php echo $key->user_id ?>">
                      <br>
                      <?php echo $key->user_login_status==1 ? "Online":"Offline"; ?>
                    </span>
                    <span class="col-md-2 text-right">
                      <a class="nav-link" href="javascript:;"  aria-expanded="false">
                        <img class="img-profile rounded-circle"
                        src="<?php echo base_url().$key->user_foto ?>" style="max-height: 60px;width: auto;">
                      </a>
                    </span>
                  </div>

                    <?php endforeach ?>


                  <?php } ?>
                  <input type="hidden" id="chat_id" name="chat_id" value="<?php echo $id_chat ?>">
                  <div class="isi_chatting row mt-5">
                    <div class="col-md-12 ">
                      <div class="row p-0 chatbox">
                       <!--  <div class="col-md-6 isi_chatting_penerima mr-2">
                          <div class="row">
                            <img id="profil" class="rounded-circle " src="<?php echo $this->session->user_foto ?>" style="width:35px;position: absolute;top:-15px;left:-15px">
                            <div class="col-md-12 text-justify">
                              <span class="chat_text" style="color: white;font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                              <span style="position: absolute;bottom:-15px;right: 10px;font-size: 12px;color: white;font-weight: bold;">25 Agustus 2022</span>
                            </div>
                          </div>
                        </div> -->
                        <!-- <div class="col-md-6  mt-3"></div>  
                        <div class="col-md-6 mt-3 isi_chatting_pengirim float-right">                          <div class="row">
                          <img id="profil" class="rounded-circle " src="<?php echo $this->session->user_foto ?>" style="width:35px;position: absolute;top:-15px;right:-15px">
                          <div class="col-md-12 text-justify">
                            <span class="chat_text" style="color: black;font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                            <span style="position: absolute;bottom:-15px;right: 10px;font-size: 12px;color: black;font-weight: bold;">25 Agustus 2022</span>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="form_chatting row mt-5 d-flex flex-row align-items-center">
                  <div class="col-md-10">
                    <input type="text" id="isi_pesan" name="isi_pesan" class="form-control" placeholder="Masukkan Pesan">
                  </div>
                  <div class="col-md-2  d-flex flex-row align-items-center justify-content-around">
                    <i class="fas fa-paperclip text-danger" style="cursor: pointer;"></i>
                    <i class="fas fa-smile  text-warning"   style="cursor: pointer;"></i>
                    <i class="fas fa-paper-plane  text-success"  style="cursor: pointer;"></i>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>


  </div>
</div>
</div>



<div class="modal fade" id="ModalUploadResume" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form id="form_upload" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/upload_resume') ?>">
      <div class="modal-header">
        <h5 class="modal-title">Upload CV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>File Resume</label>
        <input type="file" name="file-cv" id="file-cv" class="form-control">
        <input type="hidden" class="form-control" name="lampiran_cv" id="lampiran_cv" class="form-control">
        <small class="error-file-cv text-danger"></small>

      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary" data-dismiss="modal" style="border-radius: 0px">Tutup</button>
        <button type="button" class="genric-btn danger item_upload_resume" style="border-radius: 0px">Upload</button>
      </div>
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
  function previewFile(id) {
    let file = $('#'+id)[0].files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      $('#preview_'+id).attr('src',reader.result);
    }, false);
    if (file) {
      reader.readAsDataURL(file);
      
    }
  }

  // var files = [];
  // document.getElementById("file-cv").addEventListener("change", function(e) {
  //   files = e.target.files;
  // });

  // document.getElementById("lampiran_pas_photo").addEventListener("change", function(e) {
  //   files = e.target.files;
  //   previewFile('lampiran_pas_photo');

  // });

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

  function getPathStorageFromUrl(url){

    const baseUrl = "https://firebasestorage.googleapis.com/v0/b/project-80505.appspot.com/o/";

    let imagePath = url.replace(baseUrl,"");

    const indexOfEndPath = imagePath.indexOf("?");

    imagePath = imagePath.substring(0,indexOfEndPath);
    
    imagePath = imagePath.replace("%2F","/");
    
    return imagePath;
  }



  function hanyaAngka(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }


  $(document).on('click','.item_upload_resume',function(){
    if (files.length==0) {
      $('.error-file-cv').html('Silahkan Upload File Resume');
      return false;
    }else{

      let resume_lama = $('.item_lihat_resume').attr('href');
      if (resume_lama!='') {
        const myfile = firebase.storage();
        myfile.refFromURL(resume_lama).delete()
      } 

      for (let i = 0; i < files.length; i++) {
        var storage = firebase.storage().ref('talent_hub/cv/'+files[i].name);
        var upload = storage.put(files[i]);
        upload.on(

          "state_changed",
          function progress(snapshot) {
          },

          function error() {
            $('.error-file-cv').html("Upload File Error");
          },

          function complete() {
            storage
            .getDownloadURL()
            .then(function(url) {
              $('#lampiran_cv').val(url);

              $('#form_upload').submit();
            })
            .catch(function(error) {
              console.log("error encountered");
            });
          },
          );


      }
    }
  });




  $(document).ready(function(){
    var chat_id = '<?php echo $id_chat ?>';
    var rootchatref = firebase.database().ref('/');  
    var chatref = firebase.database().ref('/Chat/'+chat_id+'/').orderByChild('chat_tanggal');  
    // .equalTo('<?php echo $this->session->user_id ?>')
    chatref.on('child_added', function(snapshot) { 
     var data = snapshot.val();  
     console.log(JSON.stringify(data));

     if(data.chat_pengirim == '<?php echo $this->session->user_id; ?>')
     {

      $('.chatbox').append(`<div class="col-md-6 mt-3"></div>  
        <div class="col-md-6 mt-3 isi_chatting_pengirim float-right"><div class="row"><img id="profil" class="rounded-circle " src="<?php echo base_url() ?>`+data.chat_photo+`" style="width:35px;position: absolute;top:-15px;right:-15px">
        <div class="col-md-12 text-justify">
        <span class="chat_text" style="color: black;font-size: 14px">`+data.chat_isi+`</span>
        <span style="position: absolute;bottom:-15px;right: 10px;font-size: 12px;color: black;font-weight: bold;">`+data.chat_tanggal+`</span>
        </div></div></div>`);
    }else if(data.chat_penerima== '<?php echo $this->session->user_id; ?>')
    {
     $('.chatbox').append(`<div class="col-md-6 mt-3 isi_chatting_penerima mr-2">
      <div class="row">
      <img id="profil" class="rounded-circle " src="<?php echo base_url() ?>`+data.chat_photo+`" style="width:35px;position: absolute;top:-15px;left:-15px">
      <div class="col-md-12 text-justify">
      <span class="chat_text" style="color: white;font-size: 14px">`+data.chat_isi+`</span>
      <span style="position: absolute;bottom:-15px;right: 10px;font-size: 12px;color: white;font-weight: bold;">`+data.chat_tanggal+`</span>
      </div>
      </div>
      </div>`);
   }
 });  
  });  

  function writeChat(chat_pengirim,chat_penerima, chat_isi,chat_tanggal,chat_photo) {  
            // A post entry.  
            var chat_id = $('#chat_id').val();
            var postData = {  
              chat_pengirim : chat_pengirim,  
              chat_penerima: chat_penerima,
              chat_isi: chat_isi,  
              chat_tanggal: chat_tanggal,  
              chat_photo: chat_photo,  
            };  
            // Get a key for a new Post.  
            var newPostKey = firebase.database().ref().child('Chat/'+chat_id+'/').push().key;  
            var updates = {}; 
            updates['/Chat/'+chat_id+'/'+newPostKey] = postData;  
            return firebase.database().ref().update(updates);  
          }  

          $('#isi_pesan').keypress(function(e) {  
            var chat_pengirim = '<?php echo $this->session->user_id ?>';
            var chat_photo = '<?php echo $this->session->user_foto ?>';  
            var chat_isi = $('#isi_pesan').val(); 
            var chat_penerima = $('#chat_penerima').val(); 
            var chat_tanggal = '<?php echo date('Y-m-d H:i:s'); ?>';  
            if(e.which == 13) {  
              if(chat_isi == ''){  
                return false;  
              }  
              writeChat(chat_pengirim,chat_penerima, chat_isi,chat_tanggal,chat_photo);  
              $('#isi_pesan').val('');  
            }  
          });  
        </script>  


