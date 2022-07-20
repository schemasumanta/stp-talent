<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <title>Aktivasi Akun</title>
  <style type="text/css">
    * {  
      font-family: 'Arial';
      font-size: 13px;
      /*color: black;*/
    }

    td,
    th,
    tr,
    table {
      border-top: 1px solid black;
      border-bottom: 1px solid black; 
      border-collapse: collapse;
    }  


    body {
      background: rgb(204,204,204); 
      width:100%; height:100%
    }


    page[size="A4"] {
      background: white;
      width: 12cm;
      display: block;
      margin: 0 auto;
      padding: 10px;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    @media print {
      body {
        margin: 0!important;
        box-shadow: 0!important;
        size: portrait!important;
        width:100%!important; height:100%!important
      }
      *{
        color:black!important;
      }

      page[size="A4"] {
        margin: 0;
        box-shadow:0 0 0cm rgba(0,0,0,0)!important;
        size: portrait;
        width:90%; height:100%
      }
    }
  </style>
</head>
<body>
 <page size="A4" class="py-5">
  <center>
    <h6>Terima Kasih Sudah Mendaftar Di Aplikasi Talent Hub</h6>
    <br>
    <h6>Email : <?php echo $email; ?></h6>
    <h6>Password : <?php echo $password; ?></h6>
    <a href="<?php echo base_url() ?>seeker/aktivasi/<?php echo $id_user ?>" style="background: red;color: white;border-radius: 10px;height: 50px;width: 150px;padding: 10px;text-decoration: none;" target="_blank">Aktivasi Akun</a>
    <br>
    <p>atau klik link berikut untuk aktivasi : <?php echo base_url() ?>seeker/aktivasi/<?php echo $id_user ?></p>
</center>
  <br>
  <center>
  <p>Terima Kasih</p>
  <p>Administrator</p>
</center>
</page>
</body>
</html>

<script type="text/javascript">

</script>