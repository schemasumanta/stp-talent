<style type="text/css">
    #tabel_job_posting td{
     border-top: #e3e6f000;
     padding: 0px;

 }
 #tabel_job_posting{
     border-collapse:separate; 
     border-spacing:2em;
 }

 #tabel_job_posting thead{
     border-top: #e3e6f000;
     display: none;
 }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div class="container-fluid p-5 flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
  <!-- Page Heading -->
  <div class="d-sm-flex mb-4">
    <h1 class="h3 mb-0 text-gray-800">Job Posting</h1>
  </div>
  <div class="row">
   <div class="col-xl-12 col-md-12 mb-4">
    <div class="table-responsive">

      <table id="tabel_job_posting"  class="table " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
        <tbody id="show_data">

        </tbody>
      </table>
    </div>


  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>



<script type="text/javascript">
 
  $(document).ready(function(){


      dataTable = $('#tabel_job_posting').DataTable( {
        paginationType:'full_numbers',
        processing: true,
        serverSide: true,
        searching: true,

        filter: false,
        autoWidth:false,
        aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ajax: {
            url: '<?php echo base_url('user/tabel_job_posting')?>',
            type: 'get',
            data: function (data) {
            }
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
          columns: [
          // {'data':'no'},
          {'data':'isi_lowongan',orderable:false},
          ],   
        //   columnDefs: [
        //   {
        //     targets: [0,2,-1],
        //     className: 'text-center'
        // },
        // ]

    });


      function table_data(){
       dataTable.ajax.reload(null,true);
   }


   $(".refresh").click(function(){
       location.reload();
   });


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
 
</script>

