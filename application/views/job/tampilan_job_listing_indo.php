 <div class="container">
   <style type="text/css">
     #tabel_lowongan td {
       border-top: #e3e6f000;
       padding: 0px;

     }

     #tabel_lowongan {
       border-collapse: separate;
       border-spacing: 2em;
     }

     #tabel_lowongan thead {
       border-top: #e3e6f000;
       display: none;
     }

     .dataTables_filter input[type="search"] {
       float: right !important;
       width: 100% !important;
       margin-top: 5px
     }

     #tabel_lowongan_length {
       margin-left: 35px;

     }

     .dataTables_filter {
       margin-left: 45px;

     }

     #tabel_lowongan_length select {
       margin-top: 5px;
     }
   </style>
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
                     <path fill-rule="evenodd" fill="#DD2727" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                   </svg>
                 </div>
                 <h4>Filter Pekerjaan</h4>
               </div>
             </div>
           </div>
           <!-- Job Category Listing start -->
           <div class="job-category-listing mb-50">
             <form action="javascript:;" id="form_filter">
               <!-- single one -->
               <div class="single-listing">
                 <div class="small-section-tittle2">
                   <h4>Sortir</h4>
                 </div>
                 <!-- Select job items start -->
                 <div class="select-job-items2">
                   <select name="sort_by" id="sort_by" class="form-control">
                     <option value="">Tidak ada</option>
                     <option value="DESC">Terbaru</option>
                     <option value="ASC">Terlama</option>
                   </select>
                 </div>
               </div>
               <div class="single-listing mt-4">
                 <div class="small-section-tittle2">
                   <h4>Kategori</h4>
                 </div>
                 <!-- Select job items start -->
                 <div class="select-job-items2">
                   <select name="kategori_id" id="kategori_id" class="form-control select2">
                     <option value="">Semua Kategori</option>
                     <?php foreach ($kategori as $key) { ?>
                       <option value="<?= $key->kategori_id; ?>"><?= $key->kategori_nama; ?></option>
                     <?php }; ?>
                   </select>
                 </div>
               </div>
               <!-- single two -->
               <div class="single-listing mt-4">
                 <div class="small-section-tittle2">
                   <h4>Lokasi</h4>
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
                     <h4>Gaji</h4>
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
               <button type="submit" id="btnSave" onclick="save_filter()" class="btn btn-danger btn-sm mt-4 w-100"><i class="fas fa-search mr-2"></i>Search</button>
             </form>
           </div>
           <!-- Job Category Listing End -->
         </div>
         <!-- Right content -->
         <div class="col-xl-9 col-lg-9 col-md-8">
           <!-- Featured_job_start -->
           <section class="featured-job-area">
             <div class="row p-0">
               <div class="col-lg-12">

                 <div class="table-responsive">
                   <table id="tabel_lowongan" class="table" style="width: 100%; height: 30%; overflow-y: scroll;overflow-x: scroll; font-size: 13px;">
                     <tbody id="show_data" class="p-0">

                     </tbody>
                   </table>
                 </div>
               </div>
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
     $('#kategori_id').select2();
     <?php if ($this->session->kategori_job != null) { ?>
       $('#kategori_id').select2().select2('val', '<?= $this->session->kategori_job; ?>');
     <?php }; ?>

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
         sLengthMenu: 'Tampilkan _MENU_',
         sZeroRecords: 'Tidak ditemukan data yang sesuai',
         sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
         sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
         sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
         sInfoPostFix: '',
         sSearch: 'Cari Lowongan',
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
     $('#btnSave').html('saving...'); //change button text
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

         $('#btnSave').html('<i class="fas fa-search mr-2"></i>Search'); //change button text
         $('#btnSave').attr('disabled', false); //set button enable 


       },
       error: function(jqXHR, textStatus, errorThrown) {
         alert('Error adding / update data');
         $('#btnSave').html('<i class="fas fa-search mr-2"></i>Search'); //change button text
         $('#btnSave').attr('disabled', false); //set button enable 

       }
     });
   }
 </script>