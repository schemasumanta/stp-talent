 <div class="container">

   <div class="job-listing-area pt-120 pb-120">
     <div class="">
       <div class="row">
         <!-- Left content -->
         <div class="col-xl-3 col-lg-3 col-md-4">
           <div class="row">
             <div class="col-12">
               <div class="small-section-tittle2 mb-45">
                 <div class="ion">
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                     <path fill-rule="evenodd" fill="rgb(27, 207, 107)" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                   </svg>
                 </div>
                 <h4>Filter Jobs</h4>
               </div>
             </div>
           </div>
           <!-- Job Category Listing start -->
           <div class="job-category-listing mb-50">
             <form action="javascript:;" id="form_filter">
               <!-- single one -->
               <div class="single-listing">
                 <div class="small-section-tittle2">
                   <h4>Job Category</h4>
                 </div>
                 <!-- Select job items start -->
                 <div class="select-job-items2">
                   <select name="kategori_id" id="kategpri_id" class="form-control select2">
                     <option value="">All Category</option>
                     <?php foreach ($kategori as $key) { ?>
                       <option value="<?= $key->kategori_id; ?>"><?= $key->kategori_nama; ?></option>
                     <?php }; ?>
                   </select>
                 </div>
                 <!--  Select job items End-->
                 <!-- select-Categories start -->
                 <!-- <div class="select-Categories pt-80 pb-50">
                 <div class="small-section-tittle2">
                   <h4>Job Type</h4>
                 </div>
                 <label class="container">Full Time
                   <input type="checkbox" />
                   <span class="checkmark"></span>
                 </label>
                 <label class="container">Part Time
                   <input type="checkbox" checked="checked active" />
                   <span class="checkmark"></span>
                 </label>
                 <label class="container">Remote
                   <input type="checkbox" />
                   <span class="checkmark"></span>
                 </label>
                 <label class="container">Freelance
                   <input type="checkbox" />
                   <span class="checkmark"></span>
                 </label>
               </div> -->
                 <!-- select-Categories End -->
               </div>
               <!-- single two -->
               <div class="single-listing mt-4">
                 <div class="small-section-tittle2">
                   <h4>Job Location</h4>
                 </div>
                 <!-- Select job items start -->
                 <div class="select-job-items2">
                   <label>Provinsi</label>
                   <select name="id_prov" id="id_prov" class="form-control select2">
                     <option value="">Pilih Provinsi</option>
                     <?php foreach ($prov as $key) { ?>
                       <option value="<?= $key->prov_id; ?>"><?= $key->prov_nama; ?></option>
                     <?php }; ?>
                   </select>
                 </div>
                 <div class="select-job-items2">
                   <label>Kota</label>
                   <select name="id_kabkota" id="id_kabkota" class="form-control select2">
                   </select>
                 </div>
                 <!--  Select job items End-->
               </div>
               <div class="single-listing mt-4">
                 <!-- Range Slider Start -->
                 <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                   <div class="small-section-tittle2">
                     <h4>Job Salary</h4>
                   </div>
                   <div class="widgets_inner">
                     <div class="range_item">
                       <!-- <div id="slider-range"></div> -->
                       <input type="text" class="js-range-slider" value="" />
                       <div class="d-flex align-items-center">
                         <div class=" d-flex justify-content-center" style="width: 100%;">
                           <input type="text" class="js-input-from form-control" id="dari_gaji" name="dari_gaji" readonly />
                           <span>-</span>
                           <input type="text" class="js-input-to form-control" id="ke_gaji" name="ke_gaji" readonly />
                         </div>
                       </div>
                     </div>
                   </div>
                 </aside>
                 <!-- Range Slider End -->
               </div>
               <button type="submit" id="btnSave" onclick="save_filter()" class="btn btn-danger btn-sm mt-4">Search</button>
             </form>
           </div>
           <!-- Job Category Listing End -->
         </div>
         <!-- Right content -->
         <div class="col-xl-9 col-lg-9 col-md-8">
           <!-- Featured_job_start -->
           <section class="featured-job-area">
             <div class="container">
               <!-- Count of Job list Start -->
               <div class="row">
                 <div class="col-lg-12">
                   <div class="count-job mb-35">
                     <div id="hasil_pencarian"></div>
                     <!-- Select job items start -->
                     <div class="select-job-items">
                       <span>Sort by</span>
                       <select name="sort_by" id="sort_by" class="form-control" style="width: 100px;">
                         <option value="">None</option>
                         <option value="DESC">Terbaru</option>
                         <option value="ASC">Yang Dulu</option>
                       </select>
                     </div>
                     <!--  Select job items End-->
                   </div>
                 </div>
               </div>
               <!-- Count of Job list End -->
               <!-- single-job-content -->
               <div class="table-responsive">

                 <table id="tabel_lowongan" class="table " style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px; text-align: left;">
                   <tbody id="show_data">

                   </tbody>
                 </table>
               </div>


           </section>
           <!-- Featured_job_end -->
         </div>
       </div>
     </div>
   </div>

 </div>
 <script src="<?php echo base_url() ?>assets_admin/vendor/jquery/jquery.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
     hasil_pencarian();
     $('#kategpri_id').select2();

     $('#id_prov').select2().on('change', function(e) {
       var value = $(this).val();
       if (value !== "") {
         $.ajax({
           type: "POST",
           url: '<?php echo base_url(); ?>job/ambil_data_kota',
           cache: false,
           data: {
             modul: 'kota',
             id: value
           },
           success: function(respond) {
             $("#id_kabkota").html(respond);
           }
         })
       } else {
         $("#id_kabkota").empty();
       }
     });

     $('#sort_by').on('change', function(e) {
       var value = $(this).val();
       if (value !== "") {
         $.ajax({
           type: "POST",
           url: '<?php echo base_url(); ?>job/ambil_data_sortby',
           cache: false,
           data: {
             id: value
           },
           success: function(respond) {
             reload_table();
           }
         })
       }
     });

     $('#id_kabkota').select2({
       placeholder: 'Pilih Kabupaten',
       allowClear: true,
       tags: true,
     });


     dataTable = $('#tabel_lowongan').DataTable({
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
         url: '<?php echo base_url('job/tabel_lowongan') ?>',
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
       columns: [
         // {'data':'no'},
         {
           'data': 'isi_lowongan',
           orderable: false
         },
       ],
       //   columnDefs: [
       //   {
       //     targets: [0,2,-1],
       //     className: 'text-center'
       // },
       // ]

     });

   });

   function reload_table() {
     dataTable.ajax.reload(null, true);
   }


   $(".refresh").click(function() {
     location.reload();
   });

   function hasil_pencarian() {
     <?php if ($this->session->nama_lowongan) { ?>
       var nama_lowongan = '<?= $this->session->nama_lowongan; ?>';
       $('#hasil_pencarian').html("<span>Hasil pencarian <b>" + nama_lowongan + "</b></span>");
     <?php } else { ?>
       $('#hasil_pencarian').html("<span>&nbsp;</span>");
     <?php }; ?>
   }

   function save_filter() {
     $('#btnSave').text('saving...'); //change button text
     $('#btnSave').attr('disabled', true); //set button disable 
     var url;

     url = "<?php echo site_url('job/filter_lowongan') ?>";

     // ajax adding data to database
     $.ajax({
       url: url,
       type: "POST",
       data: $('#form_filter').serialize(),
       dataType: "JSON",
       success: function(data) {

         if (data.status) //if success close modal and reload ajax table
         {
           reload_table();
           $('#hasil_pencarian').html("<span>&nbsp;</span>");
         }

         $('#btnSave').text('Search'); //change button text
         $('#btnSave').attr('disabled', false); //set button enable 


       },
       error: function(jqXHR, textStatus, errorThrown) {
         alert('Error adding / update data');
         $('#btnSave').text('Search'); //change button text
         $('#btnSave').attr('disabled', false); //set button enable 

       }
     });
   }
 </script>