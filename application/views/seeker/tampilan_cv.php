<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->

<style type="text/css">
  #lampiran_pas_photo {
    opacity: 0 !important;
    padding: 0 !important;
    width: 100% !important;

  }

  .imagecheck-figure>img {
    width: 100% !important;
  }

  .timeline {
    border-left: 3px solid #dd2727;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    background: transparent;
    margin: 0 auto;
    letter-spacing: 0.2px;
    position: relative;
    line-height: 1.4em;
    font-size: 1.03em;
    padding: 50px;
    list-style: none;
    text-align: left;
    max-width: 60%;
  }

  @media (max-width: 2000px) {
    .timeline {
      max-width: 98%;
      padding: 25px;
    }
  }

  .timeline h1 {
    font-size: 1.4em;
    font-weight: bold;
  }

  .timeline h2,
  .timeline h3 {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 10px;
  }



  .timeline .event {
    border-bottom: 1px dashed #e8ebf1;
    padding-bottom: 25px;
    margin-bottom: 25px;
    position: relative;
  }

  @media (max-width: 2000px) {
    .timeline .event {
      padding-top: 30px;
    }
  }

  .timeline .event:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border: none;
  }

  .timeline .event:before,
  .timeline .event:after {
    position: absolute;
    display: block;
    top: 0;
  }

  .timeline .event:before {
    left: -270px;
    content: attr(data-date);
    text-align: right;
    font-weight: 100;
    font-size: 0.9em;
    min-width: 120px;
  }

  @media (max-width: 2000px) {
    .timeline .event:before {
      left: 0px;
      text-align: left;
    }
  }

  .timeline .event:after {
    -webkit-box-shadow: 0 0 0 3px #dd2727;
    box-shadow: 0 0 0 3px #dd2727;
    left: -55.8px;
    background: #fff;
    border-radius: 50%;
    height: 9px;
    width: 9px;
    content: "";
    top: 5px;
  }

  @media (max-width: 2000px) {
    .timeline .event:after {
      left: -31.8px;
    }
  }

  .rtl .timeline {
    border-left: 0;
    text-align: right;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-right: 3px solid #dd2727;
  }

  .rtl .timeline .event::before {
    left: 0;
    right: -170px;
  }

  .rtl .timeline .event::after {
    left: 0;
    right: -55.8px;
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



<div class="container-fluid  flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
  <h1 class="h3 mb-4 text-gray-800">Curriculum Vitae</h1>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-12 col-md-12 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <div class="row">
            <div class="col-md-12">
              <h6 class="font-weight-bold text-primary">Data Resume</h6>

            </div>

          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-md-12">
              <div class="row p-3">
                <div class="col-xl-8 col-md-8 mb-4 p-3">
                  <div class="row">

                    <div class="col-md-12 col-md-12">
                      <span style="font-weight: bold;font-size: 18px">Biodata</span>
                      <hr>
                      <?php if (count($resume) > 0) : ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_edit_resume" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($resume) > 0) : ?>
                      <?php foreach ($resume as $pp) : ?>
                        <div class="col-md-3 text-center mb-3">
                          <img class="" src="<?php echo $pp->resume_foto ?>" style="width: 60%;border-radius: 10px">
                        </div>
                        <div class="col-md-9 col-xl-9 mb-3">
                          <div class="row mb-3">
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6">NIK</span>
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6" style="font-weight: bold;">: <?php echo $pp->resume_nik; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6">Nama Lengkap</span>
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6" style="font-weight: bold;">: <?php echo $pp->resume_nama_lengkap; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6">Tempat Tanggal Lahir</span>
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6" style="font-weight: bold;">: <?php
                                                                                                        $tgl_lahir = explode('-', $pp->resume_tanggal_lahir);
                                                                                                        echo $pp->resume_tempat_lahir . ", " . $tgl_lahir[2] . " " . $bulan[$tgl_lahir[1]] . " " . $tgl_lahir[0]; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6">Jenis Kelamin</span>
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6" style="font-weight: bold;">: <?php echo $pp->resume_jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan"; ?></span>
                          </div>
                          <div class="row mb-3">
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6">Agama</span>
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6" style="font-weight: bold;">: <?php echo $pp->agama_nama; ?></span>
                          </div>

                          <div class="row mb-3">
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6">Pendidikan</span>
                            <span class="col-md-6 col-sm-6 col-xs-6 col-6" style="font-weight: bold;">: <?php echo $pp->pendidikan_nama; ?></span>
                          </div>
                        </div>
                      <?php endforeach ?>

                    <?php else : ?>
                      <div class="col-md-12 col-md-12 text-center">
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="border-radius: 0px" data-toggle="modal" data-target="#ModalProfil"><i class="fas fa-plus mr-2"></i>Tambah Profil</a>
                      </div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="col-md-4 col-xl-4 p-3" style="border: 1px solid #d8d8d8;border-radius: 15px;max-height: 200px">
                  <div class="row">
                    <div class="col-md-12 col-md-12 text-center">
                      <span style="font-weight: bold;font-size: 18px;">CV</span>
                      <hr>
                      <?php if (count($upload_resume) > 0) : ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="position: absolute;right: 5px;top:5px;border-radius: 0px" data-target="#ModalUploadResume" data-toggle="modal"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($upload_resume) > 0) : ?>
                      <?php foreach ($upload_resume as $up) : ?>
                        <div class="col-md-12 col-md-12 mt-3 justify-content-center btn-group">
                          <a href="<?php echo $up->resume_lampiran ?>" target="_blank" class="btn btn-danger  item_lihat_resume">Lihat CV Terupload</a>
                          <a href="<?php echo base_url() ?>cv/generate_cv/<?php echo $up->user_id ?>" target="_blank" class="btn btn-success">Export To PDF</a>
                        </div>
                      <?php endforeach ?>

                    <?php else : ?>
                      <div class="col-md-12 col-md-12 text-center justify-content-center">
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent" style="border-radius: 0px" data-toggle="modal" data-target="#ModalUploadResume"><i class="fas fa-plus mr-2"></i>Upload CV</a>
                      </div>
                    <?php endif ?>
                  </div>
                </div>

                <div class="col-md-6 col-md-6 mb-4 p-3 mt-2">
                  <div class="row">

                    <div class="col-md-12 col-md-12">
                      <span style="font-weight: bold;font-size: 18px">Pengalaman Kerja</span>
                      <hr>
                      <?php if (count($pengalaman) > 0) : ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_tambah_pengalaman" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-plus mr-2"></i>Tambah Pengalaman</a>

                      <?php endif ?>
                    </div>
                    <div class="col-md-12">

                      <?php if (count($pengalaman) > 0) : ?>
                        <ul class="timeline">

                          <?php $i = 0;
                          foreach ($pengalaman as $pl) : ?>
                            <?php $tgl = explode('-', $pl->pengalaman_tanggal_awal);
                            $tgl_akhir = explode('-', $pl->pengalaman_tanggal_akhir) ?>

                            <li class="event item_list_pengalaman" data-list="<?php echo $i ?>" data-date="<?php
                                                                                                            if ($pl->masih_bekerja > 0) {
                                                                                                              echo $tgl[2] . " " . $bulan[$tgl[1]] . " " . $tgl[0] . "- Sekarang";
                                                                                                            } else {
                                                                                                              echo  $tgl[2] . " " . $bulan[$tgl[1]] . " " . $tgl[0] . " - " . $tgl_akhir[2] . " " . $bulan[$tgl_akhir[1]] . " " . $tgl_akhir[0];
                                                                                                            }
                                                                                                            ?>">
                              <h1><?php echo $pl->jabatan_nama; ?></h1>
                              <h3 style="font-weight: bold;"><?php echo $pl->perusahaan_nama; ?></h3>
                              <p><?php echo $pl->pengalaman_deskripsi; ?></p>
                              <a href="javascript:;" class="btn btn-sm d-none mb-2 btn-outline-danger item_hapus_pengalaman item_hapus_pengalaman_<?php echo $i ?>" data="<?php echo $pl->pengalaman_id ?>"><i class="fas fa-trash"></i></a>
                              <a href="javascript:;" class="btn btn-sm d-none mb-2 btn-outline-success item_edit_pengalaman item_edit_pengalaman_<?php echo $i ?>" data="<?php echo $pl->pengalaman_id ?>"><i class="fas fa-edit"></i></a>
                            </li>
                          <?php $i++;
                          endforeach ?>

                        </ul>

                    </div>

                  <?php else : ?>
                    <div class="col-md-12 col-md-12 text-center">
                      <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_tambah_pengalaman" style="border-radius: 0px"><i class="fas fa-plus mr-2"></i>Tambah Pengalaman</a>
                    </div>
                  <?php endif ?>
                  </div>
                </div>

                <div class="col-md-6 col-md-6 mb-4 p-3">
                  <div class="row">

                    <div class="col-md-12 col-md-12">
                      <span style="font-weight: bold;font-size: 18px">Tentang Saya</span>
                      <hr>
                      <?php if (count($about) > 0 && $about[0]->resume_about != '') : ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_edit_about" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($about) > 0  && $about[0]->resume_about != '') : ?>
                      <div class="col-md-12 col-md-12  d-flex flex-row justify-content-start">
                        <?php foreach ($about as $ab) : ?>
                          <span><?php echo $ab->resume_about; ?></span>

                        <?php endforeach ?>
                      </div>
                    <?php else : ?>
                      <div class="col-md-12 col-md-12 text-center">
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_tambah_about" style="border-radius: 0px"><i class="fas fa-plus mr-2"></i>Tambah Deskripsi Tentang Saya</a>
                      </div>
                    <?php endif ?>
                  </div>
                  <div class="row mt-5">

                    <div class="col-md-12 col-md-12">
                      <span style="font-weight: bold;font-size: 18px">Skill / Keahlian</span>
                      <hr>
                      <?php if (count($skill_resume) > 0) : ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_edit_skill_resume" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($skill_resume) > 0) : ?>
                      <div class="col-md-12 col-md-12  d-flex flex-row justify-content-start">
                        <?php foreach ($skill_resume as $sr) : ?>
                          <?php if ($sr->skill_level_nama == "Beginner") { ?>
                            <a href="javascript:;" class="btn btn-sm rounded btn-outline-danger mr-2" data-toggle="tooltip" data-placement="top" title="<?php echo $sr->skill_level_nama ?>"><span><?php echo $sr->skill_nama; ?></span></a>
                          <?php } else if ($sr->skill_level_nama == "Intermediate") { ?>
                            <a href="javascript:;" class="btn btn-sm rounded btn-outline-primary mr-2" data-toggle="tooltip" data-placement="top" title="<?php echo $sr->skill_level_nama ?>"><span><?php echo $sr->skill_nama; ?></span></a>
                          <?php } else if ($sr->skill_level_nama == "Advance") { ?>
                            <a href="javascript:;" class="btn btn-sm rounded btn-outline-success mr-2" data-toggle="tooltip" data-placement="top" title="<?php echo $sr->skill_level_nama ?>"><span><?php echo $sr->skill_nama; ?></span></a>
                          <?php } else { ?>
                            <a href="javascript:;" class="btn btn-sm rounded btn-outline-warning mr-2" data-toggle="tooltip" data-placement="top" title="<?php echo $sr->skill_level_nama ?>"><span><?php echo $sr->skill_nama; ?></span></a>
                          <?php } ?>
                        <?php endforeach ?>
                      </div>
                    <?php else : ?>
                      <div class="col-md-12 col-md-12 text-center">
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_tambah_skill" style="border-radius: 0px"><i class="fas fa-plus mr-2"></i>Tambah Skill</a>
                      </div>
                    <?php endif ?>
                  </div>
                  <div class="row mt-5">

                    <div class="col-md-12 col-md-12">
                      <span style="font-weight: bold;font-size: 18px">Bahasa yang Dikuasai</span>
                      <hr>
                      <?php if (count($bahasa_resume) > 0) : ?>
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_edit_bahasa_resume" style="position: absolute;right: 5px;top:5px;border-radius: 0px"><i class="fas fa-edit mr-2"></i>Edit</a>
                      <?php endif ?>
                    </div>
                    <?php if (count($bahasa_resume) > 0) : ?>
                      <div class="col-md-12 col-md-12  d-flex flex-row justify-content-start">
                        <?php foreach ($bahasa_resume as $br) : ?>
                          <?php if ($br->resume_bahasa_level == 0) { ?>
                            <a href="javascript:;" class="btn btn-sm rounded btn-outline-danger mr-2" data-toggle="tooltip" data-placement="top" title="Pasif"><span><?php echo $br->bahasa_nama; ?></span></a>
                          <?php } else { ?>
                            <a href="javascript:;" class="btn btn-sm rounded btn-outline-success mr-2" data-toggle="tooltip" data-placement="top" title="Aktif"><span><?php echo $br->bahasa_nama; ?></span></a>
                        <?php }
                        endforeach ?>
                      </div>
                    <?php else : ?>
                      <div class="col-md-12 col-md-12 text-center">
                        <a href="javascript:;" class="text-danger genric-btn small btn-transparent item_tambah_bahasa" style="border-radius: 0px"><i class="fas fa-plus mr-2"></i>Tambah Bahasa</a>
                      </div>
                    <?php endif ?>
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

<div class="modal fade" data-backdrop="static" id="ModalProfil" tabindex="-1" role="dialog" aria-labelledby="ModalProfilLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_profil" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_resume') ?>">

        <div class="modal-header bg-danger">
          <h3 class="modal-title" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i> TAMBAH PROFIL</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12 mb-3  mt-3" style="border-bottom: 1px solid #ced4da">
              <h6 style="font-weight: bold;">Biodata</h6>
            </div>
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="resume_nik">NIK</label>
              <input type="hidden" name="resume_id" id="resume_id">
              <input type="text" class="form-control" id="resume_nik" name="resume_nik" required onkeypress="return hanyaAngka(event)" maxlength="16">
              <small class="error-resume_nik text-danger"></small>

            </div>

            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="resume_nama_lengkap">Nama Lengkap</label>
              <input type="text" class="form-control" id="resume_nama_lengkap" name="resume_nama_lengkap" required>
              <small class="error-resume_nama_lengkap text-danger"></small>
            </div>

            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="resume_tempat_lahir">Tempat Tanggal Lahir</label>
              <div class=" input-group">

                <input type="text" class="form-control" id="resume_tempat_lahir" name="resume_tempat_lahir" required>
                <input type="date" class="form-control" id="resume_tanggal_lahir" name="resume_tanggal_lahir" required>
              </div>
              <small class="error-resume_tempat_lahir text-danger"></small>

            </div>


            <div class="col-md-3 mb-3 ">
              <label style="color:#343a40;" for="resume_jenis_kelamin">Jenis Kelamin</label>
              <br>
              <select class="form-control w-100" id="resume_jenis_kelamin" name="resume_jenis_kelamin" required>
                <option value="0" disabled selected>Pilih Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
              </select>
              <small class="error-resume_jenis_kelamin text-danger"></small>

            </div>


            <div class="col-md-3 mb-3 ">
              <label style="color:#343a40;" for="resume_agama">Agama</label>
              <br>
              <select class="form-control w-100" id="resume_agama" name="resume_agama" style="width: 100%">
                <option value="0" disabled selected>Pilih Agama</option>
                <?php foreach ($agama as $ag) : ?>
                  <option value="<?php echo $ag->agama_id ?>"><?php echo $ag->agama_nama ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-resume_agama text-danger"></small>

            </div>

            <div class="col-md-12 mb-3 mt-3" style="border-bottom: 1px solid #ced4da">
              <h6 style="font-weight: bold;">Pendidikan</h6>
            </div>

            <div class="col-md-4 mb-3">
              <label style="color:#343a40;" for="pendidikan_id">Pendidikan Terakhir</label>
              <br>
              <select class="form-control" id="pendidikan_id" name="pendidikan_id" required style="width: 100%">
                <option value="0" disabled selected>Pilih Pendidikan</option>
                <?php foreach ($pendidikan as $pd) : ?>
                  <option value="<?php echo $pd->pendidikan_id ?>"><?php echo $pd->pendidikan_nama ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-pendidikan_id text-danger"></small>

            </div>
            <div class="col-md-5 mb-3">
              <label style="color:#343a40;" for="resume_nama_pendidikan_terakhir">Institusi</label>
              <input type="text" class="form-control" id="resume_nama_pendidikan_terakhir" name="resume_nama_pendidikan_terakhir" required>
              <small class="error-resume_nama_pendidikan_terakhir text-danger"></small>
            </div>
            <div class="col-md-3 mb-3">
              <label style="color:#343a40;" for="resume_pendidikan_tahun_lulus">Tahun Lulus</label>
              <input type="text" class="form-control" id="resume_pendidikan_tahun_lulus" name="resume_pendidikan_tahun_lulus" required maxlength="4" onkeypress="return hanyaAngka(event)">
              <small class="error-resume_pendidikan_tahun_lulus text-danger"></small>
            </div>
            <div class="col-md-12 mb-3 mt-3" style="border-bottom: 1px solid #ced4da">
              <h6 style="font-weight: bold;">Alamat</h6>
            </div>
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="resume_prov">Provinsi</label>
              <br>
              <select class="form-control w-100" id="resume_prov" name="resume_prov" style="width: 100%">
                <option value="0" disabled selected>Pilih Provinsi</option>
                <?php foreach ($provinsi as $prov) : ?>
                  <option value="<?php echo $prov->prov_id ?>"><?php echo $prov->prov_nama ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-resume_prov text-danger"></small>

            </div>

            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="resume_kabkota">Kota/Kab</label>
              <br>
              <select class="form-control" id="resume_kabkota" name="resume_kabkota" style="width: 100%">
                <option value="0" disabled selected>Pilih Kabkota</option>
              </select>
              <small class="error-resume_kabkota text-danger"></small>

            </div>

            <div class="col-md-6">
              <label style="color:#343a40;" for="resume_alamat">Alamat Lengkap</label>
              <textarea type="text" class="form-control" id="resume_alamat" name="resume_alamat" required rows="5"></textarea>
              <small class="error-resume_alamat text-danger"></small>
            </div>

            <div class="col-md-3 mb-3">
              <label class="imagecheck">Pas Photo
                <input type="hidden" name="lampiran_pas_photo_lama" id="lampiran_pas_photo_lama">
                <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_pas_photo" id="lampiran_pas_photo">
                <figure class="imagecheck-figure">
                  <img src="<?php echo base_url('assets/img/img03.jpg'); ?>" class="imagecheck-image" id="preview_lampiran_pas_photo">
                </figure>
              </label>
              <small class="error-file-photo text-danger"></small>

            </div>
          </div>
        </div>


        <div class="modal-footer">

          <div class=" row" class="collapse" id="customer_collapse">

            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">Tutup</button>

              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_biodata">Simpan</button>

            </div>

          </div>



        </div>

      </form>



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
          <label>File CV</label>
          <input type="file" name="file-cv" id="file-cv" class="form-control">
          <input type="hidden" class="form-control" name="lampiran_cv" id="lampiran_cv" class="form-control" accept="application/pdf">
          <small class="error-file-cv text-danger"></small>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger " data-dismiss="modal" style="border-radius: 0px">Tutup</button>
          <button type="button" class="btn btn-success item_upload_resume" style="border-radius: 0px">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" data-backdrop="static" id="ModalPengalaman" tabindex="-1" role="dialog" aria-labelledby="ModalPengalamanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_pengalaman" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_pengalaman') ?>">
        <div class="modal-header bg-danger">
          <h3 class="modal-title" id="ModalPengalamanJudul" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i>TAMBAH PENGALAMAN</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="jabatan_id">Posisi</label>
              <input type="hidden" name="pengalaman_id" id="pengalaman_id">
              <select class="form-control" id="jabatan_id" name="jabatan_id" style="width: 100%">
                <option value="0" selected disabled>Pilih Posisi</option>
                <?php foreach ($jabatan as $jb) : ?>
                  <option value="<?php echo $jb->jabatan_id ?>"><?php echo $jb->jabatan_nama; ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-jabatan_id text-danger"></small>
            </div>
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="joblevel_id">Level</label>
              <select class="form-control" id="joblevel_id" name="joblevel_id" style="width: 100%">
                <option value="0" selected disabled>Pilih Level Pekerjaan</option>
                <?php foreach ($joblevel as $jl) : ?>
                  <option value="<?php echo $jl->joblevel_id ?>"><?php echo $jl->joblevel_nama; ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-joblevel_id text-danger"></small>
            </div>
            <div class="col-md-12 mb-3 ">
              <label style="color:#343a40;" for="perusahaan_id">Perusahaan</label>
              <select class="form-control" id="perusahaan_id" name="perusahaan_id" style="width: 100%">
                <option value="0" selected disabled>Pilih Perusahaan</option>
                <?php foreach ($perusahaan as $pr) : ?>
                  <option value="<?php echo $pr->perusahaan_id ?>"><?php echo $pr->perusahaan_nama; ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-perusahaan_id text-danger"></small>
            </div>

            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="pengalaman_tanggal_awal">Tanggal Mulai</label>
              <input type="date" class="form-control" id="pengalaman_tanggal_awal" name="pengalaman_tanggal_awal">
              <small class="error-pengalaman_tanggal_awal text-danger"></small>
            </div>
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="pengalaman_tanggal_akhir">Tanggal Selesai</label>
              <input type="date" class="form-control" id="pengalaman_tanggal_akhir" name="pengalaman_tanggal_akhir">
              <input type="checkbox" id="masih_bekerja" name="masih_bekerja" class=" mt-3" value="1">
              <label for="masih_bekerja">Saya masih bekerja di perusahaan ini</label>
              <br>
              <small class="error-pengalaman_tanggal_akhir text-danger"></small>
            </div>
            <div class="col-md-12 mb-3 ">
              <label style="color:#343a40;" for="pengalaman_deskripsi">Deskripsi</label>
              <textarea class="form-control" id="pengalaman_deskripsi" name="pengalaman_deskripsi" rows="5"></textarea>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <div class=" row" class="collapse">
            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">BATAL</button>
              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_pengalaman">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" data-backdrop="static" id="ModalTentang" tabindex="-1" role="dialog" aria-labelledby="ModalTentangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_about" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_about') ?>">
        <div class="modal-header bg-danger">
          <h3 class="modal-title" id="ModalTentangJudul" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i>TAMBAH PENGALAMAN</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 mb-3 ">
              <textarea class="form-control" id="resume_about" name="resume_about" rows="5"></textarea>
              <small class="error-resume_about text-danger"></small>

            </div>

          </div>
        </div>
        <div class="modal-footer">
          <div class=" row" class="collapse">
            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">BATAL</button>
              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_about">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" data-backdrop="static" id="ModalSkillResume" tabindex="-1" role="dialog" aria-labelledby="ModalSkillResumeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_skill_resume" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_skill') ?>">

        <div class="modal-header bg-danger">
          <h3 class="modal-title" id="ModalSkillResumeJudul" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i>TAMBAH SKILL</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body daftar_skill">
          <div class="row list_skill list_skill_0">
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="skill_id">Skill</label>
              <select class="form-control" id="skill_id_0" name="skill_id[]" style="width: 100%">
                <option value="0" selected disabled>Pilih Skill</option>
                <?php foreach ($skill as $sk) : ?>
                  <option value="<?php echo $sk->skill_id ?>"><?php echo $sk->skill_nama; ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-skill_id_0 text-danger"></small>
            </div>
            <div class="col-md-4 mb-3">
              <label style="color:#343a40;" for="skill_level_id">Level</label>
              <select class="form-control" id="skill_level_id_0" name="skill_level_id[]" style="width: 100%">
                <option value="0" selected disabled>Pilih Level Skill</option>
                <?php foreach ($skill_level as $lv) : ?>
                  <option value="<?php echo $lv->skill_level_id ?>"><?php echo $lv->skill_level_nama; ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-skill_level_id_0 text-danger"></small>
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end flex-row">
              <button type="button" class="btn btn-danger btn-xs align-items-end rounded btn_hapus_skill mr-2" data="0"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-success btn-xs align-items-end rounded btn_tambah_skill" data="0"><i class="fas fa-plus"></i></button>
            </div>
          </div>

        </div>


        <div class="modal-footer">

          <div class=" row" class="collapse" id="customer_collapse">

            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">BATAL</button>
              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_skill">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" data-backdrop="static" id="ModalBahasaResume" tabindex="-1" role="dialog" aria-labelledby="ModalBahasaResumeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_bahasa_resume" method="post" enctype="multipart/form-data" action="<?php echo base_url('cv/simpan_bahasa') ?>">

        <div class="modal-header bg-danger">
          <h3 class="modal-title" id="ModalBahasaResumeJudul" style="color: #ffffff!important"> <i class="fas fa-user mr-2"></i>TAMBAH BAHASA</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body daftar_bahasa">
          <div class="row list_bahasa list_bahasa_0">
            <div class="col-md-6 mb-3 ">
              <label style="color:#343a40;" for="bahasa_id">Bahasa</label>
              <select class="form-control" id="bahasa_id_0" name="bahasa_id[]" style="width: 100%">
                <option value="0" selected disabled>Pilih Bahasa</option>
                <?php foreach ($bahasa as $bhs) : ?>
                  <option value="<?php echo $bhs->bahasa_id ?>"><?php echo $bhs->bahasa_nama; ?></option>
                <?php endforeach ?>
              </select>
              <small class="error-bahasa_id_0 text-danger"></small>
            </div>
            <div class="col-md-4 mb-3">
              <label style="color:#343a40;" for="bahasa_level">Level</label>
              <select class="form-control" id="bahasa_level_0" name="bahasa_level[]" style="width: 100%">
                <option value="" selected disabled>Pilih Level</option>
                <option value="1">Aktif</option>
                <option value="0">Pasif</option>
              </select>
              <small class="error-bahasa_level_0 text-danger"></small>
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end flex-row">
              <button type="button" class="btn btn-danger btn-xs align-items-end rounded btn_hapus_bahasa mr-2" data="0"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-success btn-xs align-items-end rounded btn_tambah_bahasa" data="0"><i class="fas fa-plus"></i></button>
            </div>
          </div>

        </div>


        <div class="modal-footer">

          <div class=" row" class="collapse" id="customer_collapse">

            <div class="col-sm-12 float-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;">BATAL</button>
              <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_bahasa">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
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
  var files = [];
  document.getElementById("file-cv").addEventListener("change", function(e) {
    files = e.target.files;
  });

  document.getElementById("lampiran_pas_photo").addEventListener("change", function(e) {
    files = e.target.files;
    previewFile('lampiran_pas_photo');

  });

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

    $(document).on('click', '.btn_tambah_bahasa', function() {
      let id = $(this).attr('data');
      let id_baru = parseFloat(id) + 1;

      let bahasa_id = $('#bahasa_id_' + id).val();
      let bahasa_level = $('#bahasa_level_' + id).val();
      let cek = 0;

      if (bahasa_id == null) {
        cek++;
        $('.error-bahasa_id_' + id).html('Silahkan Pilih bahasa');
      } else {
        $('.error-bahasa_id_' + id).html('');

      }
      if (bahasa_level == null) {
        cek++;
        $('.error-bahasa_level_' + id).html('Silahkan Pilih Level');
      } else {
        $('.error-bahasa_level_' + id).html('');

      }
      if (cek > 0) {
        return false;
      } else {

        let html = `<div class="row list_bahasa list_bahasa_` + id_baru + `"> 
   <div class="col-md-6 mb-3 "> 
   <label style="color:#343a40;" for="bahasa_id">Bahasa</label>
   <select class="form-control" id="bahasa_id_` + id_baru + `"  name="bahasa_id[]" style="width: 100%">
   <option value="0" selected disabled>Pilih Bahasa</option>
   <?php foreach ($bahasa as $bhs) : ?>
     <option value="<?php echo $bhs->bahasa_id ?>"><?php echo $bhs->bahasa_nama; ?></option>
   <?php endforeach ?>
   </select>
   <small class="error-bahasa_id_` + id_baru + ` text-danger"></small>
   </div>
   <div class="col-md-4 mb-3"> 
   <label style="color:#343a40;" for="bahasa_level">Level</label>
   <select class="form-control" id="bahasa_level_` + id_baru + `"  name="bahasa_level[]" style="width: 100%">
   <option value="" selected disabled>Pilih Level</option>
   <option value="1">Aktif</option>
   <option value="0">Pasif</option>
   </select>
   <small class="error-bahasa_level_` + id_baru + ` text-danger"></small>
   </div>
   <div class="col-md-2 mb-3 d-flex align-items-end flex-row"> 
   <button  type="button" class="btn btn-danger btn-xs align-items-end rounded btn_hapus_bahasa mr-2" data="` + id_baru + `"><i class="fas fa-minus"></i></button>
   <button type="button"  class="btn btn-success btn-xs align-items-end rounded btn_tambah_bahasa" data="` + id_baru + `"><i class="fas fa-plus"></i></button>
   </div>
   </div>`

        $('.daftar_bahasa').append(html);
        $('.btn_tambah_bahasa').addClass('d-none');
        $('.btn_tambah_bahasa:last').removeClass('d-none');
      }
    });
    $(document).on('click', '.btn_hapus_bahasa', function() {
      let jumlah = $('.list_bahasa').length;
      let id = $(this).attr('data');
      let id_baru = parseFloat(id) + 1;
      if (jumlah == 1) {
        $('#bahasa_id_' + id).val(0).trigger('change');
        $('#bahasa_level_' + id).val('').trigger('change');

      } else {
        $('.list_bahasa_' + id).remove();
        $('.btn_tambah_bahasa:last').removeClass('d-none');
      }

    });



    $(document).on('click', '.btn_tambah_skill', function() {
      let id = $(this).attr('data');
      let id_baru = parseFloat(id) + 1;

      let skill_id = $('#skill_id_' + id).val();
      let skill_level_id = $('#skill_level_id_' + id).val();
      let cek = 0;

      if (skill_id == null) {
        cek++;
        $('.error-skill_id_' + id).html('Silahkan Pilih Skill');
      } else {
        $('.error-skill_id_' + id).html('');

      }
      if (skill_level_id == null) {
        cek++;
        $('.error-skill_level_id_' + id).html('Silahkan Pilih Level');
      } else {
        $('.error-skill_level_id_' + id).html('');

      }
      if (cek > 0) {
        return false;
      } else {

        let html = `
      <div class="row list_skill list_skill_` + id_baru + `"> 
      <div class="col-md-6 mb-3 "> 
      <label style="color:#343a40;" for="skill_id">Skill</label>
      <input type="hidden" name="skill_resume_id[]" id="skill_resume_id">
      <select class="form-control" id="skill_id_` + id_baru + `"  name="skill_id[]" style="width: 100%">
      <option value="0" selected disabled>Pilih Skill</option>
      <?php foreach ($skill as $sk) : ?>
       <option value="<?php echo $sk->skill_id ?>"><?php echo $sk->skill_nama; ?></option>
     <?php endforeach ?>
     </select>
     <small class="error-skill_id_` + id_baru + ` text-danger"></small>
     </div>
     <div class="col-md-4 mb-3 "> 
     <label style="color:#343a40;" for="skill_level_id">Level</label>
     <select class="form-control" id="skill_level_id_` + id_baru + `"  name="skill_level_id[]" style="width: 100%">
     <option value="0" selected disabled>Pilih Level Skill</option>
     <?php foreach ($skill_level as $lv) : ?>
       <option value="<?php echo $lv->skill_level_id ?>"><?php echo $lv->skill_level_nama; ?></option>
     <?php endforeach ?>
     </select>
     <small class="error-skill_level_id_` + id_baru + ` text-danger"></small>
     </div>
     <div class="col-md-2 mb-3 d-flex align-items-end flex-row"> 
     <button  type="button" class="btn btn-danger btn-xs align-items-end rounded btn_hapus_skill mr-2" data="` + id_baru + `"><i class="fas fa-minus"></i></button>
     <button  type="button" class="btn btn-success btn-xs align-items-end rounded btn_tambah_skill" data="` + id_baru + `"><i class="fas fa-plus"></i></button>
     </div>
     </div>
     `

        $('.daftar_skill').append(html);
        $('.btn_tambah_skill').addClass('d-none');
        $('.btn_tambah_skill:last').removeClass('d-none');
      }
    });

    $(document).on('click', '.btn_hapus_skill', function() {
      let jumlah = $('.list_skill').length;
      let id = $(this).attr('data');
      let id_baru = parseFloat(id) + 1;
      if (jumlah == 1) {
        $('#skill_id_' + id).val(0).trigger('change');
        $('#skill_level_id_' + id).val(0).trigger('change');

      } else {
        $('.list_skill_' + id).remove();
        $('.btn_tambah_skill:last').removeClass('d-none');
      }

    });

    $('#pendidikan_id').select2({
      dropdownParent: $('#ModalProfil .modal-content'),
      allowClear: true,
      placeholder: 'Pilih Pendidikan',
      tags: true,

    });

    $('#resume_prov').select2({
      dropdownParent: $('#ModalProfil .modal-content'),
      allowClear: true,
      placeholder: 'Pilih Provinsi'
    });
    $('#resume_prov').on('change', function() {
      let prov = $(this).val();
      $.ajax({
        type: "GET",
        url: "<?php echo base_url('seeker/getkabkota') ?>",
        dataType: "JSON",
        data: {
          'prov_id': prov
        },
        success: function(data) {
          let kab = '<option value="0" selected disabled>Pilih Kabupaten/Kota</option>';
          for (var i = 0; i < data.length; i++) {
            kab += '<option value="' + data[i].kabkota_id + '">' + data[i].kabkota_nama + '</option>';
          }
          $('#resume_kabkota').html(kab);
          $('#resume_kabkota').select2({
            dropdownParent: $('#ModalProfil .modal-content'),
            allowClear: true,
            placeholder: 'Pilih Kabupaten/Kota'
          });

        }
      });

    });




  });

  $('.item_list_pengalaman').on('mouseover', function() {
    let id = $(this).data('list');
    $('.item_edit_pengalaman_' + id).removeClass('d-none');
    $('.item_hapus_pengalaman_' + id).removeClass('d-none');

  });
  $('.item_list_pengalaman').on('mouseleave', function() {
    let id = $(this).data('list');
    $('.item_edit_pengalaman_' + id).addClass('d-none');
    $('.item_hapus_pengalaman_' + id).addClass('d-none');

  });

  $('.item_hapus_pengalaman').on('click', function() {
    let id = $(this).attr('data');
    $('#ModalHapusPengalaman').modal('show');
    $('#pengalaman_id_hapus').val(id);
  });

  $('.item_edit_pengalaman').on('click', function() {
    let id = $(this).attr('data');
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('cv/get_pengalaman') ?>",
      dataType: "JSON",
      data: {
        'pengalaman_id': id
      },
      success: function(data) {

        let option = '<option value="' + data.perusahaan[0].perusahaan_id + '" selected>' + data.perusahaan[0].perusahaan_nama + '</option>';
        $('#perusahaan_id').html(option);

        $('#perusahaan_id').select2({
          placeholder: 'Pilih Perusahaan',
          allowClear: true,
          dropdownParent: $('#ModalPengalaman'),
          tags: true,
        });


        $('#jabatan_id').select2({
          placeholder: 'Pilih Posisi',
          allowClear: true,
          dropdownParent: $('#ModalPengalaman'),
          tags: true,
        });
        $('#ModalPengalaman').modal('show');
        $('#pengalaman_id').val(id);
        $('#jabatan_id').val(data.pengalaman[0].jabatan_id).trigger('change');
        $('#joblevel_id').val(data.pengalaman[0].joblevel_id).trigger('change');
        $('#pengalaman_tanggal_awal').val(data.pengalaman[0].pengalaman_tanggal_awal).trigger('change');
        $('#pengalaman_tanggal_akhir').val(data.pengalaman[0].pengalaman_tanggal_akhir).trigger('change');
        if (data.pengalaman[0].masih_bekerja > 0) {
          $('#masih_bekerja').prop('checked', true);
          $('#pengalaman_tanggal_akhir').attr('disabled', 'disabled');
        } else {
          $('#pengalaman_tanggal_akhir').val(data.pengalaman[0].pengalaman_tanggal_akhir).trigger('change');
        }
        $('#pengalaman_deskripsi').summernote('code', data.pengalaman[0].pengalaman_deskripsi);

        $('#btn_simpan_pengalaman').html('UPDATE');
        $('#form_pengalaman').attr('action', '<?php echo base_url('cv/ubah_pengalaman') ?>');
        $('#ModalPengalamanJudul').html(' <i class="fa fa-industry mr-2" aria-hidden="true"></i>UBAH PENGALAMAN KERJA');
      }
    });

  });

  function getPathStorageFromUrl(url) {

    const baseUrl = "https://firebasestorage.googleapis.com/v0/b/project-80505.appspot.com/o/";

    let imagePath = url.replace(baseUrl, "");

    const indexOfEndPath = imagePath.indexOf("?");

    imagePath = imagePath.substring(0, indexOfEndPath);

    imagePath = imagePath.replace("%2F", "/");

    return imagePath;
  }
  $('#btn_simpan_skill').on('click', function() {
    let cek = 0;

    $('[name^="skill_id"]').each(function() {
      let skill_id = $(this).val();
      let id = $(this).attr('id').replace('skill_id_', '');
      if (skill_id == null) {
        cek++;
        $('.error-skill_id_' + id).html('Silahkan Pilih Skill');
      } else {
        $('.error-skill_id_' + id).html('');
      }

      let skill_level_id = $('#skill_level_id_' + id).val();
      if (skill_level_id == null) {
        cek++;
        $('.error-skill_level_id_' + id).html('Silahkan Pilih Level');
      } else {
        $('.error-skill_level_id_' + id).html('');
      }
    });

    if (cek > 0) {
      return false;
    } else {
      $('#form_skill_resume').submit();
    }

  });


  $('#btn_simpan_bahasa').on('click', function() {
    let cek = 0;

    $('[name^="bahasa_id"]').each(function() {
      let bahasa_id = $(this).val();
      let id = $(this).attr('id').replace('bahasa_id_', '');
      if (bahasa_id == null) {
        cek++;
        $('.error-bahasa_id_' + id).html('Silahkan Pilih Bahasa');
      } else {
        $('.error-bahasa_id_' + id).html('');
      }

      let bahasa_level = $('#bahasa_level_' + id).val();
      if (bahasa_level == null) {
        cek++;
        $('.error-bahasa_level_' + id).html('Silahkan Pilih Level');
      } else {
        $('.error-bahasa_level_' + id).html('');
      }
    });

    if (cek > 0) {
      return false;
    } else {
      $('#form_bahasa_resume').submit();
    }

  });

  $('#btn_simpan_about').on('click', function() {
    if ($('#resume_about').summernote('isEmpty')) {
      $('.error-resume_about').html('Silahkan Masukkan Deskripsi Tentang Anda');
      return false;
    } else {
      $('.error-resume_about').html('');
    }

    $('#btn_simpan_about').attr('disabled', 'disabled');
    $('#btn_simpan_about').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');
    $('#form_about').submit();

  });



  $('#btn_simpan_pengalaman').on('click', function() {
    let cek = 0;
    let jabatan_id = $('#jabatan_id').val();
    if (jabatan_id == null) {
      cek++;
      $('.error-jabatan_id').html('Silahkan Pilih Posisi');
    } else {
      $('.error-jabatan_id').html('');
    }

    let joblevel_id = $('#joblevel_id').val();
    if (joblevel_id == null) {
      cek++;
      $('.error-joblevel_id').html('Silahkan Pilih Level');
    } else {
      $('.error-joblevel_id').html('');
    }


    let perusahaan_id = $('#perusahaan_id').val();
    if (perusahaan_id == null) {
      cek++;
      $('.error-perusahaan_id').html('Silahkan Pilih Level');
    } else {
      $('.error-perusahaan_id').html('');
    }

    let pengalaman_tanggal_awal = $('#pengalaman_tanggal_awal').val();
    if (pengalaman_tanggal_awal == '') {
      cek++;
      $('.error-pengalaman_tanggal_awal').html('Silahkan Pilih Periode Awal Bekerja');
    } else {
      $('.error-pengalaman_tanggal_awal').html('');
    }

    let masih_bekerja = $('#masih_bekerja').prop('checked');

    if (masih_bekerja == false) {
      let pengalaman_tanggal_akhir = $('#pengalaman_tanggal_akhir').val();

      if (pengalaman_tanggal_akhir == '') {
        cek++;
        $('.error-pengalaman_tanggal_akhir').html('Silahkan Pilih Periode Akhir Bekerja');
      } else {
        if (pengalaman_tanggal_akhir < pengalaman_tanggal_awal) {
          cek++;
          $('.error-pengalaman_tanggal_akhir').html('Rentang Periode Bekerja Tidak Valid');
        } else {
          $('.error-pengalaman_tanggal_akhir').html('');
        }

      }

    }
    if (cek > 0) {
      return false;
    } else {
      $('#form_pengalaman').submit();
    }

  });



  $('#btn_simpan_biodata').on('click', function() {

    let cek = 0;
    let nik = $('#resume_nik').val();
    if (nik == '') {
      $('.error-resume_nik').html('NIK Tidak Boleh Kosong');
      cek++;
    } else {
      if (nik.length != 16) {
        $('.error-resume_nik').html('NIK Harus 16 Digit');
        cek++;
      } else {
        $('.error-resume_nik').html('');
      }
    }

    let nama_lengkap = $('#resume_nama_lengkap').val();
    if (nama_lengkap == '') {
      $('.error-resume_nama_lengkap').html('Silahkan Masukkan Nama');
      cek++;
    } else {
      $('.error-resume_nama_lengkap').html('');
    }

    let tempat_lahir = $('#resume_tempat_lahir').val();
    if (tempat_lahir == '') {
      $('.error-resume_tempat_lahir').html('Silahkan Masukkan Tempat Lahir');
      cek++;
    } else {
      let tanggal_lahir = $('#resume_tanggal_lahir').val();
      if (tanggal_lahir == '') {
        $('.error-resume_tempat_lahir').html('Silahkan Masukkan Tanggal Lahir');
        cek++;
      } else {
        $('.error-resume_tempat_lahir').html('');
      }
    }

    let jenis_kelamin = $('#resume_jenis_kelamin').val();
    if (jenis_kelamin == null) {
      $('.error-resume_jenis_kelamin').html('Silahkan Pilih Jenis Kelamin');
      cek++;
    } else {
      $('.error-resume_jenis_kelamin').html('');
    }

    let agama = $('#resume_agama').val();
    if (agama == null) {
      $('.error-resume_agama').html('Silahkan Pilih Agama');
      cek++;
    } else {
      $('.error-resume_agama').html('');
    }

    let pendidikan = $('#pendidikan_id').val();
    if (pendidikan == null) {
      $('.error-pendidikan_id').html('Silahkan Pilih Jenjang Pendidikan');
      cek++;
    } else {
      $('.error-pendidikan_id').html('');
    }

    let nama_pendidikan_terakhir = $('#resume_nama_pendidikan_terakhir').val();
    if (nama_pendidikan_terakhir == '') {
      $('.error-resume_nama_pendidikan_terakhir').html('Silahkan Masukkan Nama Sekolah / Institusi');
      cek++;
    } else {
      $('.error-resume_nama_pendidikan_terakhir').html('');
    }

    let pendidikan_tahun_lulus = $('#resume_pendidikan_tahun_lulus').val();
    if (pendidikan_tahun_lulus == '') {
      $('.error-resume_pendidikan_tahun_lulus').html('Tahun Lulus Kosong');
      cek++;
    } else {
      $('.error-resume_pendidikan_tahun_lulus').html('');
    }

    let resume_prov = $('#resume_prov').val();
    if (resume_prov == null) {
      $('.error-resume_prov').html('Silahkan Pilih Provinsi');
      cek++;
    } else {
      $('.error-resume_prov').html('');
    }

    let resume_kabkota = $('#resume_kabkota').val();
    if (resume_kabkota == null) {
      $('.error-resume_kabkota').html('Silahkan Pilih Kabupaten/Kota');
      cek++;
    } else {
      $('.error-resume_kabkota').html('');
    }

    let alamat = $('#resume_alamat').val();
    if (alamat == '') {
      $('.error-resume_alamat').html('Silahkan Masukkan Alamat Lengkap');
      cek++;
    } else {
      $('.error-resume_alamat').html('');
    }

    if (cek > 0) {
      return false
    } else {
      let link = $('#form_upload').attr('action');

      if (files.length == 0) {
        if (link.includes('simpan') !== false) {
          $('.error-file-photo').html('Silahkan Upload Photo');
          return false;
        } else {
          $('#btn_simpan_biodata').attr('disabled', 'disabled');
          $('#btn_simpan_biodata').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');

          $('#form_profil').submit();
        }
      } else {
        let photo = $('#lampiran_pas_photo_lama').val();
        if (photo != '') {
          const myfile = firebase.storage();
          myfile.refFromURL(photo).delete()
        }
        for (let i = 0; i < files.length; i++) {
          var storage = firebase.storage().ref('talent_hub/cv/' + files[i].name);
          var upload = storage.put(files[i]);
          upload.on(

            "state_changed",
            function progress(snapshot) {},

            function error() {
              $('.error-file-photo').html("Upload File Error");
            },

            function complete() {
              storage
                .getDownloadURL()
                .then(function(url) {
                  $('#lampiran_pas_photo_lama').val(url);
                  $('#btn_simpan_biodata').attr('disabled', 'disabled');
                  $('#btn_simpan_biodata').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px!importatnt;width:25px!important;">');
                  $('#form_profil').submit();
                })
                .catch(function(error) {
                  console.log("error encountered");
                });
            },
          );


        }
      }


    }

  });

  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }


  $(document).on('click', '.item_upload_resume', function() {
    if (files.length == 0) {
      $('.error-file-cv').html('Silahkan Upload File CV');
      return false;
    } else {
      let resume_lama = $('.item_lihat_resume').attr('href');
      if (resume_lama != null) {
        const myfile = firebase.storage();
        myfile.refFromURL(resume_lama).delete()
      }

      for (let i = 0; i < files.length; i++) {
        var storage = firebase.storage().ref('talent_hub/cv/' + files[i].name);
        var upload = storage.put(files[i]);
        upload.on(

          "state_changed",
          function progress(snapshot) {},

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

  $('.item_edit_resume').on('click', function() {
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('seeker/get_resume') ?>",
      dataType: "JSON",
      success: function(data) {
        if (data.length > 0) {
          $('#ModalProfil').modal('show');
          $('#ModalProfilLabel').html('UBAH BIODATA PROFIL');
          $('#form_profil').attr('action', '<?php echo base_url('cv/ubah_resume') ?>');
          $('#btn_simpan_biodata').html('UPDATE');
          $('#resume_id').val(data[0].resume_id);
          $('#resume_nama_lengkap').val(data[0].resume_nama_lengkap);

          $('#resume_nik').val(data[0].resume_nik)

          $('#resume_tempat_lahir').val(data[0].resume_tempat_lahir);
          $('#resume_tanggal_lahir').val(data[0].resume_tanggal_lahir);

          $('#resume_jenis_kelamin').val(data[0].resume_jenis_kelamin).trigger('change');
          $('#resume_agama').val(data[0].agama_id).trigger('change');
          $('#pendidikan_id').val(data[0].pendidikan_id).trigger('change');
          $('#resume_pendidikan_tahun_lulus').val(data[0].resume_pendidikan_tahun_lulus);
          $('#resume_nama_pendidikan_terakhir').val(data[0].resume_nama_pendidikan_terakhir);
          $('#resume_prov').val(data[0].prov_id).trigger('change');

          setTimeout(
            function() {
              $('#resume_kabkota').val(data[0].kabkota_id).trigger('change');

            }, 2000);

          $('#resume_alamat').val(data[0].resume_alamat_lengkap);
          $('#lampiran_pas_photo_lama').val(data[0].resume_foto);
          if (data[0].resume_foto != '') {
            $('#preview_lampiran_pas_photo').attr('src', data[0].resume_foto);
          }
        } else {
          Swal.fire({
            title: 'Error',
            text: 'Biodata Tidak Ditemukan!',
            icon: 'error'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
            }
          });
          return false;
        }

      }
    });

  });

  $('.item_tambah_skill').on('click', function() {
    $('#ModalSkillResume').modal('show');
    $('#btn_simpan_skill').html('SIMPAN');
    $('#form_skill_resume').attr('action', '<?php echo base_url('cv/simpan_skill') ?>');
    $('#ModalSkillResumeJudul').html(' <i class="fas fa-database mr-2"></i>TAMBAH SKILL');
    $('[name^="skill_id"]').select2({
      placeholder: 'Pilih Skill',
      allowClear: true,
      dropdownParent: $('#ModalSkillResume .modal-content'),
      tags: true,
    });
  });


  $('.item_tambah_bahasa').on('click', function() {
    $('#ModalBahasaResume').modal('show');
    $('#btn_simpan_bahasa').html('SIMPAN');
    $('#form_bahasa_resume').attr('action', '<?php echo base_url('cv/simpan_bahasa') ?>');
    $('#ModalBahasaResumeJudul').html(' <i class="fas fa-book mr-2"></i>TAMBAH BAHASA');
    $('[name^="bahasa_id"]').select2({
      placeholder: 'Pilih Bahasa',
      allowClear: true,
      dropdownParent: $('#ModalBahasaResume .modal-content'),
      tags: true,
    });
  });

  $('.item_tambah_about').on('click', function() {
    $('#ModalTentang').modal('show');
    $('#btn_simpan_about').html('SIMPAN');
    $('#form_about').attr('action', '<?php echo base_url('cv/simpan_about') ?>');
    $('#ModalTentangJudul').html(' <i class="fa fa-user mr-2" aria-hidden="true"></i>TENTANG SAYA');

    $('#resume_about').summernote({
      placeholder: 'Tentang Saya',
      tabsize: 2,
      height: 150,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('resume_about', image[0]);
        },
        onMediaDelete: function(target) {
          deleteImage(target[0].src);
        }
      }
    });

  });



  $('.item_tambah_pengalaman').on('click', function() {
    $('#ModalPengalaman').modal('show');
    $('#btn_simpan_pengalaman').html('SIMPAN');
    $('#form_pengalaman').attr('action', '<?php echo base_url('cv/simpan_pengalaman') ?>');
    $('#ModalPengalamanJudul').html(' <i class="fa fa-industry mr-2" aria-hidden="true"></i>TAMBAH PENGALAMAN KERJA');

    $('#pengalaman_deskripsi').summernote({
      placeholder: 'Deskripsi Pekerjaan',
      tabsize: 2,
      height: 150,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage('pengalaman_deskripsi', image[0]);
        },
        onMediaDelete: function(target) {
          deleteImage(target[0].src);
        }
      }
    });

    $('#jabatan_id').select2({
      placeholder: 'Pilih Posisi',
      allowClear: true,
      dropdownParent: $('#ModalPengalaman'),
      tags: true,
    });

    $('#perusahaan_id').select2({
      placeholder: 'Pilih Perusahaan',
      allowClear: true,
      dropdownParent: $('#ModalPengalaman'),
      tags: true,
      ajax: {
        url: '<?php echo base_url('cv/get_list_perusahaan') ?>',
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      "language": {
        "noResults": function() {
          return "Searching Data....";
        }
      },

    });

  });

  $('#masih_bekerja').on('click', function() {
    if ($(this).prop('checked')) {
      $('#pengalaman_tanggal_akhir').attr('disabled', 'disabled');
      $('#pengalaman_tanggal_akhir').val('');
    } else {
      $('#pengalaman_tanggal_akhir').removeAttr('disabled');
    }
  });
  $('.item_edit_skill_resume').on('click', function() {
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('cv/get_skill_resume') ?>",
      dataType: "JSON",
      success: function(data) {
        $('#ModalSkillResume').modal('show');
        $('#btn_simpan_skill').html('UBAH');
        $('#form_skill_resume').attr('action', '<?php echo base_url('cv/ubah_skill') ?>');
        let html = '';
        for (var i = 0; i < data.length; i++) {
          html += `
     <div class="row list_skill list_skill_` + i + `"> 
     <div class="col-md-6 mb-3 "> 
     <label style="color:#343a40;" for="skill_id">Skill</label>
     <input type="hidden" name="skill_resume_id[]" id="skill_resume_id">
     <select class="form-control" id="skill_id_` + i + `"  name="skill_id[]" style="width: 100%">
     <option value="0" selected disabled>Pilih Skill</option>
     <?php foreach ($skill as $sk) : ?>
       <option value="<?php echo $sk->skill_id ?>"><?php echo $sk->skill_nama; ?></option>
     <?php endforeach ?>
     </select>
     <small class="error-skill_id_` + i + ` text-danger"></small>
     </div>
     <div class="col-md-4 mb-3 "> 
     <label style="color:#343a40;" for="skill_level_id">Level</label>
     <select class="form-control" id="skill_level_id_` + i + `"  name="skill_level_id[]" style="width: 100%">
     <option value="0" selected disabled>Pilih Level Skill</option>
     <?php foreach ($skill_level as $lv) : ?>
       <option value="<?php echo $lv->skill_level_id ?>"><?php echo $lv->skill_level_nama; ?></option>
     <?php endforeach ?>
     </select>
     <small class="error-skill_level_id_` + i + ` text-danger"></small>
     </div>
     <div class="col-md-2 mb-3 d-flex align-items-end flex-row"> 
     <button  type="button" class="btn btn-danger btn-xs align-items-end rounded btn_hapus_skill mr-2" data="` + i + `"><i class="fas fa-minus"></i></button>
     <button  type="button" class="btn btn-success btn-xs align-items-end rounded btn_tambah_skill" data="` + i + `"><i class="fas fa-plus"></i></button>
     </div>
     </div>
     `;
        }

        $('.daftar_skill').html(html);
        for (var i = 0; i < data.length; i++) {
          $('#skill_id_' + i).val(data[i].skill_id).trigger('change');
          $('#skill_level_id_' + i).val(data[i].skill_level_id).trigger('change');
        }

        $('.btn_tambah_skill').addClass('d-none');
        $('.btn_tambah_skill:last').removeClass('d-none');
        $('#ModalSkillResumeJudul').html(' <i class="fas fa-database mr-2"></i>UBAH SKILL');
        $('[name^="skill_id"]').select2({
          placeholder: 'Pilih Skill',
          allowClear: true,
          dropdownParent: $('#ModalSkillResume .modal-content'),
          tags: true,
        });
      }
    });

  });


  $('.item_edit_bahasa_resume').on('click', function() {
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('cv/get_bahasa_resume') ?>",
      dataType: "JSON",
      success: function(data) {
        $('#ModalBahasaResume').modal('show');
        $('#btn_simpan_bahasa').html('UBAH');
        $('#form_bahasa_resume').attr('action', '<?php echo base_url('cv/ubah_bahasa') ?>');
        let html = '';
        for (var i = 0; i < data.length; i++) {
          html += `<div class="row list_bahasa list_bahasa_` + i + `"> 
     <div class="col-md-6 mb-3 "> 
     <label style="color:#343a40;" for="bahasa_id">Bahasa</label>
     <select class="form-control" id="bahasa_id_` + i + `"  name="bahasa_id[]" style="width: 100%">
     <option value="0" selected disabled>Pilih Bahasa</option>
     <?php foreach ($bahasa as $bhs) : ?>
       <option value="<?php echo $bhs->bahasa_id ?>"><?php echo $bhs->bahasa_nama; ?></option>
     <?php endforeach ?>
     </select>
     <small class="error-bahasa_id_` + i + ` text-danger"></small>
     </div>
     <div class="col-md-4 mb-3"> 
     <label style="color:#343a40;" for="bahasa_level">Level</label>
     <select class="form-control" id="bahasa_level_` + i + `"  name="bahasa_level[]" style="width: 100%">
     <option value="" selected disabled>Pilih Level</option>
     <option value="1">Aktif</option>
     <option value="0">Pasif</option>
     </select>
     <small class="error-bahasa_level_` + i + ` text-danger"></small>
     </div>
     <div class="col-md-2 mb-3 d-flex align-items-end flex-row"> 
     <button  type="button" class="btn btn-danger btn-xs align-items-end rounded btn_hapus_bahasa mr-2" data="` + i + `"><i class="fas fa-minus"></i></button>
     <button type="button"  class="btn btn-success btn-xs align-items-end rounded btn_tambah_bahasa" data="` + i + `"><i class="fas fa-plus"></i></button>
     </div>
     </div>`;
        }

        $('.daftar_bahasa').html(html);

        for (var i = 0; i < data.length; i++) {
          $('#bahasa_id_' + i).val(data[i].bahasa_id).trigger('change');
          $('#bahasa_level_' + i).val(data[i].resume_bahasa_level).trigger('change');
        }

        $('.btn_tambah_bahasa').addClass('d-none');
        $('.btn_tambah_bahasa:last').removeClass('d-none');
        $('#ModalBahasaResumeJudul').html(' <i class="fas fa-database mr-2"></i>UBAH BAHASA');
        $('[name^="bahasa_id"]').select2({
          placeholder: 'Pilih Bahasa',
          allowClear: true,
          dropdownParent: $('#ModalBahasaResume'),
          tags: true,
        });
      }
    });

  });

  function uploadImage(id, image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
      url: "<?php echo site_url('cv/upload_image') ?>",
      cache: false,
      contentType: false,
      processData: false,
      data: data,
      type: "POST",
      success: function(url) {
        $('#' + id).summernote("insertImage", url);
      },
      error: function(id, data) {
        console.log(data);
      }
    });
  }

  function deleteImage(src) {
    $.ajax({
      data: {
        src: src
      },
      type: "POST",
      url: "<?php echo site_url('cv/delete_image') ?>",
      cache: false,
      success: function(response) {}
    });
  }
</script>

<div class="modal fade" data-backdrop="static" id="ModalHapusPengalaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-light">
        <h3 class="modal-title" id="myModalLabel" style=" font: sans-serif; "><i class="fas fa-trash mr-2"></i> Hapus Pengalaman</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <form class="form-horizontal" method="post" action="<?php echo base_url('cv/hapus_pengalaman') ?>">
        <div class="modal-body">
          <input type="hidden" name="pengalaman_id_hapus" id="pengalaman_id_hapus" value="">
          <div class="alert alert-danger">
            <p class="">Hapus Pengalaman...?</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-flat mr-2" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i> Batal</button>
          <button class="btn_hapus_pengalaman btn btn-success btn-flat" type="submit" id="btn_hapus_pengalaman"><i class="fas fa-check mr-2"></i>Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>