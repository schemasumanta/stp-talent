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
   width: 100%;
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
  width: auto;
  height: auto;

  max-width: 60%;
  padding: 5px 15px 0px 15px;
  border-bottom:2px solid #e3e6f0;
  background: #fff;
  border-bottom-right-radius: 1em;
  border-top-left-radius: 1em;
  margin-right: auto;

}

.isi_chatting_pengirim{
  width: auto;
  height: auto;
  max-width: 60%;
  word-break: break-all;
  padding: 5px 15px 0px 15px;
  border-bottom:2px solid #74B18A;
  background: #D5FFCD;
  border-bottom-left-radius: 1em;
  border-top-left-radius: 1em;
  box-shadow: rgba(116,177,138);
  margin-left: auto;

}
.list_contact{
  /*overflow-y: scroll;*/
  padding: 5px 0px 0px 0px;
  height: 100%;
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

    <!-- <php var_dump(md5(3)) ?> -->
     <div class="row p-3 style="background: transparent; max-height:90%">
      <div class="col-md-12 mb-4">
        <div class="card  mb-4 rounded" style="background: transparent; ">
          <div class="card-body py-3">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" id="chat_key" name="chat_key" value="">

                <div class="row">
                  <div class="col-md-4 rounded-left shadow" style="background: white">
                    <div class="row p-0" style="overflow-y: hidden;">
                      <div class="col-md-12 " style="position: relative;">
                        <div class="search mt-3">
                          <i class="fa fa-search"></i>
                          <input type="text" class="form-control" placeholder="Cari Pesan">
                        </div>
                      </div>
                      <hr>
                      <div class="contactbox col-md-12 mt-3 list_contact d-flex flex-column align-items-center justify-content-start ">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8 rounded-right reset_break chat-container"  style="background-image: url('<?php echo base_url() ?>assets/img/chatbackground.png');background-repeat: repeat;background-size: contain;">
                    <?php if (isset($penerima) > 0) { ?>
                      <?php foreach ($penerima as $key): ?>

                        <!-- d-flex flex-row align-items-center -->
                        <div class="header_chatting row d-flex flex-row">
                          <a class="d-flex btn-danger w-100 p-3 rounded-right" href="javascript:;" style="text-decoration:none">
                           <input type="hidden" id="chat_penerima" name="chat_penerima" value="<?php echo $key->user_id ?>">
                           <input type="hidden" id="chat_user_nama" name="chat_user_nama" value="<?php echo $key->user_nama ?>">
                           <input type="hidden" id="chat_user_photo" name="chat_user_photo" value="<?php echo $key->user_foto ?>">
                           <div class="">
                            <span class="col-md-1" style="cursor: pointer;"><i class="fa fa-ellipsis-v text-white fa-2x" aria-hidden="true"></i></span>

                            <img class="img-profile rounded-circle foto_chat" src="<?php echo $key->user_foto ?>" style="width: 60px;height: 60px">
                            <br>
                          </div>
                          <div class=" mx-3 text-left">
                            <span style="font-size: 15px" class="chat_user_nama"><?php if($key->perusahaan_nama!='') {
                             echo $key->perusahaan_nama; 
                           }else{
                             echo $key->user_nama;
                           } ?></span>
                           <br><span class="chat_user_status" style="font-size: 1rem;font-weight: bold;"><?php echo $key->user_login_status==1 ? "Online":"Offline"; ?>
                         </span></div></a>
                       </div>
                     <?php endforeach ?>
                     <div class="isi_chatting row mt-5">
                      <div class="col-md-12 ">
                        <div class="row p-0 chatbox d-flex flex-column" >
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

                  <?php }else{ ?>
                    <div class="header_chatting_polos row d-flex align-items-center flex-column justify-content-center">
                      <img src="<?php echo base_url() ?>assets/img/chatbubble.png" style="max-width: 20%">
                      <h2>Chatbox</h2>
                    </div>
                    <div class="header_chatting d-none">
                      <a class="d-flex btn-danger w-100 p-3 rounded-right" href="javascript:;" style="text-decoration:none">
                       <input type="hidden" id="chat_penerima" name="chat_penerima" value="">
                       <input type="hidden" id="chat_user_nama" name="chat_user_nama" value="">
                       <input type="hidden" id="chat_user_photo" name="chat_user_photo" value="">
                       <div class="">
                        <span class="col-md-1" style="cursor: pointer;"><i class="fa fa-ellipsis-v text-white fa-2x" aria-hidden="true"></i></span>

                        <img class="img-profile rounded-circle foto_chat" src="" style="width: 60px;height: 60px">
                        <br>
                      </div>
                      <div class=" mx-3 text-left">
                        <span style="font-size: 15px" class="chat_user_nama"></span>
                        <br><span class="chat_user_status" style="font-size: 1rem;font-weight: bold;">
                        </span></div></a>
                      </div>

                      <div class="isi_chatting row mt-5 d-none">
                        <div class="col-md-12 ">
                          <div class="row p-0 chatbox d-flex flex-column" >
                          </div>
                        </div>
                      </div>
                      <div class="form_chatting row mt-5 d-none">
                        <div class="col-md-10">
                          <input type="text" id="isi_pesan" name="isi_pesan" class="form-control" placeholder="Masukkan Pesan">
                        </div>
                        <div class="col-md-2  d-flex flex-row align-items-center justify-content-around">
                          <i class="fas fa-paperclip text-danger" style="cursor: pointer;"></i>
                          <i class="fas fa-smile  text-warning"   style="cursor: pointer;"></i>
                          <i class="fas fa-paper-plane  text-success"  style="cursor: pointer;"></i>
                        </div>
                      </div>
                    <?php }?>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>

  <script type="text/javascript">
    var chat_id;
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

  // let files = [];
  // document.getElementById("file-cv").addEventListener("change", function(e) {
  //   files = e.target.files;
  // });

  // document.getElementById("lampiran_pas_photo").addEventListener("change", function(e) {
  //   files = e.target.files;
  //   previewFile('lampiran_pas_photo');

  // });




  



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
    let charCode = (evt.which) ? evt.which : event.keyCode
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
        let storage = firebase.storage().ref('talent_hub/cv/'+files[i].name);
        let upload = storage.put(files[i]);
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
let chat_aktif =$('#chat_penerima').val();
let list_contact = firebase.database().ref('/Conversation/'+<?php echo $this->session->user_id; ?>+'/').orderByChild('user_id');
list_contact.on('value', function(snapshot) { 
  $('.list_contact').html('');
  let chat_aktif =$('#chat_penerima').val();
  snapshot.forEach((data_list_contact) => {

    let data = data_list_contact.val();
    if (data.user_id==chat_aktif) {
      $('#chat_key').val(data.chat_key);
      let contact =`<a class="d-flex btn-danger w-100 p-3 rounded-right shadow-sm contact_chat" href="javascript:;" style="text-decoration:none" data-key="`+data.chat_key+`" data-user_foto="`+data.user_foto+`" data-user_nama="`+data.user_nama+`" data-user_id="`+data.user_id+`">
      <div class="">
      <img class="img-profile rounded-circle" src="`+data.user_foto+`" style="width: 25px">
      <br>
      </div>
      <div class=" mx-3 text-left">
      <span style="font-size: 15px">`+data.user_nama+`</span>
      <br><span id="`+data.chat_key+`" style="font-size: 0.8rem;font-weight: normal;"></span></div></a>`;
      $('.list_contact').append(contact);
    }else{
      let contact =`<a class="d-flex btn-light w-100 p-3 rounded-right shadow-sm contact_chat" href="javascript:;" style="text-decoration:none;"  data-key="`+data.chat_key+`" data-user_foto="`+data.user_foto+`" data-user_nama="`+data.user_nama+`" data-user_id="`+data.user_id+`">
      <div class="">
      <img class="img-profile rounded-circle" src="`+data.user_foto+`" style="width: 25px">
      <br>
      </div>
      <div class=" mx-3 text-left">
      <span style="font-size: 15px">`+data.user_nama+`</span>
      <br><span id="`+data.chat_key+`" style="font-size: 0.8rem;font-weight: normal;"></span></div></a>`;
      $('.list_contact').append(contact);
    }

    let getlastchatref = firebase.database().ref('Chat/').orderByChild('chat_key').equalTo(data_list_contact.val().chat_key).limitToLast(1);
    let data_chat = getlastchatref.on('value',function(lastchat){
      lastchat.forEach((data_last_chat) => {
        let data_chat = data_last_chat.val();
        $('#'+data_chat.chat_key).html(data_chat.chat_isi);
      });
    });

    let chathistoryref = firebase.database().ref('Chat/').orderByChild('chat_key').equalTo(data_list_contact.val().chat_key).limitToLast(50); 
    chathistoryref.once('value', function(chatting) { 

      if (chatting.numChildren() > 0) {
        console.log(chatting.numChildren());
        chatting.forEach((isi) => {
          let data_chat = isi.val();
          if(data_chat.chat_key==$('#chat_key').val()){
            if(data_chat.chat_pengirim == '<?php echo $this->session->user_id; ?>')
            {
              $('.chatbox').append(`
                <div class="mb-1 chat_message isi_chatting_pengirim" id="`+isi['ref']['path']['pieces_'][2]+`">
                <p class="chat_text" style="color: black;font-size: 1em;">`+data_chat.chat_isi+`</p>
                <p style="font-size: 0.5em;color: black;font-weight: bold;position:relative;bottom:-10px;right:0px;">`+data_chat.chat_tanggal+`</p></div>
                `);
            }

            if(data_chat.chat_penerima== '<?php echo $this->session->user_id; ?>')
            {
             $('.chatbox').append(`<div class=" mb-1 chat_message isi_chatting_penerima" id="`+isi['ref']['path']['pieces_'][2]+`">
              <p class="chat_text" style="color: black;font-size: 1em;">`+data_chat.chat_isi+`</p>
              <p style="font-size: 0.5em;color: black;font-weight: bold;position:relative;bottom:-10px;right:0px;">`+data_chat.chat_tanggal+`</p>
              </div>`);
           }
           $('.isi_chatting').scrollTop($('.isi_chatting')[0].scrollHeight);
         }
       });
      }

    }); 

  });
});

    let chatref = firebase.database().ref('Chat/'); 
    chatref.endAt().limitToLast(1).on('child_added', function(snapshot) {
      let data_chat = snapshot.val();
      if(data_chat.chat_key==$('#chat_key').val()){
        if(data_chat.chat_pengirim == '<?php echo $this->session->user_id; ?>')
        {
          $('.chatbox').append(`
            <div class="mb-1 chat_message isi_chatting_pengirim" id="`+snapshot['ref_']['path']['pieces_'][2]+`">
            <p class="chat_text" style="color: black;font-size: 1em;">`+data_chat.chat_isi+`</p>
            <p style="font-size: 0.5em;color: black;font-weight: bold;position:relative;bottom:-10px;right:0px;">`+data_chat.chat_tanggal+`</p></div>
            `);

          $('#'+data_chat.chat_key).html(data_chat.chat_isi);
        }
        else if(data_chat.chat_penerima== '<?php echo $this->session->user_id; ?>')
        {
         $('.chatbox').append(`<div class=" mb-1 chat_message  isi_chatting_penerima" id="`+snapshot['ref_']['path']['pieces_'][2]+`">
          <p class="chat_text" style="color: black;font-size: 1em;">`+data_chat.chat_isi+`</p>
          <p style="font-size: 0.5em;color: black;font-weight: bold;position:relative;bottom:-10px;right:0px;">`+data_chat.chat_tanggal+`</p>
          </div>`);
         $('#'+data_chat.chat_key).html(data_chat.chat_isi);

       }
     }
     $('.isi_chatting').scrollTop($('.isi_chatting')[0].scrollHeight);


   }); 

  });  


  $('#isi_pesan').keypress(function(e) {  
    let chat_pengirim = '<?php echo $this->session->user_id ?>';
    let chat_photo = '<?php echo $this->session->user_foto ?>';
    let chat_pengirim_nama = '<?php echo $this->session->user_nama ?>';  

    let chat_isi = $('#isi_pesan').val(); 
    let chat_penerima = $('#chat_penerima').val(); 
    let chat_user_photo = $('#chat_user_photo').val(); 
    let chat_user_nama= $('.chat_user_nama').html(); 
    let chat_tanggal = '<?php echo date('Y-m-d H:i:s'); ?>';  
    let chat_order = $.now();
    if(e.which == 13) {  
      if(chat_isi == ''){  
        return false;  
      }
      let cekcontactref = firebase.database().ref('/Conversation/'+chat_pengirim+'/').orderByChild('user_id').equalTo(chat_penerima);
      cekcontactref.once('value',function(cek){
        if(cek.numChildren()> 0){
         cek.forEach((newchat) => {
          let data = newchat.val();
          let key = data.chat_key;
          let dataChat = {  
            chat_pengirim : chat_pengirim,  
            chat_penerima: chat_penerima,
            chat_isi: chat_isi,  
            chat_tanggal: chat_tanggal,  
            chat_order: chat_order,
            chat_key : data.chat_key, 
          };  

          let newchatkey = firebase.database().ref('Chat').push().key;  
          let updateschat = {}; 
          updateschat['/Chat/'+newchatkey] = dataChat;  
          firebase.database().ref().update(updateschat,(error)=>{
            if (error) {
              console.log('Error encountered');
            }else{
             $('#isi_pesan').val('');  
             // $.cookie('chat_key',data.chat_key);

           }
         });

        });
       }else{
        let key = randomkey();
        let postContactPengirim = {  
          user_id : chat_penerima,  
          user_nama: chat_user_nama,
          user_foto: chat_user_photo,  
          chat_key: key,  
        };  

        let newPostKey = firebase.database().ref().child('Conversation/'+chat_pengirim+'/').push().key;  
        let updates = {}; 
        updates['/Conversation/'+chat_pengirim+'/'+newPostKey] = postContactPengirim;  
        firebase.database().ref().update(updates,(error)=>{
          if (error) {

          }else{

            let postContactPenerima = {  
              user_id : chat_pengirim,  
              user_nama: chat_pengirim_nama,
              user_foto: chat_photo,
              chat_key: key,  
            };  
            let newPostKeyPenerima = firebase.database().ref().child('Conversation/'+chat_penerima+'/').push().key;
            let updatespenerima = {}; 
            updatespenerima['/Conversation/'+chat_penerima+'/'+newPostKeyPenerima] = postContactPenerima;  
            firebase.database().ref().update(updatespenerima,(error)=>{
              if (error) {

              }else{

                let dataChat = {  
                  chat_pengirim : chat_pengirim,  
                  chat_penerima: chat_penerima,
                  chat_isi: chat_isi,  
                  chat_tanggal: chat_tanggal,  
                  chat_order: chat_order,
                  chat_key: key,  
                };  

                let newchatkey = firebase.database().ref().child('Chat').push().key;  
                let updateschat = {}; 
                updateschat['/Chat/'+newchatkey] = dataChat;  
                firebase.database().ref().update(updateschat,(error)=>{
                  if (error) {
                    console.log('Error encountered');
                  }else{
                   $('#isi_pesan').val('');  
                   // $.cookie('chat_key',key);
                   
                 }
               });
              }
            });

          }
        }); 



      }
    });

      // writeChat(chat_pengirim,chat_penerima, chat_isi,chat_tanggal,chat_photo,chat_order);  
    }  
  });  

  $(document).on('click','.contact_chat',function(){
   $('.contact_chat').removeClass('btn-danger');
   $('.contact_chat').addClass('btn-light');
   $('.header_chatting_polos').remove();
   $('.header_chatting').removeClass('d-none');
   $('.form_chatting').removeClass('d-none');
   $('.isi_chatting').removeClass('d-none');
   $(this).removeClass('btn-light');
   $(this).addClass('btn-danger');
   let chat_penerima = $('#chat_penerima').val();
   let chat_key = $(this).data('key');
   let chat_nama = $(this).data('user_nama');
   let chat_foto = $(this).data('user_foto');
   let chat_user_id = $(this).data('user_id');
   if (chat_penerima==chat_user_id) {
    return false;
  }

  $.ajax({
    type : "GET",
    url  : "<?php echo base_url('chat/cek_status')?>",
    dataType : "JSON",
    data : {'user_id':chat_user_id},
    success: function(data){
      $('.chat_user_nama').html(chat_nama);
      $('.foto_chat').attr('src',chat_foto);
      if (data[0].user_login_status==1) {
        $('.chat_user_status').html('Online');
      }else{
        $('.chat_user_status').html('Offline');
      }

      $('#chat_penerima').val(chat_user_id);
      $('#chat_user_nama').val(chat_nama);
      $('#chat_user_photo').val(chat_foto);
      $('#chat_key').val(chat_key);
      $('.chatbox').html('');

      let chathistoryref = firebase.database().ref('Chat/').orderByChild('chat_key').equalTo(chat_key).limitToLast(50); 
      chathistoryref.once('value', function(chatting) { 
        if (chatting.numChildren() > 0) {
          chatting.forEach((isi) => {
            let data_chat = isi.val();
            if(data_chat.chat_key==$('#chat_key').val()){
              if(data_chat.chat_pengirim == '<?php echo $this->session->user_id; ?>')
              {
                $('.chatbox').append(`
                  <div class="mb-1 chat_message isi_chatting_pengirim" id="`+isi['ref']['path']['pieces_'][2]+`">
                  <p class="chat_text" style="color: black;font-size: 1em;">`+data_chat.chat_isi+`</p>
                  <p style="font-size: 0.5em;color: black;font-weight: bold;position:relative;bottom:-10px;right:0px;">`+data_chat.chat_tanggal+`</p></div>
                  `);
              }
              if(data_chat.chat_penerima== '<?php echo $this->session->user_id; ?>')
              {
               $('.chatbox').append(`<div class=" mb-1 chat_message isi_chatting_penerima" id="`+isi['ref']['path']['pieces_'][2]+`">
                <p class="chat_text" style="color: black;font-size: 1em;">`+data_chat.chat_isi+`</p>
                <p style="font-size: 0.5em;color: black;font-weight: bold;position:relative;bottom:-10px;right:0px;">`+data_chat.chat_tanggal+`</p>
                </div>`);
             }
             $('.isi_chatting').scrollTop($('.isi_chatting')[0].scrollHeight);
           }
         });
        }

      }); 
    }

  });   
});
  // function mulai_chat(id)
  // {
  //   let chat_baru = $('.chat_nama_'+id).data('penerima');
  //   let chat_baru_status = $('.chat_nama_'+id).data('status');
  //   let nama = $('.chat_nama_'+id).html();
  //   let chat_baru_foto = $('.chat_foto_'+id).attr('src');
  //   let status = 'Offline'
  //   if(chat_baru_status==1)
  //   {
  //     status ="Online";
  //   }
  //   $('.header_chatting').removeClass('d-none');
  //   $('#chat_id').val(id);
  //   $('#chat_penerima').val(chat_baru);

  //   $('.chat_penerima').html(nama+`<br><span class="chat_penerima_status">`+status+`</span>`);
  //   $('.chat_penerima_foto').attr('src',chat_baru_foto);
  //   $('.chatbox').html('');
  //   chatref = firebase.database().ref('/Chat/'+id+'/').orderByChild('chat_order'); 
  //   let neWchatRef = firebase.database().ref('/Chat/'+ id+'/').orderByChild('chat_order');

  //   neWchatRef.once('value',function(chatting){
  //     if(chatting.numChildren()> 0){
  //      chatting.forEach((newchat) => {
  //       let data = newchat.val();
  //       if(data.chat_pengirim == '<?php echo $this->session->user_id; ?>')
  //       {
  //         $('.chatbox').append(`<div class="col-md-6 mt-3"></div>  
  //           <div class="col-md-6 mt-3 isi_chatting_pengirim float-right"><div class="row"><img id="profil" class="rounded-circle " src="<?php echo base_url() ?>`+data.chat_photo+`" style="width:35px;position: absolute;top:-15px;right:-15px">
  //           <div class="col-md-12 text-justify">
  //           <span class="chat_text" style="color: black;font-size: 1em;">`+data.chat_isi+`</span>
  //           <span style="position: absolute;bottom:-15px;right: 10px;font-size: 0.5em;color: black;font-weight: bold;">`+data.chat_tanggal+`</span>
  //           </div></div></div>`);
  //       }else if(data.chat_penerima== '<?php echo $this->session->user_id; ?>')
  //       {
  //        $('.chatbox').append(`<div class="col-md-6 mt-3 isi_chatting_penerima mr-2">
  //         <div class="row">
  //         <img id="profil" class="rounded-circle " src="<?php echo base_url() ?>`+data.chat_photo+`" style="width:35px;position: absolute;top:-15px;left:-15px">
  //         <div class="col-md-12 text-justify">
  //         <span class="chat_text" style="color: white;font-size: 1em;">`+data.chat_isi+`</span>
  //         <span style="position: absolute;bottom:-15px;right: 10px;font-size: 0.5em;color: white;font-weight: bold;">`+data.chat_tanggal+`</span>
  //         </div>
  //         </div>
  //         </div>`);
  //      }
  //    });

  //    }

  //  });
  // }

</script>  


